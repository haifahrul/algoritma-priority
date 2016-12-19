<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Transaksi */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Transaksi',
]) . ' ' . $model['service']['kode_service'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transaksis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model['service']['kode_service'], 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="transaksi-update">

    <h1><?php //Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataService' => $dataService,
        'dataSparepart' => $dataSparepart
    ]) ?>

</div>
