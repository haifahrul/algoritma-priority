<?php

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Configuration for Ace Admin client script files
 */
class AdminFlatLabAsset extends AssetBundle
{
    public $baseUrl = '@web';

    public function init()
    {
        $path = 'app/themes/adminflatlab/';

        // Bootstrap core CSS
        $this->css[] = $path . 'css/bootstrap.min.css';
        $this->css[] = $path . 'css/bootstrap-reset.css';
        // external css
        $this->css[] = $path . 'assets/font-awesome/css/font-awesome.css';
        $this->css[] = $path . 'assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css';
        $this->css[] = $path . 'css/owl.carousel.css';
        // Custom styles for this template
        $this->css[] = $path . 'css/style.css';
        $this->css[] = $path . 'css/style-responsive.css';

        // HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries
        // [if lt IE 9]
        $this->js[] = $path . 'js/html5shiv.js';
        $this->js[] = $path . 'js/respond.min.js';

        // js placed at the end of the document so the pages load faster
        $this->js = [
            $path . 'js/jquery.js',
            $path . 'js/jquery-1.8.3.min.js' .
            $path . 'js/bootstrap.min.js',
            $path . 'js/jquery.dcjqaccordion.2.7.js',
            $path . 'js/jquery.scrollTo.min.js',
            $path . 'js/jquery.nicescroll.js',
            $path . 'js/jquery.sparkline.js',
            $path . 'assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js',
            $path . 'js/owl.carousel.js',
            $path . 'js/jquery.customSelect.min.js',
            $path . 'js/jquery.dcjqaccordion.2.7.js',
        ];

        // common script for all pages
        $this->js[] = $path . 'js/common-scripts.js';

        // script for main page
        $this->js[] = $path . 'js/sparkline-chart.js';
        $this->js[] = $path . 'js/easy-pie-chart.js';
        $this->js[] = $path . 'js/count.js';
    }

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        // 'AwesomeAsset',
        'app\assets\AwesomeAsset',
        'yii\web\JqueryAsset'
    ];
}
