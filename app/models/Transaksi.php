<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%transaksi}}".
 *
 * @property integer $id
 * @property integer $service_id
 * @property integer $sparepart_id
 * @property string $nota
 * @property string $total_pembayaran
 *
 * @property Service $service
 * @property Sparepart $sparepart
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
            [['service_id', 'sparepart_id', 'nota', 'total_pembayaran'], 'required'],
            [['service_id', 'sparepart_id', 'qty'], 'integer'],
            [['nota', 'total_pembayaran'], 'string', 'max' => 50],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::className(), 'targetAttribute' => ['service_id' => 'id']],
            [['sparepart_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sparepart::className(), 'targetAttribute' => ['sparepart_id' => 'id']],
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
            'sparepart_id' => Yii::t('app', 'Sparepart'),
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
    public function getSparepart()
    {
        return $this->hasOne(Sparepart::className(), ['id' => 'sparepart_id']);
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
