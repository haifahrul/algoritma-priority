<?php

namespace app\widgets;

use yii\web\AssetBundle;

/**
 * Class StarRatingAsset
 */
class StarRatingAsset extends AssetBundle
{

    public $sourcePath = '@app/widgets/assets/start-rating/';
    public $css = [
        'lib/jquery.raty.css'
    ];
    public $js = [
        'lib/jquery.raty.js'
    ];
   // public $baseUrl = '@web/widgets';
   // public $basePath = 'app/widgets/assets/start-rating/';
   //  public function init()
   //  {
   //      parent::init();
   //      $path = "app/widgets/assets/start-rating/";
   //      $this->css[] = $path.'lib/jquery.raty.css';
   //      $this->js[] = $path.'lib/jquery.raty.js';
   //  }
    public $depends = [
        'yii\web\YiiAsset',
    ];
}