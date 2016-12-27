<?php

namespace app\controllers;

use app\models\Customer;
use app\models\Kendaraan;
use app\models\search\ServiceDetailSearch;
use app\models\ServiceDetail;
use app\models\Sparepart;
use Yii;
use app\models\Service;
use app\models\search\ServiceSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use app\components\Model;

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
        $model = $this->findModel($id);
        $serviceId = $model->id;
        $modelServiceDetail = new ServiceDetailSearch();
        $dataProvider = $modelServiceDetail->search(Yii::$app->request->queryParams, $serviceId);

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('view', [
                'model' => $model,
                'dataProvider' => $dataProvider
            ]);
        } else {
            return $this->render('view', [
                'model' => $model,
                'dataProvider' => $dataProvider
            ]);
        }
    }

    public function actionCreate()
    {
        $model = new Service();
        $dataCustomer = ArrayHelper::map(Customer::find()->select('id, nama')->all(), 'id', 'nama');
        $dataSparepart = ArrayHelper::map(Sparepart::find()->asArray()->all(), 'id', 'nama');
        $modelServiceDetail = [new ServiceDetail()];
        $is_ajax = Yii::$app->request->isAjax;
        $postdata = Yii::$app->request->post();

        if ($model->load($postdata)) {

            $modelServiceDetail = Model::createMultiple(ServiceDetail::className());
            Model::loadMultiple($modelServiceDetail, Yii::$app->request->post());

            // ajax validation
//            if (Yii::$app->request->isAjax) {
//                Yii::$app->response->format = Response::FORMAT_JSON;
//                return ArrayHelper::merge(
//                    ActiveForm::validateMultiple($modelServiceDetail),
//                    ActiveForm::validate($model)
//                );
//            }

            // validate model service
            $validService = $model->validate();

            if ($validService) {
                $model->kode_service = $model->generateServiceCode()[0];
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        Service::setLastCode($model->generateServiceCode()[1]);
                        // validate model service detail
                        $validServiceDetail = Model::validateMultiple($modelServiceDetail);

                        if ($validServiceDetail) {
                            foreach ($modelServiceDetail as $dataServiceDetail) {
                                $dataServiceDetail->service_id = $model->id;
                                if (!($flag = $dataServiceDetail->save(false))) {
                                    $transaction->rollBack();
                                    break;
                                }
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        if ($is_ajax) {
            //render view
            return $this->renderAjax('create', [
                'model' => $model,
                'dataCustomer' => $dataCustomer,
                'dataSparepart' => $dataSparepart,
                'modelServiceDetail' => (empty($modelServiceDetail)) ? [new ServiceDetail()] : $modelServiceDetail
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'dataCustomer' => $dataCustomer,
                'dataSparepart' => $dataSparepart,
                'modelServiceDetail' => (empty($modelServiceDetail)) ? [new ServiceDetail()] : $modelServiceDetail
            ]);

        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelServiceDetail = ServiceDetail::find()->where(['service_id' => $model->id])->all();
        $dataCustomer = ArrayHelper::map(Customer::find()->select('id, nama')->where(['id' => $model->customer_id])->all(), 'id', 'nama');
        $dataKendaraan = ArrayHelper::map(Kendaraan::find()->select('id, no_plat')->where(['customer_id' => $model->customer_id])->all(), 'id', 'no_plat');
        $dataSparepart = ArrayHelper::map(Sparepart::find()->asArray()->all(), 'id', 'nama');

        if ($model->load(Yii::$app->request->post())) {
            $oldIDs = ArrayHelper::map($modelServiceDetail, 'service_id', 'service_id');
            $modelServiceDetail = Model::createMultiple(ServiceDetail::className(), $modelServiceDetail);
            Model::loadMultiple($modelServiceDetail, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelServiceDetail, 'service_id', 'service_id')));

            // ajax validation
//            if (Yii::$app->request->isAjax) {
//                Yii::$app->response->format = Response::FORMAT_JSON;
//                return ArrayHelper::merge(
//                    ActiveForm::validateMultiple($modelServiceDetail),
//                    ActiveForm::validate($model)
//                );
//            }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelServiceDetail) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (!empty($deletedIDs)) {
                            ServiceDetail::deleteAll(['service_id' => $deletedIDs]);
                        }
                        foreach ($modelServiceDetail as $serviceDetail) {
                            $serviceDetail->service_id = $model->id;
                            if (!($flag = $serviceDetail->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelServiceDetail' => (empty($modelServiceDetail)) ? [new ServiceDetail()] : $modelServiceDetail,
            'dataCustomer' => $dataCustomer,
            'dataKendaraan' => $dataKendaraan,
            'dataSparepart' => $dataSparepart,
        ]);
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

        if ($model->updateAttributes(['status' => Service::SUDAH])) {
            Yii::$app->session->setFlash('success', 'Data has been saved!');
        } else {
            Yii::$app->session->setFlash('dabger', 'Data failed to save!');
        }

        return $this->redirect(['queue']);
    }
}
