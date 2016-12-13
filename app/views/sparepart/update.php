<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sparepart */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
        'modelClass' => 'Sparepart',
    ]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Spareparts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="sparepart-update">
    <div class="box">
        <div class="box-body">
            <h1><?php //Html::encode($this->title) ?></h1>

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>
</div>
