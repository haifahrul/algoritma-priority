<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $model app\models\Customer */
/* @var $form yii\widgets\ActiveForm
author zaza z.h
 */
?>
    <div class="col-sm-6 box">
        <div class="box-header with-border">
            <div class="box-title">
                Data Customer
            </div>
        </div>
        <div class="box-body">
            <?php $form = ActiveForm::begin([
                'options' => [
//                    'class' => 'form-horizontal'
                ],
                'layout' => 'horizontal',
//                'fieldConfig' => [
//                    'template' => "<div class=\"col-sm-2\">{label}</div>\n<div class=\"col-sm-10\">{input}{error}</div><div class=\"col-sm-10\"></div>\n",
//                    'labelOptions' => ['class' => 'text-left1'],
//                ],
                //'enableAjaxValidation' => true,
                //'validateOnBlur' => true
            ]); ?>

            <div class="col-sm-6">
                <!-- Data Customer -->
                <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'alamat')->textarea(['maxlength' => true]) ?>
                <?= $form->field($model, 'no_telp')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-6">
                <!-- Data Kendaraan -->
                <!--                --><?php //echo $form->field($model2, 'customer_id')->textInput() ?>
                <?= $form->field($model2, 'merek')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model2, 'tipe')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model2, 'tahun')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model2, 'jenis')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model2, 'no_plat')->textInput(['maxlength' => true]) ?>
            </div>

            <!-- Data Service -->
            <!--                --><?php //echo $form->field($model3, 'customer_id')->textInput() ?>
            <!--                --><?php //echo $form->field($model3, 'kendaraan_id')->textInput() ?>
            <?= $form->field($model3, 'keluhan')->textarea(['rows' => 6]) ?>
        </div>
        <div class="box-footer">
            <?= Html::submitButton('<i class="glyphicon glyphicon-floppy-disk glyphicon-sm"> </i>' . Yii::t('app', ' Simpan'), ['class' => 'btn btn-primary btn-sm']) ?>
            <?= Html::a('<i class="glyphicon glyphicon-remove glyphicon-sm"></i> Cancel ', Yii::$app->request->referrer, ['class' => 'btn btn-danger btn-sm']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

<?php $script = <<<JS
$('body').on('beforeSubmit', 'form#{$model->formName()}', function () {
     var form = $(this);
         if (form.find('.has-error').length) {
              return false;
         }
         // submit form
         $.ajax({
              url: form.attr('action'),
              type: 'post',
              data: form.serialize(),
              success: function (response) {
                form.trigger("reset");
                $.pjax.reload({container:'#grid'});
                
              }
         });
   
     return false;
});
JS;
//$this->registerJs($script);

?>