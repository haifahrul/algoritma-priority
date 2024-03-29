<?php

namespace app\widgets;

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\bootstrap\Widget;

/**
 * BASIC GUIDE
 *
 * In view
 *
 * <?php $eventUrl = \yii\helpers\Url::to(['event-calendar']); ?>
 *
 * <?= dzas\widgets\FullCalendar::widget([
 * 		'options'=>[
 * 			'id'=>'calendar',
 * 			'header'=>[
 * 				'left'=>'prev,next today',
 * 				'center'=>'title',
 * 				'right'=>'month,agendaWeek,agendaDay',
 * 			],
 * 			'editable'=> true,
 * 			'eventLimit'=>true, // allow "more" link when too many events
 * 			'events' => [
 * 				'url' => $eventUrl,
 * 			],
 * 		]
 * 	]) ?>
 *
 * In controller
 *
 * public function actionEventCalendar($start=NULL,$end=NULL,$_=NULL){
 *     \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
 *     $model= \app\models\Event::find()->all();
 *     if(!empty($start) and !empty($end)){
 *         $model= \app\models\Event::find()
 * 		   	   ->where(['>=','start',date('Y-m-d 00:00:01',strtotime($start))])
 *             ->andWhere(['<=','end',date('Y-m-d 23:59:59',strtotime($end))])
 *             ->all();
 *     }
 *
 *     $events = [];
 *     foreach ($model as $event) {
 *         $events[]=[
 *             'title'=>$event->title,
 *             'start'=>date('Y-m-d 00:00:01',strtotime($event->start)),
 *             'end'=>date('Y-m-d 23:59:59', strtotime($event->end)),
 *             //'color'=>'#CC0000',
 *             //'allDay'=>true,
 *             //'url'=>'http://anyurl.com'
 *         ];
 *     }
 *     return $events;
 * }
*/

class FullCalendar extends Widget{
	public $options=[];
	public $htmlOptions=[];

	public function run(){
		if (!isset($this->options['id'])) {
			$this->options['id'] = $this->getId();
		}
		$this->htmlOptions['id']= $id = $this->options['id'];
		$view = $this->getView();
		$this->registerScript($view);
		echo Html::beginTag('div',$this->htmlOptions);
		echo Html::endTag('div');
		$encodeoptions=Json::encode($this->options);
		$view->registerJs("$('#$id').fullCalendar($encodeoptions);");
	}

	public function registerScript($view){
		FullCalendarAsset::register($view);
	}
}