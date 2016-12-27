<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Transaksi */

$this->title = Yii::t('app', 'Tambah Transaksi');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transaksis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['title'] = $this->title;
?>
<div class="transaksi-create">
    <h1><?php Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
        'dataService' => $dataService,
        'dataSparepart' => $dataSparepart,
        'modelSparepart' => $modelSparepart
    ]) ?>
</div>