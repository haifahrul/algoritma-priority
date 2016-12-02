<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Kendaraan */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Kendaraan',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kendaraans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="kendaraan-update">

    <h1><?php //Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
