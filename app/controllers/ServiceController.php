<?php

namespace app\controllers;

use app\models\Customer;
use app\models\Kendaraan;
use Yii;
use app\models\Service;
use app\models\search\ServiceSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * created zaza zayinul hikayat
 */
class ServiceController extends Controller
{
    CONST DONE = 1;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'], /// Action delete hanya diizinkan post saja 
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new ServiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionQueue()
    {
        $searchModel = new ServiceSearch();
        $dataProvider = $searchModel->searchQueue(Yii::$app->request->queryParams);

        return $this->render('queue', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('view', [
                'model' => $this->findModel($id),
            ]);
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    public function actionCreate()
    {
        $model = new Service();
        $dataCustomer = ArrayHelper::map(Customer::find()->select('id, nama')->all(), 'id', 'nama');
        $dataKendaraan = ArrayHelper::map(Kendaraan::find()->select('id, no_plat')->all(), 'id', 'no_plat');

        $is_ajax = Yii::$app->request->isAjax;
        $postdata = Yii::$app->request->post();

        if ($model->load($postdata) && $model->validate()) {

            $model->kode_service = $model->generateServiceCode()[0];

            $transaction = Yii::$app->db->beginTransaction();
            try {
                if ($model->save()) {
                    $lastCode = $model->generateServiceCode()[1];
                    Yii::$app->db->createCommand("UPDATE `attribute` SET `position`=" . $lastCode . " WHERE `name`='Count Code Service' OR `type`='Count Code Service'")->execute();
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', ' Data telah disimpan!');
                    return $this->redirect(['index']);
                }
                //end if (save) 
            } catch (Exception $e) {
                $transaction->rollback();
                throw $e;
            }
        }

        if ($is_ajax) {
            //render view
            return $this->renderAjax('create', [
                'model' => $model,
                'dataCustomer' => $dataCustomer,
                'dataKendaraan' => $dataKendaraan
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'dataCustomer' => $dataCustomer,
                'dataKendaraan' => $dataKendaraan
            ]);

        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $dataCustomer = ArrayHelper::map(Customer::find()->select('id, nama')->where(['id' => $model->customer_id])->all(), 'id', 'nama');
        $dataKendaraan = ArrayHelper::map(Kendaraan::find()->select('id, no_plat')->where(['id' => $model->kendaraan_id])->all(), 'id', 'no_plat');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', ' Data has been saved!');
            return $this->redirect(['index']);
        } else {
            if (Yii::$app->request->isAjax) {
                return $this->renderAjax('update', [
                    'model' => $model,
                    'dataCustomer' => $dataCustomer,
                    'dataKendaraan' => $dataKendaraan
                ]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'dataCustomer' => $dataCustomer,
                    'dataKendaraan' => $dataKendaraan
                ]);

            }
        }
    }

    public function actionDelete($id)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if ($this->findModel($id)->updateAttributes(['deleted' => 1])):
                $transaction->commit();
                Yii::$app->session->setFlash('success', 'Data has been removed!');
                return $this->redirect(['index']);
            else:
                $transaction->rollback();
                Yii::$app->session->setFlash('warning', 'Data failed removed!');
            endif;

        } catch (Exception $e) {
            $transaction->rollback();
            Yii::$app->session->setFlash('danger', 'Failure, Data failed removed');
        }
        return $this->redirect(['index']);
    }

    // hapus menggunakan ajax
    public function actionDeleteItems()
    {
        $status = 0;
        if (isset($_POST['keys'])) {
            $keys = $_POST['keys'];
            foreach ($keys as $key):
                $model = Service::findOne($key);
                if ($model->updateAttributes(['deleted' => 1]))
                    $status = 1;
                else
                    $status = 2;
            endforeach;
        }
        // retrun nya json
        echo Json::encode([
            'status' => $status,
        ]);
    }


    protected function findModel($id)
    {
        if (($model = Service::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionListKendaraan()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $id = $parents[0];
                $out = Kendaraan::getListKendaraan($id);

                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionDone($id)
    {
        $model = $this->findModel($id);
        $model->updateAttributes(['status' => Service::SUDAH]);

        return $this->redirect(['queue']);
    }
}
