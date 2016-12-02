<?php
namespace app\widgets\adminlte;
//use app\assets_b\AdminlteAsset;
class Widget extends \yii\base\Widget
{
    /**
     * @var array the HTML attributes for the widget container tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];

    public function init()
    {
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
    }

    protected function registerAsset()
    {
        //AdminlteAsset::register($this->getView());
    }
}