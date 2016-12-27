<?php

namespace app\controllers;

use app\models\Customer;
use app\models\Kendaraan;
use app\models\ServiceDetail;
use app\models\TransaksiSparepart;
use app\modules\webmaster\models\Config;
use Yii;
use app\models\Transaksi;
use app\models\Service;
use app\models\Sparepart;
use app\models\search\TransaksiSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use app\components\Model;
use kartik\mpdf\Pdf;

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
        $transaksi = Transaksi::find()->joinWith(['service', 'customer', 'kendaraan'])->where(['transaksi.id' => $id])->asArray()->one();
        $transaksiSparepart = TransaksiSparepart::find()->joinWith(['sparepart'])->where(['transaksi_id' => $transaksi['id']])->asArray()->all();

        $query = TransaksiSparepart::find()->asArray();
        $query->joinWith(['sparepart']);
        $query->where(['transaksi_id' => $transaksi['id']]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('view', [
            'transaksi' => $transaksi,
            'transaksiSparepart' => $transaksiSparepart,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionCheckout($id)
    {
        $model = new Transaksi();
        $dataService = Service::findOne($id)->toArray();
        $dataServiceDetail = ServiceDetail::find()->joinWith(['sparepart'])->where(['service_id' => $dataService['id']])->asArray()->all();
        $dataCustomer = Customer::findOne($dataService['customer_id'])->toArray();
        $dataKendaraan = Kendaraan::findOne($dataService['kendaraan_id'])->toArray();
        $dataProvider = ServiceDetail::find()->joinWith(['sparepart'])->where(['service_id' => $dataService['id']])->asArray();
        $dataProvider = new ActiveDataProvider([
            'query' => $dataProvider,
        ]);

        $data = [];
        foreach ($dataServiceDetail AS $value) {
            $data[] = $value['qty'] * $value['sparepart']['harga'];
        }
        $totalPembayaran = array_sum($data);

        if ($model->load(Yii::$app->request->post())) {
            // validate models transaksi
            $validTransaksi = $model->validate();

            if ($validTransaksi) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    $model->service_id = $id;
                    $model->customer_id = $dataService['customer_id'];
                    $model->kendaraan_id = $dataService['kendaraan_id'];
                    $model->nota = Config::getConfig('transaksi')['value'] . '-' . $dataService['kode_service'];

                    $service = Service::findOne($id);
                    $service->updateAttributes(['status' => Service::CHECKOUT]);

                    if ($flag = $model->save(false)) {
                        foreach ($dataServiceDetail as $value) {
                            $transaksiSparepart = new TransaksiSparepart();
                            $transaksiSparepart->transaksi_id = $model->id;
                            $transaksiSparepart->sparepart_id = $value['sparepart_id'];
                            $transaksiSparepart->qty = $value['qty'];
                            $transaksiSparepart->harga = $value['sparepart']['harga'];

                            // Update Stok
                            $sparepart = Sparepart::findOne($value['sparepart_id']);
                            $stok = $sparepart->stok - $value['qty'];
                            $sparepart->updateAttributes(['stok' => $stok]);

                            if (!($flag = $transaksiSparepart->save(false))) {
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

        return $this->render('checkout', [
            'model' => $model,
            'dataService' => $dataService,
            'dataCustomer' => $dataCustomer,
            'dataKendaraan' => $dataKendaraan,
            'dataProvider' => $dataProvider,
            'totalPembayaran' => $totalPembayaran
        ]);
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

    public function actionPrint($id)
    {
        $transaksi = Transaksi::find()->joinWith(['service', 'customer', 'kendaraan'])->where(['transaksi.id' => $id])->asArray()->one();
        $transaksiSparepart = TransaksiSparepart::find()->joinWith(['sparepart'])->where(['transaksi_id' => $transaksi['id']])->asArray()->all();

        $query = TransaksiSparepart::find()->asArray();
        $query->joinWith(['sparepart']);
        $query->where(['transaksi_id' => $transaksi['id']]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('print', [
            'transaksi' => $transaksi,
            'transaksiSparepart' => $transaksiSparepart,
            'dataProvider' => $dataProvider
        ]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
//            'destination' => Pdf::DEST_FILE,
            // your html content input
//            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => ['title' => $transaksi['nota']],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader' => [$transaksi['nota']],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

//        $pdf = new Pdf(); // or new Pdf();
//        $mpdf = $pdf->getApi(); // fetches mpdf api
//        $pdf->cssFile = '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css';
//        $pdf->cssInline = '.kv-heading-1{font-size:18px}';
//        $pdf->SetHeader('Kartik Header'); // call methods or set any properties
//        $pdf->WriteHtml($content); // call mpdf write html
        echo $pdf->output($content, $transaksi['nota'] . '.pdf', 'D'); // call the mpdf api output as needed

        // return the pdf output as per the destination setting
//        return $pdf->render();
    }
}