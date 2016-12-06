<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AdminlteAsset extends AssetBundle
{
    // not working any share hosting
    // public $sourcePath = '@app/themes/adminlte/files/';

    // public $css = [
    //     'css/AdminLTE.min.css',
    //     'css/skins/_all-skins.min.css',
    // ];

    // public $js = [
    //     'js/app.min.js',
    //     //'js/bootstrap.min.js',
    //     //'js/bootstrap.js',
    // ];
    public $baseUrl = '@web';

    public function init()
    {
        $path = 'app/themes/adminlte/files/';

        $this->js[] = $path . 'js/app.min.js';
        $this->css[] = $path . 'css/AdminLTE.min.css';
        $this->css[] = $path . 'css/skins/_all-skins.min.css';
    }

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset'

    ];
}
