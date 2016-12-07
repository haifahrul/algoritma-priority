<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\SmsGatewayMe\models\SmsGatewayMeConfig */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Sms Gateway Me Config',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sms Gateway Me Configs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="sms-gateway-me-config-update">

    <h1><?php //Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
