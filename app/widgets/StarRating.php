<?php

namespace app\widgets;

use yii\widgets\InputWidget;
use Yii;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * Class StarRating *
 * Usage example:
 * ~~~
 * \app\widgets\StarRating::widget([
 *       'name' => "input_name",// nama attribute
 *       'value' => 5,
 *       'clientOptions' => [
 *           // Your client options
 *       ]
 * ]); // without models

$form->field($model, 'attribute')->widget(\app\widgets\StarRating::className(), [
                       'options' => [
                           // Your additional tag options
                       ],
                       'clientOptions' => [
                           // Your client options
                       ]
                   ]); 

 * ~~~
 */
class StarRating extends InputWidget
{

    /**
     * @var array client options
     */
    public $clientOptions = [];
    public $path;
    /**
     * Init widget, configure client options
     * 
     * @return void
     */
    public function init()
    {
        $this->configureClientOptions();
        parent::init();
    }

    /**
     * Render star rating
     *
     * @return string
     */
    public function run()
    {
        $this->registerAssets();
        return Html::tag('div', '', $this->options);
    }

    /**
     * Register client assets
     *
     * return @void
     */
    protected function registerAssets()
    {
        $view = $this->getView();
        $clientOptions = Json::encode($this->clientOptions);
        $js = '$("div#' . $this->options['id'] . '").raty(' . $clientOptions . ');';
        $view->registerJs($js);
    }

    /**
     * Configure client options
     *
     * @return void
     */
    protected function configureClientOptions()
    {
        $assetBundle = StarRatingAsset::register($this->view);
        $this->clientOptions['score'] = $this->hasModel() ? Html::getAttributeValue($this->model, $this->attribute) : $this->value;
        $this->clientOptions['path'] = $assetBundle->baseUrl . '/lib/images';
        if (!isset($this->clientOptions['scoreName']) && $this->hasModel()) {
            $this->clientOptions['scoreName'] = Html::getInputName($this->model, $this->attribute);
        }
    }

}
