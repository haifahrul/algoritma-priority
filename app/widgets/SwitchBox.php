<?php

namespace app\widgets;

use yii\helpers\Html;
use yii\widgets\InputWidget;

/**
 * SwitchBox renders a checkbox type toggle switch control. For example:
 *
 * ```
 * <?= \dzas\widgets\SwitchBox::widget([
 *      'name' => 'Test',
 *      'clientOptions' => [
 *          'size' => 'large',
 *          'onColor' => 'success',
 *          'offColor' => 'danger'
 *      ]
 *  ]);?>
 */
class SwitchBox extends InputWidget
{
    use SwitchTrait;

    /**
     * @var bool whether to display the label inline or not. Defaults to true.
     */
    public $inlineLabel = true;

    /**
     * @inheritdoc
     */
    public function run()
    {

        if ($this->hasModel()) {
            $input = Html::activeCheckbox($this->model, $this->attribute, $this->options);
        } else {
            $input = Html::checkbox($this->name, $this->checked, $this->options);
        }
        echo $this->inlineLabel ? $input : Html::tag('div', $input);
        $this->selector = "#{$this->options['id']}";

        $this->registerClientScript();
    }
} 