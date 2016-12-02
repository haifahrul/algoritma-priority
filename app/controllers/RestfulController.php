<?php

namespace app\controllers;
use yii\rest\Controller;
use app\models\User;

// restfull aplikasi
class RestfulController extends Controller
{
    protected function verbs()
    {
        return[
            'get-users'=>['GET'] // filter method get yang diizinkan
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors(); // yng bisa akses user yg terdaftar
        $behaviors['authenticator'] = [
            'class'=> \yii\filters\auth\QueryParamAuth::className(),
            // 'tokenParam'=> 'key', // default param token is access-token
        ];
        return $behaviors;
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGetUsers(){
        $users = User::find()->all();
        return [
            'result'=>$users
        ]; // get data user " localhost/ecommerce/restfull/get-users?access-token= $auth_key "
    }

}
