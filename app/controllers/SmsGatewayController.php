<?php
/**
 * Created by PhpStorm.
 * User: haifa
 * Date: 07/12/2016
 * Time: 01.03
 */
namespace app\controllers;

use yii\web\Controller;
use app\components\SmsGateway;

class SmsGatewayController extends Controller
{
    public function actionSendSms()
    {
        $smsGateway = new SmsGateway('email', 'password');

        $deviceID = 1;
        $number = '';
        $message = 'Hello World!';

        $options = [
//            'send_at' => strtotime('+10 minutes'), // Send the message in 10 minutes
//            'expires_at' => strtotime('+1 hour') // Cancel the message in 1 hour if the message is not yet sent
        ];

        //Please note options is no required and can be left out
        $result = $smsGateway->sendMessageToNumber($number, $message, $deviceID, $options);
        var_dump($result);
    }
}