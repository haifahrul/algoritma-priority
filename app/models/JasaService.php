<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jasa_service".
 *
 * @property integer $id
 * @property string $nama
 * @property string $biaya
 */
class JasaService extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jasa_service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'biaya'], 'required'],
            [['id'], 'integer'],
            [['nama', 'biaya'], 'string', 'max' => 50],
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
            'biaya' => Yii::t('app', 'Biaya'),
        ];
    }
}
