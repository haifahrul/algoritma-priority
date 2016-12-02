<?php
/**
 * Created by PhpStorm.
 * User: AlFatih
 * Date: 23/06/2016
 * Time: 5:29
 */
namespace common\components;
use yii;

class ChangeLanguage extends \yii\base\Behavior
{
    /**
     * CheckLanguage constructor.
     */
    public function changeLanguage()
    {
        if(yii::$app->getRequest()->getCookies()->has('lang')){
            \yii::$app->language = \Yii::$app->getRequest()->getCookies()->getValue('lang');
        }
    }

    public  function events(){
        return [
            \yii\web\Application::EVENT_BEFORE_REQUEST=>'changeLanguage'
        ];
    }
}


/*
cara menggunakan
yii message/config @app/config/i18n.php

-- setting di config web 
'as beforeRequest'=>[
    'class'=>'app\behaviors\ChangeLanguage' ,
],
'component'=> [
...
    'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php', // contohnya \Yii::t('app', 'Hello, {username}!', [//'username' => $username,]);
                    ],
                ],
            ],
    ],
    ...
]
*/
