<?php

namespace app\widgets;

use yii\web\AssetBundle;


class FileInputAsset extends AssetBundle
{
    // public $sourcePath = __DIR__.'/assets/file-input';
    // public $basePath = __DIR__.'/assets/file-input';
    //public $basePath = '@webroot';
    public $baseUrl = '@web';


    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    public function init() {
        $path = "app/widgets/assets/file-input/";
       
        $this->css[] = $path.'css/jasny-bootstrap.css';
        $this->js[] = $path.'js/jasny-bootstrap.js';
        parent::init();

    }
}



    

