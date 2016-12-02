<?php

namespace app\modules\webmaster\controllers;

use Yii;
use app\modules\webmaster\models\AuthItem;
use app\modules\webmaster\models\AuthItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * AuthItemController implements the CRUD actions for AuthItem model.
 */
class RoleController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
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
     * Lists all AuthItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthItemSearch([
            'type'=>1
        ]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model =  $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new AuthItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthItem();

        if ($model->load(Yii::$app->request->post())) {
            $auth = Yii::$app->authManager;
            $admin = $auth->createRole($model->name);
            $auth->add($admin);
            $model->save();
            return $this->redirect(['view', 'id' => $model->name]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $auth = Yii::$app->authManager;
            $admin = $auth->createRole($model->name);
            $auth->update($model->name,$admin);
            $model->save();
            return $this->redirect(['view', 'id' => $model->name]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDetail($name)
    {
        $result ;
        $tr;
        
        $sql = "SELECT username, email, status From auth_assignment a, public.user b WHERE a.user_id::INTEGER = b.id and a.item_name = :name  ";
        $model =  Yii::$app->db->createCommand($sql)
            ->bindValue(":name", $name)
            ->queryAll();
        if($model!=null){
        $result ='
        <table class="table table-bordered table-striped">
            <thead style = "background-color :rgba(0, 113, 179, 0.29)  ">
              <tr>
                <th>username</th>        
                <th>email</th>        
                <th>status</th>                
              </tr>
            </thead><tbody>';

            foreach ($model as $key => $value) {
                $x = '';
                if($value['status'] == 10 )
                    $x = '<span class="label label-success glyphicon glyphicon-ok glyphicon-bg">&nbsp;</span>';
                else 
                    $x = '<span class="label label-warning glyphicon glyphicon-minus glyphicon-bg">&nbsp;</span>';
                // echo "<tr><td>".$value['name']."</td></tr>";
                $tr.='<tr>';
                $tr=$tr.'<td class="text-center">'.$value['username'].'</td>';
                $tr=$tr.'<td class="text-center">'.$value['email'].'</td>';
                $tr=$tr.'<td class="text-center">'.$x.'</td></tr>';
            }
            $tr=$tr.'</tbody>
            </table>';
            $result = $result.$tr;
        }
        else{
            $result =  "Empty";
        }

        echo \yii\helpers\Json::encode([
            'result' => $result,
        ]);   
    }

    /**
     * Deletes an existing AuthItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $auth = Yii::$app->authManager;
        $admin = $auth->createRole($model->name);
        $auth->remove($admin);

        return $this->redirect(['index']);
    }
    

    /**
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionPermission($roleName, $permissionName)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $auth = Yii::$app->authManager;
        $roleExist = $auth->getRole($roleName);
        $msg = 'no exec';
        if($roleExist){
            $role = $auth->createRole($roleName);
            $permissionExist = $auth->getPermission($permissionName);
                if($permissionExist){
                    $permission = $auth->createPermission($permissionName);
                }
                else{
                    $permission = $auth->createPermission($permissionName);
                    $auth->add($permission);
                }

            if($auth->hasChild ( $role, $permission )){
                $auth->removeChild($role, $permission);
                $auth->remove($permission);
                $msg = 'permission removed'.$roleName;
            }
            else{
                $auth->addChild($role, $permission);
                $msg = 'permission added';
            }
        }

        return ['data' => $msg];
    }
//by zaza
    public function actionGenerateall(){
        $types = \app\modules\webmaster\models\Route::find()->select('name')->where(['status' => 1])->groupBy(['name'])->all();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            //update role
          
            $auth = Yii::$app->authManager;
        foreach ($types as $type) {

            if(isset($_GET['roleName'])){
                $roleName = $_GET['roleName'];    
            }else {
                $roleName = ""; 
            }   
            $roleName = $_GET['roleName'];
            echo $roleName;
            $permissionName= $type->name;
            $roleExist = $auth->getRole($roleName);
            if($roleExist){
                $msg = 'no exec'.$roleName;
            } else{
                $msg = 'no exec'.$roleName.'tidak adda';

            }
            if($roleExist){
                $role = $auth->createRole($roleName);
                $permissionExist = $auth->getPermission($permissionName);
                    if($permissionExist){
                        $permission = $auth->createPermission($permissionName);
                    }
                    else{
                        $permission = $auth->createPermission($permissionName);
                        $auth->add($permission);
                    }

                if($auth->hasChild ( $role, $permission )){
                    $auth->removeChild($role, $permission);
                    $auth->remove($permission);
                    $msg = 'permission removed';
                }
                else{
                    $auth->addChild($role, $permission);
                    $msg = 'permission added'.$roleName;
                }
            }

        
        }
        return ['data' => $msg];
    }  

    public function actionSelectrole(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        //update role
          
        $auth = Yii::$app->authManager;
        if(isset($_POST['cek']) || isset($_POST['roleName']) ){
            $cecked = $_POST['cek'];
            $roleName = $_POST['roleName']; 
            // hapus semua terlebih dahulu
            \Yii::$app->db
            ->createCommand()
            ->delete('auth_item_child', "parent = '".$roleName."'")
            ->execute();        
              /*  var_dump($cecked);
                die();*/
            foreach ($cecked as $item ) {
                $permissionName= $item;
                $roleExist = $auth->getRole($roleName);
                
                if($roleExist){
                    $role = $auth->createRole($roleName);
                    $permissionExist = $auth->getPermission($permissionName);
                        if($permissionExist){
                            $permission = $auth->createPermission($permissionName);
                        }
                        else{
                            $permission = $auth->createPermission($permissionName);
                            $auth->add($permission);
                        }

                    if($auth->hasChild ( $role, $permission )){
                        $auth->removeChild($role, $permission);
                        $auth->remove($permission);
                        $msg = 'permission removed';
                    }
                    else{
                        $auth->addChild($role, $permission);
                        $msg = 'permission added'.$roleName;
                    }
                }
            }//end foreach 
        
        }
        return ['data' => $msg];
    }

    public function actionSelectreset(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        // hapus semua terlebih dahulu
        if(isset($_POST['roleName'])){
            $roleName = $_POST['roleName'];
        }else{
            $roleName = "";
        }

        try{
            \Yii::$app->db
            ->createCommand()
            ->delete('auth_item', "type != 1 and name = '".$roleName."'")
            ->execute();
            $msg = "successful";        
        }catch(Exception $ex){
            $msg = "Berhasil";    
        }
       //update role
        return ['data' => $msg];
    }
}
