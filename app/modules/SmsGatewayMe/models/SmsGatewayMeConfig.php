<?php

namespace app\modules\SmsGatewayMe\models;

use Yii;
use app\modules\SmsGatewayMe\components\SmsGatewayMe;

/**
 * This is the model class for table "sms_gateway_me_config".
 *
 * @property integer $id
 * @property string $code
 * @property string $key
 * @property string $value
 */
class SmsGatewayMeConfig extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sms_gateway_me_config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'key', 'value'], 'required'],
            [['value'], 'string', 'max' => 128],
            [['code', 'key'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Id'),
            'code' => Yii::t('app', 'Code'),
            'key' => Yii::t('app', 'Key'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    public static function getAuthentication()
    {
        $data = Yii::$app->db->createCommand('SELECT * FROM sms_gateway_me_config WHERE `code`="CONFIG"')->queryAll();

        foreach ($data AS $item) {
            if ($item['key'] == 'email') {
                $email = $item['value'];
            } else if ($item['key'] == 'password') {
                $password = $item['value'];
            }
        }

        return $auth = new SmsGatewayMe($email, $password);
    }

    public static function getDeviceId()
    {
        $data = Yii::$app->db->createCommand('SELECT * FROM sms_gateway_me_config WHERE `code`="CONFIG"')->queryAll();

        foreach ($data AS $item) {
            if ($item['key'] == 'device_id') {
                $deviceId = $item['value'];
            }
        }

        return $deviceId;
    }

    public static function getPage()
    {
        $data = Yii::$app->db->createCommand('SELECT * FROM sms_gateway_me_config WHERE `code`="CONFIG"')->queryAll();

        foreach ($data AS $item) {
            if ($item['key'] == 'page') {
                $page = $item['value'];
            }
        }

        return $page;
    }

    public static function getSendAt()
    {
        $data = Yii::$app->db->createCommand('SELECT * FROM sms_gateway_me_config WHERE `code`="CONFIG"')->queryAll();

        foreach ($data AS $item) {
            if ($item['key'] == 'send_at') {
                $data = $item['value'];
            }
        }

        return $data;
    }

    public static function getExpiresAt()
    {
        $data = Yii::$app->db->createCommand('SELECT * FROM sms_gateway_me_config WHERE `code`="CONFIG"')->queryAll();

        foreach ($data AS $item) {
            if ($item['key'] == 'expires_at') {
                $data = $item['value'];
            }
        }

        return $data;
    }

    public static function getMessages()
    {
        $data = Yii::$app->db->createCommand('SELECT * FROM sms_gateway_me_config WHERE `code`="CONFIG" AND `key`="messages"')->queryOne();

        return $data['value'];
    }

}
