<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\SwitchBox;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="">Kelola User</a></li>
    </ul>

    <?php $form = ActiveForm::begin([]); ?>
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'status')->widget(SwitchBox::className(),
        [
            'clientOptions' => ['size' => 'normal', 'onText' => 'Aktif', 'offText' => 'Banned']
        ])->label('');
    ?>
    <?php if (!$model->isNewRecord) { ?>
        <strong> Biarkan kosong jika tidak ingin mengubah password</strong>
        <div class="ui divider"></div>
        <?= $form->field($model, 'new_password') ?>
        <?= $form->field($model, 'repeat_password') ?>
        <?= $form->field($model, 'old_password')->textInput(['readonly' => true]) ?>
    <?php } ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>