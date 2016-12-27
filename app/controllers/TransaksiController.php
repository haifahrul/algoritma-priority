<?php

namespace app\controllers;

use app\models\Customer;
use app\models\TransaksiSparepart;
use Yii;
use app\models\Transaksi;
use app\models\Service;
use app\models\Sparepart;
use app\models\search\TransaksiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use app\components\Model;

/**
 * created zaza zayinul hikayat
 */
class TransaksiController extends Controller
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
        $searchModel = new TransaksiSearch();
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
        $model = new Transaksi();
        $modelTransaksiSparepart = [new TransaksiSparepart()];

        $dataService = Service::getKodeService();
        $dataSparepart = Sparepart::getSparepartList();

        $isAjax = Yii::$app->request->isAjax;
        $postData = Yii::$app->request->post();

        if ($model->load($postData)) {

            $modelTransaksiSparepart = Model::createMultiple(TransaksiSparepart::className());
            Model::loadMultiple($modelTransaksiSparepart, Yii::$app->request->post());

            // validate all models
            $validTransaksi = $model->validate();

            if ($validTransaksi) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if ($validTransaksiSparepart = Model::validateMultiple($modelTransaksiSparepart)) {
                            foreach ($modelTransaksiSparepart as $transaksiSparepart) {
                                $transaksiSparepart->transaksi_id = $model->id;
                                if (!($flag = $transaksiSparepart->save(false))) {
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

        if ($isAjax) {
            //render view
            return $this->renderAjax('create', [
                'model' => $model,
                'dataService' => $dataService,
                'dataSparepart' => $dataSparepart,
                'modelTransaksiSparepart' => $modelTransaksiSparepart
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'dataService' => $dataService,
                'dataSparepart' => $dataSparepart,
                'modelTransaksiSparepart' => $modelTransaksiSparepart
            ]);
        }
    }

    // AJAX | Get Data Customer and Kendaraan
    public function actionGetCustomer($id)
    {
        $customerId = Yii::$app->db->createCommand('SELECT `customer_id` FROM {{service}} WHERE `id`=:id')
            ->bindValue(':id', $id)
            ->queryOne();
        $customerId = $customerId['customer_id'];

        $customer = Yii::$app->db->createCommand('SELECT nama, no_telp FROM {{customer}} WHERE `id`=:id')
            ->bindValue(':id', $customerId)
            ->queryOne();

        $kendaraan = Yii::$app->db->createCommand('SELECT `no_plat` FROM {{kendaraan}} WHERE `customer_id`=:customer_id')
            ->bindValue(':customer_id', $customerId)
            ->queryOne();

        echo json_encode([
            'nama' => $customer['nama'],
            'no_telp' => $customer['no_telp'],
            'no_plat' => $kendaraan['no_plat']
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $dataService = Service::getKodeService();
        $dataSparepart = Sparepart::getSparepartList();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', ' Data has been saved!');
            return $this->redirect(['index']);
        } else {
            if (Yii::$app->request->isAjax) {
                return $this->renderAjax('update', [
                    'model' => $model,
                    'dataService' => $dataService,
                    'dataSparepart' => $dataSparepart
                ]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'dataService' => $dataService,
                    'dataSparepart' => $dataSparepart
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

                $model = Transaksi::findOne($key);
                if ($model->delete())
                    $status = 1;
                else
                    $status = 2;
            endforeach;

            //$model = Transaksi::findOne($keys);
            //$model->delete();
            //$status=3;
        }
        // retrun nya json
        echo Json::encode([
            'status' => $status,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Transaksi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
