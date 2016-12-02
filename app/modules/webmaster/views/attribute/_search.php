<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\webmaster\models\search\AttributeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attribute-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>

        <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'parent') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'content') ?>

    <?= $form->field($model, 'code') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'position') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
