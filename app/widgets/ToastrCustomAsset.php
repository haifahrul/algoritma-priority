<?php

namespace app\widgets;

use yii\web\AssetBundle;

class ToastrCustomAsset extends AssetBundle{
    public $css = [
        'toastr-style-reset.css',
    ];
    public $depends = [
        'app\widgets\ToastrAsset',
    ];
    
    // public function init() {
    //     $this->sourcePath = __DIR__ . '/assets';
    //     parent::init();
    // }
    public function init()
    {
        $path = "app/widgets/assets/toastr/";
        $this->css[] =  $path. 'toastr-style-reset.css' ;
        parent::init();
    }
}
