<?php

namespace app\modules\SmsGatewayMe\controllers;

use app\modules\SmsGatewayMe\models\SmsGatewayMeConfig;
use yii\web\Controller;

/**
 * Default controller for the `SmsGatewayMe` module
 */
class ListMessagesController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $smsGateway = SmsGatewayMeConfig::getAuthentication();
        $page = SmsGatewayMeConfig::getPage();

        $result = $smsGateway->getMessages($page);

        return $this->render('index', ['result' => $result]);
    }
}
