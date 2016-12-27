<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Service */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Service',
]) . ' ' . $model->kendaraan->no_plat;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="service-update">

    <h1><?php //Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelServiceDetail' => $modelServiceDetail,
        'dataCustomer' => $dataCustomer,
        'dataKendaraan' => $dataKendaraan,
        'dataSparepart' => $dataSparepart,
    ]) ?>

</div>
