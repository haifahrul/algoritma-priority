<?php
namespace app\modules\webmaster\controllers;

use Yii;
use app\models\LoginForm;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * Default controller for the `webmaster` module
 */
class LoginController extends Controller {
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function beforeAction($action) {
        if ($action->id == 'error') {
            $this->layout = '@app/themes/gentellela/layouts/blank-page';
        }

        return parent::beforeAction($action);
    }

    public function actionIndex() {
        $this->layout = '@app/themes/gentellela/layouts/login';
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->can('webmaster')) {
                return $this->redirect(['/webmaster/dashboard/index']);
            } else if (Yii::$app->user->can('admin')) {
                return $this->redirect(['/admin/dashboard/index']);
            }
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (Yii::$app->user->can('webmaster')) {
                return $this->redirect(['/webmaster/dashboard/index']);
            } else if (Yii::$app->user->can('admin')) {
                return $this->redirect(['/admin/dashboard/index']);
            }
            //return $this->redirect(['dashboard/index']);
        } else {
            return $this->render('/site/login', [
                'model' => $model,
            ]);
        }
    }
}
