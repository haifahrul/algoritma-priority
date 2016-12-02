<?php

namespace app\widgets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Asset bundle for the Twitter bootstrap javascript files.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0 
 */
class TreenodeAsset extends AssetBundle
{
    public $sourcePath = __DIR__.'/assets/treenode';

    public $css = [
        'style.css',
    ];

    public $js = [
    ];


    public $jsOptions = [
        // 'position' => View::POS_HEAD, 
    ];

    /*
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    */
}
