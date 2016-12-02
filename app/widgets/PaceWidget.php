<?php

namespace app\widgets;

class PaceWidget extends \yii\base\Widget
{
    public $color='blue';
    public $theme='center-circle';
    public $options;

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        if(!empty($this->options)){
            $this->getView()->registerJs('window.paceOptions='.json_encode($this->options),\yii\web\View::POS_BEGIN);
        }

        PaceAsset::register($this->getView());
        $asset=\Yii::$app->assetManager->publish("@app/widgets/assets/pace",['forceCopy'=>YII_DEBUG]);

        $this->getView()->registerCssFile($asset[1].'/themes/'.$this->color.'/pace-theme-'.$this->theme.'.css');
    }
}

//contoh penggunaannya
//<?= app\widgets\PaceWidget::widget([
//     'color'=>'red',
//     'theme'=>'corner-indicator',
//     'options'=>[
//         'ajax'=>['trackMethods'=>['GET','POST']]
//     ]
// ])?>