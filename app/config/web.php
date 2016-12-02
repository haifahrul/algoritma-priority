<?php

require(__DIR__ . '/bootstrap.php');
$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'app',
    'homeUrl' => '/site/index',
    'name' => 'Topik',
    'basePath' => dirname(__DIR__),
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone' => 'Asia/Jakarta',
    'defaultRoute' => 'site/index',
    'bootstrap' => [
        'log',
        'app\components\PathUrl',
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
        'webmaster' => [
            'class' => 'app\modules\webmaster\Module',
        ],
    ],
//    'as access' => [
//        'class' => 'app\modules\webmaster\components\AccessControl',
//        'allowActions' => [
//            // add wildcard allowed action here!
//            'site/*',
//            // Menu User
//            'dosen/index',
//            'mata-kuliah/index',
//            'jadwal-kuliah/index',
//            'ruangan/index',
//            // Menu Admin
//            'admin/login/index',
//            'admin/site/logout',
//            // Menu Webmaster
//            'webmaster/login/index',
//            'webmaster/site/logout',
//            'debug/*',
//            'gii/*',
//            //'*',
//        ],
//    ],
    // komponen aplikasi
    'components' => [
        //class setting themes
        'menus' => [
            'class' => 'app\components\MenuItems',
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '-',
            'dateFormat' => 'php:d-M-Y',
            'datetimeFormat' => 'php:d-M-Y H.i.s',
            'timeFormat' => 'php:H.i',
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
            'currencyCode' => 'IDR',
            'defaultTimeZone' => 'Asia/Jakarta',
            'locale' => 'id-ID'
        ],
        // Themes
        'view' => [
            'theme' => [
                'basePath' => '@app/themes/',
                'baseUrl' => '@app/themes/',
                'pathMap' => [
                    '@app/views' => '@app/themes/adminlte',
//                    '@app/views' => '@app/themes/basic',
                ],
            ],
        ],
        // login sosial media
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'authUrl' => 'https://www.facebook.com/dialog/oauth?display=popup',
                    'clientId' => '913560458772795', //ID app di facebook  detailnya https://developers.facebook.com/apps/
                    'clientSecret' => '8fb64ba3c239f6f9b42ef72b588be5af'
                ],
            ]
        ],
//        'authManager' => [
//            'class' => 'yii\rbac\DbManager',
//        ],
        'request' => [
            'cookieValidationKey' => 'TOXQ9RZ_GiSwVOOCQ4ZgEsGYxbF1tDWIzaaz',
        ],
        //prety url
        'urlManager' => [
            'enablePrettyUrl' => TRUE,
            'showScriptName' => FALSE,
            'enableStrictParsing' => FALSE, // membatasi akses hanya pada aturan yang dikonfigurasi
            'rules' => [
                '/' => 'site/index',
                '<controller>/' => '<controller>/index',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<module:\w+>/<controller:\w+>/' => '<module>/<controller>/index',
                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@app/mail',
            'useFileTransport' => FALSE, // false agar bisa kirim lewat online
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => '',
                'password' => '',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => FALSE,
            'enableSession' => TRUE,
            'loginUrl' => NULL,
        ],
//        'cache' => [
//            'class' => 'yii\caching\FileCache',
//        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
//        'log' => [
//            'traceLevel' => YII_DEBUG ? 3 : 0,
//            'targets' => [
//                [
//                    'class' => 'yii\log\FileTarget',
//                    'levels' => ['error', 'warning'],
//                ],
//            ],
//        ],
        'db' => require(__DIR__ . '/db.php'),
        // 'session' => [
        //     'class' => 'yii\web\DbSession',
        //     'db' => 'db',  // the application component ID of the DB connection. Defaults to 'db'.
        //     'writeCallback' => function ($session) {
        //         return [
        //            'user_id' => Yii::$app->user->id,
        //            'last_write' => time(),
        //            'ip' => $_SERVER['REMOTE_ADDR']
        //         ];
        //      },
        //     'sessionTable' => 'session', // session table name. Defaults to 'session'.
        //     'timeout' => 96400,
        //     'cookieParams' => [
        //         'httponly' => TRUE
        //     ]
        // ],
        // asset manager css html dan js  minify
        'assetManager' => [
            'linkAssets' => FALSE,
            'class' => 'yii\web\AssetManager',
            'bundles' => [
                'app\assets\NprogressAsset' => [
                    'configuration' => [
                        'minimum' => 0.9,
                        'showSpinner' => FALSE,
                    ],
                    'page_loading' => TRUE,
                    'pjax_events' => TRUE,
                    'jquery_ajax_events' => TRUE,
                ],
//                'yii\web\JqueryAsset' => [
//                    'basePath' => '@webroot',
//                    'baseUrl' => '@web/app/assets',
//                    'js' => [
//                        'js/jquery.min.js'
//                    ]
//                ],
//                'yii\bootstrap\BootstrapAsset' => [
//                    'basePath' => '@webroot',
//                    'baseUrl' => '@web/app/assets',
//                    'css' => [
//                        'css/bootstrap.min.css',
//                    ]
//                ],
//                'yii\bootstrap\BootstrapPluginAsset' => [
//                    'basePath' => '@webroot',
//                    'baseUrl' => '@web/app/assets',
//                    'js' => [
//                        'js/bootstrap.min.js'
//                    ]
//                ],

            ],
        ],
    ],
    'params' => $params
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [
            'crud' => [
                'class' => 'app\widgets\generators\crud\Generator',
                'templates' => ['dzaCrud' => '@app/widgets/generators/crud/dza']
            ],
            'migration' => [
                'class' => 'app\widgets\generators\migration\Generator'
            ],
        ],
        //'allowedIPs'=>['127.0.0.1','192.168.100.*'],
    ];
}

return $config;