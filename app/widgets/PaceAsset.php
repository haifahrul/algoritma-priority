<?php

namespace app\widgets;

use yii\web\AssetBundle;
use Yii;

class PaceAsset extends AssetBundle
{
    // public $sourcePath = '@app/Widgets/assets/pace';
    public $baseUrl = '@web';

    public $jsOptions=['position'=>\yii\web\View::POS_END,'data-pace-options'=>'{"ajax": true,"startOnPageLoad":true,"restartOnPushState":true}'];


    public function registerAssetFiles($view){
    	$path = 'app/widgets/assets/pace/';
        if(YII_DEBUG){
            $this->js[]=$path.'pace.js';
        }else{
            $this->js[]=$path.'pace.min.js';
        }

        parent::registerAssetFiles($view);
    }
}
