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
//    public function getMenuUser()
//    {
//        $items = [
//            ['label' => 'Dashboard', 'url' => ['site/index']],
//            ['label' => 'Customer', 'url' => ['customer/index']],
//            ['label' => 'Kendaraan', 'url' => ['kendaraan/index']],
//            ['label' => 'Sparepart', 'url' => ['sparepart/index']],
//            ['label' => 'Service', 'url' => ['service/index']],
//            ['label' => 'Transaksi', 'url' => ['transaksi/index']],
////            ['label' => 'Sign up', 'url' => ['site/signup'], 'visible' => Yii::$app->user->isGuest],
////            Yii::$app->user->isGuest ? (['label' => 'Login', 'url' => ['/site/login']]) : ('<li>' . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form']) . Html::submitButton('Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link']) . Html::endForm() . '</li>')
//        ];
//
//        return $items;
//    }

    public function getMenuAdmin()
    {
        $items = [
            [
                'label' => Yii::t('app', 'Dashboard'),
                'url' => Yii::$app->homeUrl,
                'active' => FALSE,
                'visible' => TRUE,
                'icon' => 'home',
            ],
            [
                'label' => Yii::t('app', 'Customer'),
                'url' => ['customer/index'],
                'active' => FALSE,
                'visible' => TRUE,
                'icon' => 'user',
            ],
            [
                'label' => Yii::t('app', 'Kendaraan'),
                'url' => ['kendaraan/index'],
                'active' => FALSE,
                'visible' => TRUE,
                'icon' => 'home',
            ],
            [
                'label' => Yii::t('app', 'Sparepart'),
                'url' => ['sparepart/index'],
                'active' => FALSE,
                'visible' => TRUE,
                'icon' => 'home',
            ],
            [
                'label' => Yii::t('app', 'Service'),
                'url' => ['service/index'],
                'active' => FALSE,
                'visible' => TRUE,
                'icon' => 'home',
            ],
            [
                'label' => Yii::t('app', 'Transaksi'),
                'url' => ['transaksi/index'],
                'active' => FALSE,
                'visible' => TRUE,
                'icon' => 'home',
            ],
//            [
//                'label' => Yii::t('app', 'Transaksi'),
//                'url' => '#',
//                'active' => FALSE,
//                'visible' => TRUE,
//                'icon' => 'users',
//                'items' => [
//                    ['label' => Yii::t('app', 'Daftar Dosen'), 'url' => ['/admin/dosen/']],
//                    ['label' => Yii::t('app', 'Dosen Semester Ganjil'), 'url' => ['/admin/dosen-ganjil/']],
//                    ['label' => Yii::t('app', 'Dosen Semester Genap'), 'url' => ['/admin/dosen-genap/']],
//                ],
//            ],
//            [
//                'label' => Yii::t('app', 'Dosen'),
//                'url' => '#',
//                'active' => FALSE,
//                'visible' => TRUE,
//                'icon' => 'users',
//                'items' => [
//                    ['label' => Yii::t('app', 'Daftar Dosen'), 'url' => ['/admin/dosen/']],
//                    ['label' => Yii::t('app', 'Dosen Semester Ganjil'), 'url' => ['/admin/dosen-ganjil/']],
//                    ['label' => Yii::t('app', 'Dosen Semester Genap'), 'url' => ['/admin/dosen-genap/']],
//                ],
//            ],
        ];

        return $items;
    }

    public function getMenuWebmaster()
    {
        $items = [
            [
                'label' => Yii::t('app', 'Dashboard'),
                'url' => Yii::$app->homeUrl,
                'active' => FALSE,
                'visible' => TRUE,
                'icon' => 'fa fa-dashboard',
            ],
            [
                'label' => Yii::t('app', 'Attribute'),
                'url' => ['/webmaster/attribute/'],
                'active' => FALSE,
                'visible' => TRUE,
                'icon' => 'fa fa-cog',
            ],
            [
                'label' => Yii::t('app', 'User Permissions'),
                'url' => '#',
                'active' => FALSE,
                'visible' => TRUE,
                'icon' => 'user',
                'items' => [
                    ['label' => Yii::t('app', 'User Management'), 'url' => ['/webmaster/user/'], 'icon' => 'fa fa-circle-o text-yellow'],
                    ['label' => Yii::t('app', 'Route'), 'url' => ['/webmaster/route/', 'id' => Yii::$app->user->id], 'icon' => 'fa fa-circle-o text-yellow'],
                    ['label' => Yii::t('app', 'Role'), 'url' => ['/webmaster/role/'], 'icon' => 'fa fa-circle-o text-yellow'],
                ]
            ],
        ];

        return $items;
    }
}