<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%service}}".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property integer $kendaraan_id
 * @property string $keluhan
 * @property string $created_at
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
            [['customer_id', 'kendaraan_id'], 'integer'],
            [['keluhan'], 'string'],
            [['created_at'], 'safe'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['kendaraan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kendaraan::className(), 'targetAttribute' => ['kendaraan_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'kendaraan_id' => Yii::t('app', 'Kendaraan ID'),
            'keluhan' => Yii::t('app', 'Keluhan'),
            'created_at' => Yii::t('app', 'Created At'),
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
}
