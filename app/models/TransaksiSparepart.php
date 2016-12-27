<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaksi_sparepart".
 *
 * @property integer $id
 * @property integer $transaksi_id
 * @property integer $sparepart_id
 * @property integer $qty
 * @property string $harga
 *
 * @property Sparepart $sparepart
 * @property Transaksi $transaksi
 */
class TransaksiSparepart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaksi_sparepart';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['transaksi_id', 'sparepart_id', 'qty', 'harga'], 'required'],
            [['transaksi_id', 'sparepart_id', 'qty', 'harga'], 'integer'],
//            [['sparepart_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sparepart::className(), 'targetAttribute' => ['sparepart_id' => 'id']],
//            [['transaksi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Transaksi::className(), 'targetAttribute' => ['transaksi_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'transaksi_id' => Yii::t('app', 'Transaksi ID'),
            'sparepart_id' => Yii::t('app', 'Sparepart ID'),
            'qty' => Yii::t('app', 'Qty'),
            'harga' => Yii::t('app', 'Harga'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSparepart()
    {
        return $this->hasOne(Sparepart::className(), ['id' => 'sparepart_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksi()
    {
        return $this->hasOne(Transaksi::className(), ['id' => 'transaksi_id']);
    }
}
