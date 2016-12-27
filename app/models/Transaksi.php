<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%transaksi}}".
 *
 * @property integer $id
 * @property integer $service_id
 * @property integer $customer_id
 * @property string $nota
 * @property string $total_pembayaran
 *
 * @property Service $service
 * @property Customer $customer
 */
class Transaksi extends \yii\db\ActiveRecord
{

    public $nama;
    public $no_telp;
    public $no_plat;
    public $qty;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%transaksi}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nota', 'total_pembayaran'], 'required'],
            [['service_id', 'customer_id', 'qty'], 'integer'],
            [['nota', 'total_pembayaran'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'service_id' => Yii::t('app', 'Service'),
            'customer_id' => Yii::t('app', 'Customer'),
            'nota' => Yii::t('app', 'Nota'),
            'total_pembayaran' => Yii::t('app', 'Total Pembayaran'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::className(), ['id' => 'service_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\query\TransaksiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\TransaksiQuery(get_called_class());
    }
}
