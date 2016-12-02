<?php

namespace app\widgets\date;

use yii\web\AssetBundle;


class DatePickerAsset extends AssetBundle
{
    //public $basePath = __DIR__.'/assets';
    //public $basePath = '@webroot';
    public $baseUrl = '@web';
    

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
        'app\widgets\date\MomentAsset',
    ];

    public function init() {
        $path = "app/widgets/date/assets/";
        if (YII_DEBUG) {
            $this->css[] = $path.'css/bootstrap-datetimepicker.min.css';
            $this->js[] = $path.'js/bootstrap-datetimepicker.min.js';
        } else {
            $this->css[] = $path.'css/bootstrap-datetimepicker.min.css';
            $this->js[] = $path.'js/bootstrap-datetimepicker.min.js';
        }
    }
}
