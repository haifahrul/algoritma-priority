<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Configuration for Ace Admin client script files
 */
class GentellelaAsset extends AssetBundle
{

    public $baseUrl = '@web';
    public function init() {
        $path = 'app/themes/gentellela/files/';
  
        $this->js[] = $path.'js/custom.min.js';
        $this->js[] = $path.'iCheck/icheck.min.js';
        $this->css[] = $path.'css/custom.min.css';
    }

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        // 'AwesomeAsset',
        'app\assets\AwesomeAsset',
    ];
}
