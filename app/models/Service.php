<?php

namespace app\models;

use Yii;
use app\modules\webmaster\models\Attribute;

/**
 * This is the model class for table "{{%service}}".
 *
 * @property integer $id
 * @property string $kode_service
 * @property integer $customer_id
 * @property integer $kendaraan_id
 * @property string $keluhan
 * @property string $created_at
 * @property integer $deleted
 *
 * @property Customer $customer
 * @property Kendaraan $kendaraan
 * @property Transaksi[] $transaksis
 */
class Service extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%service}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'kendaraan_id', 'keluhan'], 'required'],
            [['customer_id', 'kendaraan_id', 'deleted'], 'integer'],
            [['keluhan'], 'string'],
            [['created_at', 'kode_service'], 'safe'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['kendaraan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kendaraan::className(), 'targetAttribute' => ['kendaraan_id' => 'id']],
            [['keluhan'], 'required', 'on' => 'createFromCustomer'],
            [['keluhan'], 'required', 'on' => 'createFromKendaraan'],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['createFromCustomer'] = ['keluhan'];
        $scenarios['createFromKendaraan'] = ['keluhan'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'kode_service' => Yii::t('app', 'Kode Service'),
            'customer_id' => Yii::t('app', 'Customer'),
            'kendaraan_id' => Yii::t('app', 'Kendaraan'),
            'keluhan' => Yii::t('app', 'Keluhan'),
            'created_at' => Yii::t('app', 'Tanggal Service'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKendaraan()
    {
        return $this->hasOne(Kendaraan::className(), ['id' => 'kendaraan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksis()
    {
        return $this->hasMany(Transaksi::className(), ['service_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\query\ServiceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\ServiceQuery(get_called_class());
    }

    public function generateServiceCode()
    {
        $frontString = 'SRVC-';
        $middleNumber = '00000000';
        $lastCode = Yii::$app->db->createCommand('SELECT `position` FROM attribute WHERE `name`="Count Code Service" OR `type`="Count Code Service"')->queryOne();
        $lastCode = $lastCode['position'] + 1;
        $digit = strlen((string)$lastCode);
        $number = substr($middleNumber, $digit);
        $kode = $frontString . $number . $lastCode;
        $kodeService[] = $kode;
        $kodeService[] = $lastCode;

        return $kodeService;
    }
}
