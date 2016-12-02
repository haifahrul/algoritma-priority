<?php

namespace app\widgets;

use yii\web\AssetBundle;
/**
 * Description of ToastrAjaxFeedAsset
 *
 */
class ToastrAjaxFeedAsset extends AssetBundle {
    
    public $baseUrl = '@web';
    
    // public $js = [
    //     'toastr-ajax-feed.js',
    // ];
    // public function init() {
    //     $this->sourcePath = __DIR__ . '/assets/toastr';
    //     parent::init();
    // }

    public function init()
    {
        $path = "app/widgets/assets/toastr/";
        $this->js[] =  $path.'toastr-ajax-feed.js' ;
        parent::init();
    }
}
