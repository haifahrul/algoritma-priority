<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\webmasteristrator\models\AuthItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nav-tabs-custom">

    <ul class="nav nav-tabs">
      <li class="active"><a href="">Kelola Role</a></li>
      
    </ul>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php $form->field($model, 'type')->textInput() ?>

    <?php $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php $form->field($model, 'rule_name')->textInput(['maxlength' => true]) ?>

    <?php $form->field($model, 'data')->textarea(['rows' => 6]) ?>

    <?php $form->field($model, 'created_at')->textInput() ?>

    <?php $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::a('Kembali',Yii::$app->request->referrer, ['class' => 'btn btn-primary']) ?>
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
