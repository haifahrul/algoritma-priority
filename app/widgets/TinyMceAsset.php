<?php

namespace app\widgets;

use yii\web\AssetBundle;

class TinyMceAsset extends AssetBundle
{
    //public $sourcePath = __DIR__.'/assets/tinymce';
    public $baseUrl = '@web';

    public function init()
    {
    	$path = "app/widgets/assets/tinymce/";
        parent::init();
        $this->js[] = YII_DEBUG ? $path.'tinymce.min.js' : $path.'tinymce.min.js';
    }
}