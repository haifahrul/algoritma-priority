<?php

namespace app\widgets;

use yii\web\Response;
use yii\base\InvalidConfigException;

class Select2Action extends \yii\base\Action
{

    public $paramName = 'q';
    /**
     * @var callable PHP callback function to retrieve filtered data
     * @example function ($q) { return ['results' => [['id'=>1,'text'=>'First Element'], ['id'=>2,'text'=>'Second Element']]]; }
     */
    public $dataCallback;
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        if (!is_callable($this->dataCallback)) {
            throw new InvalidConfigException('"' . get_class($this) . '::dataCallback" should be a valid callback.');
        }
        
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $this->controller->enableCsrfValidation = false;
    }

    public function run()
    {
        $q = \Yii::$app->request->get($this->paramName);
        
        $data = call_user_func($this->dataCallback, $q); 
        
        if (is_array($data) && (!isset($data['results']))) {
            $data = ['results' => $data];
        }
        
        return $data;
    }
}