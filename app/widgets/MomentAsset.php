<?php

namespace app\widgets;

use yii\web\AssetBundle;

class MomentAsset extends AssetBundle
{
	/**
	 * [$sourcePath description]
	 * @var string
	 */
	// public $sourcePath = __DIR__.'/assets/moment';
	/**
	 * [$js description]
	 * @var array
	 */
		public $baseUrl = '@web';

	public $js = [
		'app/widgets/assets/moment/moment.js'
	];

	public $depends = [
		'yii\bootstrap\BootstrapAsset',
	];
}