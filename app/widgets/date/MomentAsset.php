<?php

namespace app\widgets\date;

use yii\web\AssetBundle;

class MomentAsset extends AssetBundle
{
	//$path = __DIR__;

    public $baseUrl = '@web';


    public function init() {
        if (YII_DEBUG) {
            $this->js[] = 'app/widgets/date/assets/moment/moment-with-locales.min.js';
        } else {
            $this->js[] = 'app/widgets/date/assets/moment/moment-with-locales.min.js';
        }
    }
}
