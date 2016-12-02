<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%kendaraan}}".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property string $merek
 * @property string $tipe
 * @property string $tahun
 * @property string $jenis
 * @property string $no_plat
 *
 * @property Customer $customer
 * @property Service[] $services
 */
class Kendaraan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%kendaraan}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'merek', 'tipe', 'tahun', 'jenis', 'no_plat'], 'required'],
            [['customer_id'], 'integer'],
            [['merek', 'tipe', 'tahun', 'jenis', 'no_plat'], 'string', 'max' => 50],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
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
            'merek' => Yii::t('app', 'Merek'),
            'tipe' => Yii::t('app', 'Tipe'),
            'tahun' => Yii::t('app', 'Tahun'),
            'jenis' => Yii::t('app', 'Jenis'),
            'no_plat' => Yii::t('app', 'No Plat'),
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
    public function getServices()
    {
        return $this->hasMany(Service::className(), ['kendaraan_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\query\KendaraanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\KendaraanQuery(get_called_class());
    }
}
