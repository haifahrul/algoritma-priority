<?php

namespace app\widgets;

use yii\web\AssetBundle;

class TinyMceLangAsset extends AssetBundle
{
    public $sourcePath = __DIR__.'/assets/tinymce';

    public $depends = [
        'app\widgets\TinyMceAsset'
    ];
}
