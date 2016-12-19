<?php

namespace app\controllers;

use app\models\Customer;
use app\models\Service;
use Yii;
use app\models\Kendaraan;
use app\models\search\KendaraanSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * created zaza zayinul hikayat
 */
class KendaraanController extends Controller
{
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
        $searchModel = new KendaraanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
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
        $model = new Kendaraan();
        $is_ajax = Yii::$app->request->isAjax;
        $postdata = Yii::$app->request->post();
        $dataCustomer = Customer::find()->asArray()->all();
        $dataCustomer = ArrayHelper::map($dataCustomer, 'id', 'nama');

        if ($model->load($postdata) && $model->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            try {

                if ($model->save()) {
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
                'dataCustomer' => $dataCustomer
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'dataCustomer' => $dataCustomer
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $idCustomer = $model->customer_id;
        $dataCustomer = Customer::find()->asArray()->all();
        $dataCustomer = ArrayHelper::map($dataCustomer, 'id', 'nama');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // If Customer ID update
            if ($model->customer_id != $idCustomer) {
                Yii::$app->db->createCommand('UPDATE service SET customer_id=' . $model->customer_id . ' WHERE kendaraan_id=' . $model->id)->execute();
            }
            $model->save();

            Yii::$app->session->setFlash('success', ' Data has been saved!');
            return $this->redirect(['index']);
        } else {
            if (Yii::$app->request->isAjax) {
                return $this->renderAjax('update', [
                    'model' => $model,
                    'dataCustomer' => $dataCustomer
                ]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'dataCustomer' => $dataCustomer
                ]);

            }
        }
    }

    public function actionDelete($id)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {

            //query
            if ($this->findModel($id)->delete()):
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

                $model = Kendaraan::findOne($key);
                if ($model->delete())
                    $status = 1;
                else
                    $status = 2;
            endforeach;

            //$model = Kendaraan::findOne($keys);
            //$model->delete();
            //$status=3;
        }
        // retrun nya json
        echo Json::encode([
            'status' => $status,
        ]);
    }

    public function actionService($id)
    {
        $model = new Service();
        $service = $this->findModel($id);
        $model->scenario = 'createFromKendaraan';

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->kode_service = $model->generateServiceCode();
            $model->customer_id = $service->customer_id;
            $model->kendaraan_id = $service->id;

            $transaction = Yii::$app->db->beginTransaction();
            try {

                if ($model->save()) {
                    $lastCode = $model->generateServiceCode()[1];
                    Yii::$app->db->createCommand("UPDATE `attribute` SET `position`=" . $lastCode . " WHERE `name`='Count Code Service' OR `type`='Count Code Service'")->execute();
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', ' Data has been saved!');
                    return $this->redirect(['/service/index']);
                }
            } catch (Exception $e) {
                $transaction->rollback();
                throw $e;
            }
        } else {
            if (Yii::$app->request->isAjax) {
                return $this->renderAjax('form-service', [
                    'model' => $model,
                    'service' => $service,
                ]);
            } else {
                return $this->render('form-service', [
                    'model' => $model,
                    'service' => $service,
                ]);

            }
        }

    }

    protected function findModel($id)
    {
        if (($model = Kendaraan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
