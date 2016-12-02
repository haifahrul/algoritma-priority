<?php

namespace app\widgets;

use yii\web\AssetBundle;


class SwitchAsset extends AssetBundle
{
    // public $sourcePath = __DIR__.'/assets/bootstrap-switch';
    // public $basePath = __DIR__.'/assets/bootstrap-switch';
    //public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset'
    ];

    public function init()
    {
        $path = "app/widgets/assets/bootstrap-switch/";
        $this->css[] = YII_DEBUG ? $path.'css/bootstrap-switch.css' : 'css/bootstrap-switch.min.css';
        $this->js[] = YII_DEBUG ? $path.'js/bootstrap-switch.js' : 'js/bootstrap-switch.min.js';
    }
} 