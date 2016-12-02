<?php

namespace app\widgets;

use yii\helpers\ArrayHelper;


trait CKEditorTrait
{
  
    public $preset = 'standard';
 
    public $clientOptions = [];

    /**
     * Initializes the widget options.
     * This method sets the default values for various options.
     */
    protected function initOptions()
    {
        $options = [];
        switch ($this->preset) {
            case 'custom':
                $preset = null;
                break;
            case 'basic':
            case 'full':
            case 'standard':
                $preset = __DIR__ . '/assets/ckeditor/presets/' . $this->preset . '.php';
                break;
            default:
                $preset = __DIR__ . '/assets/ckeditor/presets/standard.php';
        }
        if ($preset !== null) {
            $options = require($preset);
        }
        $this->clientOptions = ArrayHelper::merge($options, $this->clientOptions);
    }
}