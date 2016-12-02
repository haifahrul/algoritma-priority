<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\SwitchBox;

/* @var $this yii\web\View */
/* @var $model app\modules\webmasteristrator\models\Route */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="nav-tabs-custom">

    <ul class="nav nav-tabs">
      <li class="active"><a href="">Kelola Route</a></li>
      
    </ul> 

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

     <?= $form->field($model, 'status')->widget(SwitchBox::className(),[
      'clientOptions' => [ 'size' => 'normal', 'onText' => 'On', 'offText' => 'Off' ] 

      ]);
      ?> 

  
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'simpan' : 'Perbaharui', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
