<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\SmsGatewayMe\models\SmsGatewayMeConfig */

$this->title = Yii::t('app', 'Tambah Sms Gateway Me Config');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sms Gateway Me Configs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['title'] = $this->title;
?>
<div class="sms-gateway-me-config-create">

    <h1><?php Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
