<?php

namespace app\widgets;

class Select2BootstrapAsset extends \yii\web\AssetBundle
{
    //public $sourcePath = __DIR__.'/assets/select2/bootstrap';
    public $baseUrl = '@web';

    public $css = [
        'app/widgets/assets/select2/bootstrap/select2-bootstrap.min.css',
    ];
    
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'app\widgets\Select2Asset',
    ];
}