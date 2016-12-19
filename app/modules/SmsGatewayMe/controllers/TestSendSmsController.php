<?php

namespace app\modules\SmsGatewayMe\controllers;

use app\modules\SmsGatewayMe\components\SmsGatewayMe;
use app\modules\SmsGatewayMe\models\SmsGatewayMeConfig;
use yii\base\DynamicModel;
use yii\web\Controller;
use Yii;

/**
 * Default controller for the `SmsGatewayMe` module
 */
class TestSendSmsController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model = new DynamicModel(['number', 'message']);
        $model->addRule(['number', 'message'], 'required');
        $model->addRule(['message'], 'string', ['max' => 128]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            $smsGateway = SmsGatewayMeConfig::getAuthentication();
            $deviceID = SmsGatewayMeConfig::getDeviceId();
            $send_at = SmsGatewayMeConfig::getSendAt();
            $expires_at = SmsGatewayMeConfig::getExpiresAt();
            $number = $model->number;
            $message = $model->message;
            $options = [
                'send_at' => strtotime($send_at), // Send the message in 10 minutes
                'expires_at' => strtotime($expires_at) // Cancel the message in 1 hour if the message is not yet sent
            ];
            //Please note options is no required and can be left out
            $result = $smsGateway->sendMessageToNumber($number, $message, $deviceID, $options);

            if ($result) {
                Yii::$app->session->setFlash('success', 'Pesan terkirim!');
                $transaction->commit();
            } else {
                Yii::$app->session->setFlash('false', 'Data gagal dikirim. Cek koneksi Android Anda dan pastikan ada pulsa!');
                $transaction->rollBack();
            }
        }

        return $this->render('index', ['model' => $model]);
    }
}
