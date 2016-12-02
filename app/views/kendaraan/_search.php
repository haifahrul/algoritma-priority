<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\KendaraanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kendaraan-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>

        <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'customer_id') ?>

    <?= $form->field($model, 'merek') ?>

    <?= $form->field($model, 'tipe') ?>

    <?= $form->field($model, 'tahun') ?>

    <?php // echo $form->field($model, 'jenis') ?>

    <?php // echo $form->field($model, 'no_plat') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
