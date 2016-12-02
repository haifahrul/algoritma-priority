<?php

namespace app\modules\webmaster\controllers;

use yii\web\Controller;

/**
 * Default controller for the `webmaster` module
 */
class DashboardController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
