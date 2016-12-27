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
    public function sidebarMenuAdmin()
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
                'label' => Yii::t('app', 'Master Data'),
                'url' => '#',
                'icon' => 'database',
                'items' => [
//                    ['label' => Yii::t('app', 'Jasa Service'), 'url' => ['/jasa-service/index/']],
                    ['label' => Yii::t('app', 'Sparepart'), 'url' => ['/sparepart/index']],
                ],
            ],
            [
                'label' => Yii::t('app', 'SMS Gateway'),
                'url' => '#',
                'icon' => 'commenting',
                'items' => [
                    ['label' => Yii::t('app', 'List Messages'), 'url' => ['/smsgatewayme/list-messages']],
                    ['label' => Yii::t('app', 'Test Send SMS'), 'url' => ['/smsgatewayme/test-send-sms/']],
                ],
                'visible' => Yii::$app->user->can('webmaster'),
            ],
        ];

        return $items;
    }

    public function headerMenuWebmaster()
    {
        $items = [
            [
                'label' => Yii::t('app', 'Attribute'),
                'url' => ['/webmaster/attribute/'],
                'icon' => 'fa fa-cog',
            ],
            [
                'label' => Yii::t('app', 'Config'),
                'url' => ['/webmaster/config/'],
                'icon' => 'fa fa-globe',
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
}