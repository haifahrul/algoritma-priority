<?php

namespace app\widgets;

use yii\web\AssetBundle;


class CKEditorWidgetAsset extends AssetBundle
{
    public $baseUrl = '@web';

    public $depends = [
        'app\widgets\CKEditorAsset'
    ];


   public function init() {
        $path = "app/widgets/assets/ckeditor/";
  
        //$this->sourcePath = __DIR__ . '/assets/ckeditor';
        $this->js[] = $path.'dosamigos-ckeditor.widget.js';
        parent::init();
    }
}
