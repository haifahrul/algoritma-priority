<?php
namespace app\modules\webmaster;

use Yii;

/**
 * webmaster module definition class
 */
class Module extends \yii\base\Module {
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\webmaster\controllers';

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
        // custom initialization code goes here
        $this->defaultRoute = '/webmaster/dashboard';
        Yii::$app->setHomeUrl(Yii::$app->urlManager->baseUrl . '/webmaster/dashboard');
        Yii::$app->errorHandler->errorAction = 'webmaster/site/error';
        Yii::$app->view->theme->baseUrl = '@app/themes/';
        Yii::$app->view->theme->pathMap = [
            '@app/views' => '@app/themes/adminlte',
            '@app/views' => '@app/themes/gentellela',
        ];
    }
}
