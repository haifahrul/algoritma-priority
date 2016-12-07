<?php

namespace app\modules\SmsGatewayMe\controllers;

use app\modules\SmsGatewayMe\components\SmsGatewayMe;
use app\modules\SmsGatewayMe\models\SmsGatewayMeConfig;
use yii\web\Controller;

/**
 * Default controller for the `SmsGatewayMe` module
 */
class SendMessageController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSendOne($number, $message)
    {
        $smsGateway = SmsGatewayMeConfig::getAuthentication();
        $deviceID = SmsGatewayMeConfig::getDeviceId();

        $options = [
//            'send_at' => strtotime('+10 minutes'), // Send the message in 10 minutes
//            'expires_at' => strtotime('+1 hour') // Cancel the message in 1 hour if the message is not yet sent
        ];

        //Please note options is no required and can be left out
        $result = $smsGateway->sendMessageToNumber($number, $message, $deviceID, $options);
        var_dump($result);
    }
}
