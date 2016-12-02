<?php
namespace app\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\LoginForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\SignupForm;
use app\models\ContactForm;
use app\models\SocialMedia;
use app\models\User;
use yii\helpers\Url;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => [''],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
            ],
            // auth sosial media
            'auth'=>[
                'class'=>'yii\authclient\AuthAction',
                'successCallback' =>[
                    $this, 'successCallback'
                ]
            ]
        ];
    }

    public function successCallback($client){
        $attributes = $this->safeAttributes($client);
        // cari data di database
        $user_social_media = SocialMedia::find()
            ->where([
                'social_media'=>$attributes['social_media'], 
                'id' =>(string)$attributes['id'],
                'username'=>$attributes['username']
            ])->one();
                // var_dump($attributes['id']);
                // die($user_social_media);
        // if found
        if($user_social_media){
            //get relasi
            $user = $user_social_media->user;
            // cek user is aktif
            if($user->status == User::STATUS_ACTIVE){
                // otomatis login
                Yii::$app->user->login($user);
            }else{
                Yii::$app->session->setFlash('error', 'Gagal Login status user tidak aktif');
            }
        }else{
            // jika user sosial media tidak ada cek email di db
            $user = User::find()
                ->where([
                    'email'=>$attributes['email']
                ])->one();
            // jika user ada
            if($user){
                if($user->status == User::STATUS_ACTIVE){
                    // tambah ke tbl sosial media
                    $user_social_media = new SocialMedia([
                        'social_media'=>$attributes['social_media'],
                        'id'=>(string)$attributes['id'],
                        'username'=>$attributes['username'],
                        'user_id'=> $user->id
                    ]);

                    //simpan aktif record
                    $user_social_media->save();
                    Yii::$app->user->login($user);
                }else{
                    Yii::$app->session->setFlash('error', 'Gagal Login status user tidak aktif');
                    
                }
            }else{
                // jika blum terdaftar
                if($attributes['social_media'] != 'twitter'){
                    // automatic signup
                    $password = Yii::$app->security->generateRandomString(6);
                    // new user
                    $user = new User([
                        'username'=>$attributes['username'],
                        'email'=>$attributes['email'],
                        'password'=>$password,
                    ]);

                    $user->generateAuthKey();
                    $user->generatePasswordResetToken();
                    $user->generatePasswordResetToken();
                    if($user->save()){
                        $user_social_media = new SocialMedia([
                            'social_media'=>$attributes['social_media'],
                            'id'=>(string)$attributes['id'],
                            'username'=>$attributes['username'],
                            'user_id'=>$user->id,
                        ]);

                        // simpan 
                        $user_social_media->save();
                        //otomatis login 
                        Yii::$app->user->login($user);

                    }else{
                        Yii::$app->session->setFlash('error', 'Gagal saat registrasi');
                    }

                }else{
                    // simpan attribut disession 
                    $session = Yii::$app->session;
                    $session['attributes']= $attributes;
                    // redirect signup
                    $this->action->successUrl = Url::to(['signup']); 
                }
            }
        }

        
    }

    public function safeAttributes($client){
        // user signup ata login disin funsinya get attrubute
        $attributes = $client->getUserAttributes();
        // set default  attribut
        $safe_attributes =[
            'social_media'=>'',
            'id'=>'',
            'username'=>'',
            'name'=>'',
            'email'=>''
        ];

        // tangkap nilai attribut base on sosial media
        if($client instanceof \yii\authclient\clients\Facebook){
            $safe_attributes = [
                'social_media'=>'facebook',
                'id'=>$attributes['id'],
                'username'=>$attributes['email'],
                'name'=>$attributes['name'],
                'email'=>$attributes['email'],
            ];
        }

        return $safe_attributes;

    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    //ganti bahasa
    public function actionChangeLanguage(){
        if(isset($_POST['lang'])){
            Yii::$app->language = $_POST['lang'];
            $cookie = new yii\web\Cookie([
                'name'=>'lang',
                'value'=>$_POST['lang']
            ]);
        }
        yii::$app->getResponse()->getCookies()->add($cookie);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        //get session attribute
        $session = Yii::$app->session;
        $attributes = $session['attributes'];

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                // cek session attribute
                if($session->has('attributes')){
                    // tambah user sosmed
                    $user_social_media = new SocialMedia([
                        'social_media'=>$attributes['social_media'],
                        'id'=>(string)$attributes['id'],
                        'username'=>$attributes['username'],
                        'user_id'=>$user->id,
                    ]);

                    //simpan
                    $user_social_media->save();
                    if (Yii::$app->getUser()->login($user)) {
                        return $this->goHome();
                    }
                }
            }
        }

        //fill username dan password
        if($session->has('attributes')){
            $model->username=$attributes['username'];
            $model->email=$attributes['email'];
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
