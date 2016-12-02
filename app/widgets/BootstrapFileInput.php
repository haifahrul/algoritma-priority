<?php

namespace app\widgets;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

class BootstrapFileInput extends InputWidget
{
    public $clientOptions = [];
    public $clientEvents = [];

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        if ($this->hasModel()) {
            echo Html::activeFileInput($this->model, $this->attribute, $this->options);
        } else {
            echo Html::fileInput($this->name, $this->value, $this->options);
        }
        $this->registerClientScript();
    }

    /**
     * Registers Bootstrap File Input plugin.
     */
    public function registerClientScript()
    {
        $view = $this->getView();

        BootstrapFileInputAsset::register($view);

        $id = $this->options['id'];

        $options = !empty($this->clientOptions) ? Json::encode($this->clientOptions) : '';

        $js[] = ";jQuery('#$id').fileinput({$options});";

        if (!empty($this->clientEvents)) {
            foreach ($this->clientEvents as $event => $handler) {
                $js[] = ";jQuery('#$id').on('$event', $handler);";
            }
        }
        $view->registerJs(implode("\n", $js));
    }
}
