<?php
namespace app\modules\webmaster\controllers;

use app\models\LoginForm;
use Yii;
use app\modules\webmaster\models\User;
use app\modules\webmaster\models\AuthAssignment;
use app\modules\webmaster\models\AuthItem;
use app\modules\webmaster\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller {
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => TRUE,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionView($id) {
        $model = $this->findModel($id);
        $authAssignments = AuthAssignment::find()->where([
            'user_id' => $model->id,
        ])->column();
        $authItems = ArrayHelper::map(AuthItem::find()->where([
            'type' => 1,
        ])->asArray()->all(), 'name', 'name');
        $authAssignment = new AuthAssignment([
            'user_id' => $model->id,
        ]);
        if (Yii::$app->request->post()) {
            $authAssignment->load(Yii::$app->request->post());
            if (isset($_POST['reset'])) {
                //reset semua auth issetment
                $sql = 'DELETE FROM auth_assignment WHERE user_id =:id ';
                \Yii::$app->db->createCommand($sql)->bindValue(':id', $model->id)->execute();
            } else {
                foreach ($authAssignment->item_name as $item) {
                    if (!in_array($item, $authAssignments)) {
                        $authAssignment2 = new AuthAssignment([
                            'user_id' => $model->id,
                        ]);
                        $authAssignment2->item_name = $item;
                        $authAssignment2->created_at = time();
                        $authAssignment2->save();
                    } else {
                        //$model = AuthAssignment::findOne(['user_id' => $model->id, 'item_name'=>$item]);
                        //echo $item->nami
                        //$model->delete();
                        // $sql= 'DELETE FROM auth_assignment WHERE user_id =:id AND item_name != :name';
                        // \Yii::$app->db->createCommand($sql)
                        //   ->bindValue(':id', $model->id)
                        //   ->bindValue(':name', $item)
                        //   ->execute();
                        // echo $item.'<br>';
                    }
                    // endlooping
                }
            }
            $authAssignments = AuthAssignment::find()->where([
                'user_id' => $model->id,
            ])->column();
            Yii::$app->session->setFlash('success', 'Data tersimpan');
        }
        $authAssignment->item_name = $authAssignments;

        return $this->render('view', [
            'model' => $model,
            'authAssignment' => $authAssignment,
            'authItems' => $authItems,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new User();
        if ($model->load(Yii::$app->request->post())) {
            $model->setPassword('123456');
            //$baru = $model->isNewRecord;
            if ($model->save()) {
                // tambah role default:
                $auth = Yii::$app->authManager;
                $authorRole = $auth->getRole('user');
                $auth->assign($authorRole, $model->id);
                Yii::$app->session->setFlash('success', 'User berhasil dibuat dengan password 123456');
            } else {
                Yii::$app->session->setFlash('error', 'User gagal dibuat');
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model->old_password = $model->password_hash;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (!empty($model->new_password)) {
                //$model->scenario = "update";
                //if($model->validatePassword($model->old_password)){
                $model->setPassword($model->new_password);
                //}
            }
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'User berhasil diupdate');

                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', 'User gagal diupdate');
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        $authAssignments = AuthAssignment::find()->where([
            'user_id' => $model->id,
        ])->all();
        foreach ($authAssignments as $authAssignment) {
            $authAssignment->delete();
        }
        Yii::$app->session->setFlash('success', 'Delete success');
        $model->delete();

        return $this->redirect(['index']);
    }

    public function actionLoginAsUser($id) {
        if (Yii::$app->user->can('webmaster')) {
            $login = new LoginForm();
            $user = $this->findModel($id);
            $login->username = $user->username;
            $login->password = $user->password_hash;
            if ($login->login()) {
                Yii::$app->session->setFlash('success', 'You are logged as ' . $user->username);

                return $this->redirect(['/admin/dashboard/']);
            } else {
                Yii::$app->session->setFlash('danger', 'You are not authorized!');

                return $this->redirect(['index']);
            }
            //return var_dump($user);
        } else {
            Yii::$app->session->setFlash('danger', 'You are not authorized!');
            //return $this->redirect(['index']);
        }
        //return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== NULL) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
