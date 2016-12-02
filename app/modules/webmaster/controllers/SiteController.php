<?php
namespace app\modules\webmaster\controllers;

use Yii;
use app\models\LoginForm;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\AccountForm;

/**
 * Default controller for the `webmaster` module
 */
class SiteController extends Controller {
    //public function behaviors() {
    //    return [
    //        'access' => [
    //            'class' => AccessControl::className(),
    //            'only' => ['logout', 'signup'],
    //            'rules' => [
    //                [
    //                    'actions' => ['signup'],
    //                    'allow' => FALSE,
    //                    'roles' => ['?'],
    //                ],
    //                [
    //                    'actions' => ['logout'],
    //                    'allow' => TRUE,
    //                    'roles' => ['@'],
    //                ],
    //            ],
    //        ],
    //        'verbs' => [
    //            'class' => VerbFilter::className(),
    //            'actions' => [
    //                'logout' => ['post'],
    //            ],
    //        ],
    //    ];
    //}
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
        return $this->render('index');
    }

    public function actionLogin() {
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
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->redirect(['login/index']);
    }

    public function actionProfile()
    {
        $model = new AccountForm();
        $model->setUser(Yii::$app->user->identity);

        if (!empty(Yii::$app->user->identity)) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', ' Data telah disimpan!');
                    return $this->refresh();
                } else {
                    Yii::$app->session->setFlash('danger', ' Data gagal disimpan!');
                    return $this->refresh();
                }
            }
        }

        return $this->render('profile', ['model' => $model]);
    }
}
