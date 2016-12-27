<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service_detail".
 *
 * @property integer $service_id
 * @property integer $nama
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
            [['sparepart_id', 'qty'], 'required'],
            [['service_id', 'sparepart_id', 'qty'], 'integer'],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::className(), 'targetAttribute' => ['service_id' => 'id']],
            [['sparepart_id', 'qty'], 'required', 'on' => 'udpate'],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['udpate'] = ['sparepart_id', 'qty'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'service_id' => Yii::t('app', 'Service'),
            'sparepart_id' => Yii::t('app', 'Sparepart'),
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

    public function getSparepart()
    {
        return $this->hasOne(Sparepart::className(), ['id' => 'sparepart_id']);
    }
}
