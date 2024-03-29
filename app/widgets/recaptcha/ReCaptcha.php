<?php

namespace app\widgets\recaptcha;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\widgets\InputWidget;

/**
 * Yii2 Google reCAPTCHA widget.
 *
 * For example:
 *
 * ```php
 * <?= $form->field($model, 'reCaptcha')->widget(
 *  ReCaptcha::className(),
 *  ['siteKey' => 'your siteKey']
 * ) ?>
 * ```
 *
 * or
 *
 * ```php
 * <?= ReCaptcha::widget([
 *  'name' => 'reCaptcha',
 *  'siteKey' => 'your siteKey',
 *  'widgetOptions' => ['class' => 'col-sm-offset-3']
 * ]) ?>
 * ```
 *
 * @see https://developers.google.com/recaptcha
 * @author HimikLab
 * @package himiklab\yii2\recaptcha
 */
class ReCaptcha extends InputWidget
{
    const JS_API_URL = 'https://www.google.com/recaptcha/api.js';

    const THEME_LIGHT = 'light';
    const THEME_DARK = 'dark';

    const TYPE_IMAGE = 'image';
    const TYPE_AUDIO = 'audio';

    /** @var string Your sitekey. */
    public $siteKey;

    /** @var string Your secret. */
    public $secret;

    /** @var string The color theme of the widget. [[THEME_LIGHT]] (default) or [[THEME_DARK]] */
    public $theme;

    /** @var string The type of CAPTCHA to serve. [[TYPE_IMAGE]] (default) or [[TYPE_AUDIO]] */
    public $type;

    /** @var string Your JS callback function that's executed when the user submits a successful CAPTCHA response. */
    public $jsCallback;

    /** @var array Additional html widget options, such as `class`. */
    public $widgetOptions = [];

    public function init()
    {
        parent::init();

        if (empty($this->siteKey)) {
            if (!empty(Yii::$app->reCaptcha->siteKey)) {
                $this->siteKey = Yii::$app->reCaptcha->siteKey;
            } else {
                throw new InvalidConfigException('Required `siteKey` param isn\'t set.');
            }
        }

        $view = $this->view;
        $view->registerJsFile(
            self::JS_API_URL . '?hl=' . $this->getLanguageSuffix(),
            ['position' => $view::POS_HEAD]
        );
    }

    public function run()
    {
        $this->customFieldPrepare();

        $divOptions = [
            'class' => 'g-recaptcha',
            'data-sitekey' => $this->siteKey
        ];
        if (!empty($this->jsCallback)) {
            $divOptions['data-callback'] = $this->jsCallback;
        }
        if (!empty($this->theme)) {
            $divOptions['data-theme'] = $this->theme;
        }
        if (!empty($this->type)) {
            $divOptions['data-type'] = $this->type;
        }

        if (isset($this->widgetOptions['class'])) {
            $divOptions['class'] = "{$divOptions['class']} {$this->widgetOptions['class']}";
        }
        $divOptions = $divOptions + $this->widgetOptions;

        echo Html::tag('div', '', $divOptions);
    }

    protected function getLanguageSuffix()
    {
        $currentAppLanguage = Yii::$app->language;
        $langsExceptions = ['zh-CN', 'zh-TW', 'zh-TW'];

        if (strpos($currentAppLanguage, '-') === false) {
            return $currentAppLanguage;
        }

        if (in_array($currentAppLanguage, $langsExceptions)) {
            return $currentAppLanguage;
        } else {
            return substr($currentAppLanguage, 0, strpos($currentAppLanguage, '-'));
        }
    }

    protected function customFieldPrepare()
    {
        $view = $this->view;
        if ($this->hasModel()) {
            $inputName = Html::getInputName($this->model, $this->attribute);
            $inputId = Html::getInputId($this->model, $this->attribute);
        } else {
            $inputName = $this->name;
            $inputId = 'recaptcha-' . $this->name;
        }

        if (empty($this->jsCallback)) {
            $jsCode = "var recaptchaCallback = function(response){jQuery('#{$inputId}').val(response);};";
        } else {
            $jsCode = "var recaptchaCallback = function(response){jQuery('#{$inputId}').val(response); {$this->jsCallback}(response);};";
        }
        $this->jsCallback = 'recaptchaCallback';

        $view->registerJs($jsCode, $view::POS_BEGIN);
        echo Html::input('hidden', $inputName, null, ['id' => $inputId]);
    }
}
