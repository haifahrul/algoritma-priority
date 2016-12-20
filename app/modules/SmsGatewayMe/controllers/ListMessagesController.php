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

        $array = [];
        foreach ($result['response']['result'] AS $item) {
            if ($item['status'] == 'pending' OR $item['status'] == 'sent') {
                $array[] = $item;
            }
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $array,
            'sort' => [
                'attributes' => ['id'],
            ],
        ]);

        if (isset($this->page)) {
            $dataProvider->pagination->pageSize = $this->page;
        }

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }
}
