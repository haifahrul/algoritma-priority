<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service_detail".
 *
 * @property integer $service_id
 * @property string $nama
 * @property string $qty
 *
 * @property Service $service
 */
class ServiceDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'qty'], 'required'],
            [['service_id', 'qty'], 'integer'],
            [['nama'], 'string', 'max' => 255],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::className(), 'targetAttribute' => ['service_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'service_id' => Yii::t('app', 'Service ID'),
            'nama' => Yii::t('app', 'Nama Service'),
            'qty' => Yii::t('app', 'Qty'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::className(), ['id' => 'service_id']);
    }
}
