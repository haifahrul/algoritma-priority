<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2016
 * @package yii2-nav-x
 * @version 1.2.1
 */

namespace app\widgets\nav;

use yii\base\InvalidConfigException;
use yii\bootstrap\Nav;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class NavX extends Nav
{
    /**
     * @var string the class name to render the Dropdown items. Defaults to `\kartik\dropdown\DropdownX`.
     */
    public $dropdownClass = '\app\widgets\nav\DropdownX';

    /**
     * @var array the dropdown widget options
     */
    public $dropdownOptions = [];

    /**
     * @inheritdoc
     * @throws InvalidConfigException
     */
    public function init()
    {
        if (!class_exists($this->dropdownClass)) {
            throw new InvalidConfigException("The dropdownClass '{$this->dropdownClass}' does not exist or is not accessible.");
        }
        NavXAsset::register($this->getView());
        parent::init();
    }

    /**
     * @inheritdoc
     */
    protected function renderDropdown($items, $parentItem)
    {
        /**
         * @var \yii\bootstrap\Dropdown $ddWidget
         */
        $ddWidget = $this->dropdownClass;
        $ddOptions = array_replace_recursive($this->dropdownOptions, [
            'items' => $items,
            'encodeLabels' => $this->encodeLabels,
            'clientOptions' => false,
            'view' => $this->getView(),
        ]);
        return $ddWidget::widget($ddOptions);
    }

    /**
     * @inheritdoc
     */
    protected function isChildActive($items, &$active)
    {
        foreach ($items as $i => $child) {
            if (ArrayHelper::remove($items[$i], 'active', false) || $this->isItemActive($child)) {
                Html::addCssClass($items[$i]['options'], 'active');
                if ($this->activateParents) {
                    $active = true;
                }
            }
            if (isset($items[$i]['items']) && is_array($items[$i]['items'])) {
                $childActive = false;
                $items[$i]['items'] = $this->isChildActive($items[$i]['items'], $childActive);
                if ($childActive) {
                    Html::addCssClass($items[$i]['options'], 'active');
                    $active = true;
                }
            }
        }
        return $items;
    }
}
