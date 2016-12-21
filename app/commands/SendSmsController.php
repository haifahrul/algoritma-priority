<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\Customer;
use app\modules\SmsGatewayMe\models\SmsGatewayMeConfig;
use app\modules\webmaster\models\Attribute;
use yii\console\Controller;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class SendSmsController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex()
    {
        $smsGateway = SmsGatewayMeConfig::getAuthentication();
        $deviceID = SmsGatewayMeConfig::getDeviceId();
        $send_at = SmsGatewayMeConfig::getSendAt();
        $expires_at = SmsGatewayMeConfig::getExpiresAt();
        $message = SmsGatewayMeConfig::getMessages();
        $number = Customer::getPhoneCustomer();

        $options = [
            'send_at' => strtotime($send_at), // Send the message in 10 minutes
            'expires_at' => strtotime($expires_at) // Cancel the message in 1 hour if the message is not yet sent
        ];

        //Please note options is no required and can be left out
        $smsGateway->sendMessageToManyNumbers($number, $message, $deviceID, $options);

        echo "\n" . "Send SMS Success";
    }
}
