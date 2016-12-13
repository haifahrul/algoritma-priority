<?php
namespace app\components;

use Yii;
use yii\helpers\Html;

/**
 * Created by PhpStorm.
 * User: dzas
 * Date: 6/27/2016
 * Time: 9:47 AM
 */
class MenuItems
{
    public function getMenuAdmin()
    {
        $items = [
            [
                'label' => Yii::t('app', 'Dashboard'),
                'url' => ['/site/dashboard'],
                'icon' => 'dashboard',
            ],
            [
                'label' => Yii::t('app', 'Customer'),
                'url' => ['/customer/index'],
                'icon' => 'users',
            ],
            [
                'label' => Yii::t('app', 'Kendaraan'),
                'url' => ['/kendaraan/index'],
                'icon' => 'motorcycle',
            ],
            [
                'label' => Yii::t('app', 'Service'),
                'url' => ['/service/index'],
                'icon' => 'cog',
            ],
            [
                'label' => Yii::t('app', 'Transaksi'),
                'url' => ['/transaksi/index'],
                'icon' => 'money',
            ],
            [
                'label' => Yii::t('app', 'Sparepart'),
                'url' => ['/sparepart/index'],
                'icon' => 'wrench',
            ],
            [
                'label' => Yii::t('app', 'SMS Gateway'),
                'url' => '#',
                'icon' => 'commenting',
                'items' => [
                    ['label' => Yii::t('app', 'List Messages'), 'url' => ['/smsgatewayme/list-messages']],
                    ['label' => Yii::t('app', 'Test Send SMS'), 'url' => ['/smsgatewayme/test-send-sms/']],
                ],
            ],
        ];

        return $items;
    }

    public function getMenuWebmaster()
    {
        $items = [
            [
                'label' => Yii::t('app', 'Attribute'),
                'url' => ['/webmaster/attribute/'],
                'icon' => 'fa fa-cog',
            ],
            [
                'label' => Yii::t('app', 'Users Management'),
                'url' => ['/webmaster/user'],
                'icon' => 'users',
            ],
            [
                'label' => Yii::t('app', 'SMS Gateway Config'),
                'url' => ['/smsgatewayme/config'],
                'icon' => 'commenting',
            ],
        ];

        return $items;
    }

//    public function getMenus()
//    {
//        return $item = [
//            [
//                'label' => Yii::t('app', 'Dashboard'),
//                'url' => Yii::$app->homeUrl,
//                'visible' => TRUE,
//                'icon' => 'home',
//            ],
//            [
//                'label' => Yii::t('app', 'Customer'),
//                'url' => ['/customer/index'],
//                'visible' => TRUE,
//                'icon' => 'user',
//            ],
//            [
//                'label' => Yii::t('app', 'Kendaraan'),
//                'url' => ['/kendaraan/index'],
//                'visible' => TRUE,
//                'icon' => 'home',
//            ],
//            [
//                'label' => Yii::t('app', 'Sparepart'),
//                'url' => ['/sparepart/index'],
//                'visible' => TRUE,
//                'icon' => 'home',
//            ],
//            [
//                'label' => Yii::t('app', 'Service'),
//                'url' => ['/service/index'],
//                'visible' => TRUE,
//                'icon' => 'home',
//            ],
//            [
//                'label' => Yii::t('app', 'Transaksi'),
//                'url' => ['/transaksi/index'],
//                'visible' => TRUE,
//                'icon' => 'home',
//            ],
//            [
//                'label' => Yii::t('app', 'SMS Gateway'),
//                'url' => '#',
//                'visible' => TRUE,
//                'icon' => 'commenting',
//                'items' => [
//                    ['label' => Yii::t('app', 'List Messages'), 'url' => ['/smsgatewayme/list-messages']],
////                    ['label' => Yii::t('app', 'Dosen Semester Ganjil'), 'url' => ['/admin/dosen-ganjil/']],
////                    ['label' => Yii::t('app', 'Dosen Semester Genap'), 'url' => ['/admin/dosen-genap/']],
//                ],
//            ],
////            [
////                'label' => 'Options',
////                'options' => ['class' => 'user-panel'],
////                'active' => FALSE,
////            ],
////            [
////                'label' => Yii::t('app', 'Attribute'),
////                'url' => ['/webmaster/attribute'],
////                'visible' => TRUE,
////                'icon' => 'fa fa-cog',
////            ],
////            [
////                'label' => Yii::t('app', 'Users Management'),
////                'url' => ['/webmaster/user'],
////                'visible' => TRUE,
////                'icon' => 'users',
////            ],
//        ];
//    }
}