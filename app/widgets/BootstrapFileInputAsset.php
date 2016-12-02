<?php

namespace app\widgets;

use yii\web\AssetBundle;

class BootstrapFileInputAsset extends AssetBundle
{
    // public $sourcePath = __DIR__.'/assets/bootstrap-fileinput';
    // public $basePath = __DIR__.'/assets/bootstrap-fileinput';
    //public $basePath = '@webroot';
    public $baseUrl = '@web';
    

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];
    public function init() {
        $path = "app/widgets/assets/bootstrap-fileinput/";
  
        $this->css[] = $path.'css/fileinput.css';
        $this->js[] = $path.'js/fileinput.js';
    }
}
