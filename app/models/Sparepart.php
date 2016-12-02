<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%sparepart}}".
 *
 * @property integer $id
 * @property string $nama
 * @property string $harga
 * @property string $stok
 *
 * @property Transaksi[] $transaksis
 */
class Sparepart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sparepart}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'harga', 'stok'], 'required'],
            [['nama', 'harga', 'stok'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nama' => Yii::t('app', 'Nama'),
            'harga' => Yii::t('app', 'Harga'),
            'stok' => Yii::t('app', 'Stok'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksis()
    {
        return $this->hasMany(Transaksi::className(), ['sparepart_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\query\SparepartQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\SparepartQuery(get_called_class());
    }
}
