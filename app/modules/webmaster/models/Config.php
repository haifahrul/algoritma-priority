<?php

namespace app\modules\webmaster\models;

use Yii;

/**
 * This is the model class for table "config".
 *
 * @property integer $id
 * @property string $code
 * @property string $key
 * @property string $value
 */
class Config extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'key', 'value'], 'required'],
            [['value'], 'string'],
            [['code', 'key'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
            'key' => Yii::t('app', 'Key'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    public static function getConfig($key)
    {
        $value = Yii::$app->db->createCommand('SELECT `value` FROM `config` WHERE `key`=:id_key')
            ->bindValue(':id_key', $key)
            ->queryOne();

        return $value;
    }
}
