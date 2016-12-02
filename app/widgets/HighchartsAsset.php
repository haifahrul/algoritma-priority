<?php


namespace app\widgets;

use yii\web\AssetBundle;

class HighchartsAsset extends AssetBundle
{

    public $sourcePath = __DIR__.'/assets/highcharts';
    public $depends = ['yii\web\JqueryAsset'];

    public function withScripts($scripts = ['highcharts'])
    {
        // use unminified files when in debug mode
        $ext = YII_DEBUG ? 'src.js' : 'js';

        // add files
        foreach ($scripts as $script) {
            $this->js[] = "$script.$ext";
        }

        // make sure that either highcharts or highstock base file is included.
        array_unshift($this->js, "highcharts.$ext");
        $hasHighstock = in_array("highstock.$ext", $this->js);
        if ($hasHighstock) {
            array_unshift($this->js, "highstock.$ext");
            // remove highcharts if highstock is used on page
            $this->js = array_diff($this->js, ["highcharts.$ext"]);
        }

        return $this;
    }
}
