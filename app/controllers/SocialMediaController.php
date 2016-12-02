<?php

namespace app\controllers;

use Yii;
use app\models\SocialMedia;
use app\models\SocialMediaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
/**
 * created zaza zayinul hikayat
 */
class SocialMediaController extends Controller
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
        $searchModel = new SocialMediaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id, $user_id)
    {
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('view', [
                'model' => $this->findModel($id, $user_id),
            ]);
        }else{
             return $this->render('view', [
                'model' => $this->findModel($id, $user_id),
            ]);
        }
    }


    public function actionBaru()
    {
        $model = new SocialMedia();
        $is_ajax= Yii::$app->request->isAjax;
        $postdata= Yii::$app->request->post(); 
        if ($model->load($postdata)&& $model->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            try{ 

                if($model->save()){
                    $transaction->commit();
                    $session = Yii::$app->getSession();
                    Yii::$app->session->setFlash('success', ' Data telah disimpan!');    
                    return $this->redirect(['index']);
                }
                //end if (save) 
            }catch(Exception $e){
                $transaction->rollback();
                throw $e;
            }
        } 

        if($is_ajax){
            //render view
            return $this->renderAjax('create', [
                'model' => $model,
            ]);            
        }else{    
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    public function actionUpdate($id, $user_id)
    {
        $model = $this->findModel($id, $user_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id, 'user_id' => $model->user_id]);
            return $this->redirect(['index']);
        } else {
            if(Yii::$app->request->isAjax){
                return $this->renderAjax('update', [
                    'model' => $model,
                ]);            
            }else{
                return $this->render('update', [
                    'model' => $model,
                ]);
                
            }
        }
    }

    public function actionDelete($id, $user_id)
    {

          $transaction = Yii::$app->db->beginTransaction();
          try{
            
             //query
            if($this->findModel($id, $user_id)->delete()):
                $transaction->commit();
                Yii::$app->session->setFlash('success', 'Data telah dihapus!');
                return $this->redirect(['index']);
            else:
                $transaction->rollback();
                Yii::$app->session->setFlash('warning', ' Data gagal dihapus!');
            endif;
         
         }catch(Exception $e){
            $transaction->rollback();
            Yii::$app->session->setFlash('danger', 'Fatal, Data gagal dihapus');
         }
            return $this->redirect(['index']);
    }

    // hapus menggunakan ajax
    public function actionHapusitems()
    {
    $status = 0 ;
       if(isset($_POST['keys'])){
            $keys = $_POST['keys'];
            foreach ($keys as $key ):

                $model = SocialMedia::findOne($key);
                if($model->delete())
                    $status=1;
                else
                    $status=2;
            endforeach;
            
            //$model = SocialMedia::findOne($keys);
            //$model->delete();
            //$status=3;
        }
        // retrun nya json
        echo Json::encode([
            'status' => $status  ,
        ]);          
    }


    protected function findModel($id, $user_id)
    {
        if (($model = SocialMedia::findOne(['id' => $id, 'user_id' => $user_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Halaman yang diminta tidak ada.');
        }
    }
}
