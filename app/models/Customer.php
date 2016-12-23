<?php

namespace app\models;

use app\modules\webmaster\models\Attribute;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%customer}}".
 *
 * @property integer $id
 * @property string $kode_customer
 * @property string $nama
 * @property string $alamat
 * @property string $no_telp
 * @property string $email
 *
 * @property Kendaraan[] $kendaraans
 * @property Service[] $services
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'alamat', 'no_telp'], 'required'],
            ['no_telp', 'integer'],
            [['nama', 'alamat', 'email', 'kode_customer'], 'string', 'max' => 50],
            ['email', 'email'],
            ['no_telp', 'unique', 'targetClass' => '\app\models\Customer', 'message' => Yii::t('app', 'No. Telp. sudah ada.')],
            ['email', 'unique', 'targetClass' => '\app\models\Customer', 'message' => Yii::t('app', 'Email ini sudah ada..')],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code_customer' => Yii::t('app', 'Code Customer'),
            'nama' => Yii::t('app', 'Nama'),
            'alamat' => Yii::t('app', 'Alamat'),
            'no_telp' => Yii::t('app', 'No Telp'),
            'email' => Yii::t('app', 'Email'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKendaraans()
    {
        return $this->hasMany(Kendaraan::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(Service::className(), ['customer_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\query\CustomerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\CustomerQuery(get_called_class());
    }

    public static function getPhoneCustomer()
    {
        $data = Yii::$app->db->createCommand('SELECT `no_telp` FROM {{%customer}}')->queryAll();
        $data = ArrayHelper::getColumn($data, 'no_telp');

        return $data;
    }

    public function getLastCodeCustomer()
    {
        $frontString = 'CS-';
        $lastCode = Yii::$app->db->createCommand('SELECT `position` FROM attribute WHERE `name`="Count Code Customer" OR `type`="Count Code Customer"')->queryOne();
        $lastCode = $lastCode['position'] + 1;
        $kode = $frontString . $lastCode;
        $kodeService[] = $kode;
        $kodeService[] = $lastCode;

        return $kodeService;
    }
}
