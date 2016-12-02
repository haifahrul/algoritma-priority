<?php

namespace app\widgets;

use yii\web\AssetBundle;

class TabularAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $baseUrl = '@web';
    //public $sourcePath = __DIR__.'/assets/tabular-input';

    public $css = [
        'app/widgets/assets/tabular-input/css/tabularInput.css'
    ];

    public $js = [
        'app/widgets/assets/tabular-input/js/tabularInput.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];

}
