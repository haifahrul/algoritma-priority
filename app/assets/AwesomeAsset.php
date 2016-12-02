<?php


namespace app\assets;

use yii\web\AssetBundle;


class AwesomeAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/app/assets';
    public $css = [
      'css/font-awesome.min.css',
    ];
   
    // clear
    // public $publishOptions = [
    //     'forceCopy'=>true,
    // ];

    //  public function init()
    // {
    //     parent::init();

    //     $this->publishOptions['beforeCopy'] = function ($from, $to) {
    //         return preg_match('%(/|\\\\)(fonts|css)%', $from);
    //     };
    // }
}
