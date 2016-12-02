<?php

namespace app\widgets;

use Yii;
use yii\web\AssetBundle;

class FullCalendarAsset extends AssetBundle
{
	/**
	 * [$sourcePath description]
	 * @var string
	 */
	
	public $baseUrl = '@web';
	//public $sourcePath = __DIR__.'/assets/fullcalendar';

	public $language = NULL;
	/**
	 * [$autoGenerate description]
	 * @var boolean
	 */
	public $autoGenerate = true;
	/**
	 * tell the calendar, if you like to render google calendar events within the view
	 * @var boolean
	 */
	public $googleCalendar = false;


	// public $css = [
	// 	'fullcalendar.min.css',
	// ];

	// public $js = [
	// 	'fullcalendar.min.js',
	// 	//'lang-all.js',
	// ];

    public function init() {
        $path = "app/widgets/assets/fullcalendar/";
       
        $this->css[] = $path.'fullcalendar.min.css';
        $this->js[] = $path.'fullcalendar.min.js';
        parent::init();

    }
	/**
	 * [$depends description]
	 * @var array
	 */
	public $depends = [
		'yii\bootstrap\BootstrapAsset',
		'dzas\widgets\MomentAsset',
		'yii\web\JqueryAsset',
		//'yii\web\YiiAsset',
		//'yii\bootstrap\BootstrapAsset',
		///'yii\jui\JuiAsset',
	];
	/**
	 * @inheritdoc
	 */
	public function registerAssetFiles($view)
	{
		if($this->googleCalendar)
		{
			$this->js[] = 'gcal.js';
		}
		parent::registerAssetFiles($view);
	}
}