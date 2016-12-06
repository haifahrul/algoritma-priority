<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class MaterialAsset extends AssetBundle
{
    public $baseUrl = '@web';

    public function init()
    {
        $path = 'app/themes/materialize/';

        $this->css[] = $path . 'css/style.css';
        $this->css[] = $path . 'css/materialize.min.css';
        $this->js[] = $path . 'js/materialize.min.js';
    }

    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
//        'yii\bootstrap\BootstrapPluginAsset'
    ];
}
