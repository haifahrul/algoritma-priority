<?php

namespace app\controllers;

use app\models\Kendaraan;
use app\models\Service;
use Yii;
use app\models\Customer;
use app\models\search\CustomerSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * created zaza zayinul hikayat
 */
class CustomerController extends Controller
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
        $searchModel = new CustomerSearch();
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

    public function actionCreateNewCustomer()
    {
        $model = new Customer();
        $model2 = new Kendaraan();
        $model3 = new Service();
        $model2->scenario = 'createFromCustomer';
        $model3->scenario = 'createFromCustomer';

        $is_ajax = Yii::$app->request->isAjax;
        $post = Yii::$app->request->post();
        $transaction = Yii::$app->db->beginTransaction();
        if ($model->load($post) && $model2->load($post) && $model3->load($post) && $model->validate() && $model2->validate() && $model3->validate()) {
            try {
                $model->kode_customer = $model->getLastCodeCustomer()[0];

                if ($model->save()) {
                    $lastCode = $model->getLastCodeCustomer()[1];
                    Yii::$app->db->createCommand("UPDATE `attribute` SET `position`=" . $lastCode . " WHERE `name`='Count Code Customer' OR `type`='Count Code Customer'")->execute();

                    $model2->customer_id = $model->id;
                    $model2->save();

                    $model3->customer_id = $model->id;
                    $model3->kendaraan_id = $model2->id;
                    $model3->kode_service = $model3->generateServiceCode()[0];

                    if ($model3->save()) {
                        $lastCode = $model3->generateServiceCode()[1];
                        Yii::$app->db->createCommand("UPDATE `attribute` SET `position`=" . $lastCode . " WHERE `name`='Count Code Service' OR `type`='Count Code Service'")->execute();
                    }

                    $transaction->commit();
                    Yii::$app->session->setFlash('success', ' Data telah disimpan!');

                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('danger', ' Data gagal disimpan!');
                    $transaction->rollback();

                    return $this->redirect(Yii::$app->request->referrer);
                }
            } catch (Exception $e) {
                $transaction->rollback();
                throw $e;
            }
        }

        if ($is_ajax) {
            //render view
            return $this->renderAjax('create-new-customer', [
                'model' => $model,
                'model2' => $model2,
                'model3' => $model3,
            ]);
        } else {
            return $this->render('create-new-customer', [
                'model' => $model,
                'model2' => $model2,
                'model3' => $model3,
            ]);
        }
    }

    public function actionCreate()
    {
        $model = new Customer();

        $is_ajax = Yii::$app->request->isAjax;
        $post = Yii::$app->request->post();
        $transaction = Yii::$app->db->beginTransaction();
        if ($model->load($post) && $model->validate()) {
            try {
                if ($model->save()) {
                    $transaction->commit();

                    Yii::$app->session->setFlash('success', ' Data telah disimpan!');
                    return $this->redirect(['index']);
                } else {
                    Yii::$app->session->setFlash('danger', ' Data gagal disimpan!');
                    $transaction->rollback();

                    return $this->redirect(Yii::$app->request->referrer);
                }
                //end if (save)
            } catch (Exception $e) {
                $transaction->rollback();
                throw $e;
            }
        }

        if ($is_ajax) {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
//        $model2 = Kendaraan::find()->where(['customer_id' => $model->id])->one();
//        $model3 = Service::find()->where(['customer_id' => $model->id])->andWhere(['kendaraan_id' => $model2->id])->one();

        $is_ajax = Yii::$app->request->isAjax;
        $post = Yii::$app->request->post();
        $transaction = Yii::$app->db->beginTransaction();
//        if ($model->load($post) && $model2->load($post) && $model3->load($post) && $model->validate() && $model2->validate() && $model3->validate()) {
        if ($model->load($post) && $model->validate()) {
            try {
                if ($model->save()) {

//                    $model2->customer_id = $model->id;
//                    $model2->save();
//
//                    $model3->customer_id = $model->id;
//                    $model3->kendaraan_id = $model2->id;
//                    $model3->save();

                    $transaction->commit();

                    Yii::$app->session->setFlash('success', ' Data telah disimpan!');
                    return $this->redirect(['index']);
                } else {
                    Yii::$app->session->setFlash('danger', ' Data gagal disimpan!');
                    $transaction->rollback();

                    return $this->redirect(Yii::$app->request->referrer);
                }
            } catch (Exception $e) {
                $transaction->rollback();
                throw $e;
            }
        }

        if ($is_ajax) {
            //render view
            return $this->renderAjax('update', [
                'model' => $model,
//                'model2' => $model2,
//                'model3' => $model3,
            ]);
        } else {
            return $this->render('update', [
                'model' => $model,
//                'model2' => $model2,
//                'model3' => $model3,
            ]);
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

                $model = Customer::findOne($key);
                if ($model->delete())
                    $status = 1;
                else
                    $status = 2;
            endforeach;

            //$model = Customer::findOne($keys);
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
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}