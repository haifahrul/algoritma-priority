<?php

namespace app\widgets;

use yii\web\AssetBundle;


class CKEditorAsset extends AssetBundle
{
    public $baseUrl = '@web';

    // public $js = [
    //     'ckeditor.js',
    //     'adapters/jquery.js'
    // ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset'
    ];

   public function init() {
        $path = "app/widgets/assets/ckeditor/ckeditor/";
  
        $this->js[] = $path.'ckeditor.js';
        $this->js[] = $path.'adapters/jquery.js';
    }


}
