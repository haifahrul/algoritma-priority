<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use app\modules\webmaster\models\Attribute;

/* @var $model app\models\Kendaraan */
/* @var $form yii\widgets\ActiveForm
author A. Fakhrurozi S.
 */

?>
    <div class="box">
        <div class="kendaraan-form form">
            <div class="box-body">
                <?php $form = ActiveForm::begin([
                    'options' => [
                        'class' => 'form-horizontal'],
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "<div class=\"col-md-2\">{label}</div>\n<div class=\"col-md-7\">{input}{error}</div><div class=\"col-md-3\"></div>\n",
                        'labelOptions' => ['class' => 'text-left1'],
                    ],
                    //'enableAjaxValidation' => true,
                    //'validateOnBlur' => true

                ]); ?>

                <?= $form->field($model, 'customer_id')->widget(Select2::className(), [
                    'data' => $dataCustomer,
                    'options' => ['placeholder' => '--- Select customer ---'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]) ?>
                <?= $form->field($model, 'no_plat')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'merek')->widget(Select2::className(), [
                    'data' => Attribute::one_row_attribute('merek'),
                    'options' => ['placeholder' => '--- Select Merek ---'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]) ?>
                <?= $form->field($model, 'tipe')->widget(Select2::className(), [
                    'data' => Attribute::one_row_attribute('tipe'),
                    'options' => ['placeholder' => '--- Select Tipe ---'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]) ?><?= $form->field($model, 'jenis')->widget(Select2::className(), [
                    'data' => Attribute::one_row_attribute('jenis'),
                    'options' => ['placeholder' => '--- Select Jenis ---'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]) ?>
                <?= $form->field($model, 'tahun')->widget(DatePicker::classname(), [
                    'type' => DatePicker::TYPE_INPUT,
                    'pluginOptions' => [
                        'autoclose' => true,
                        //'endDate' => 'today',
                        'format' => 'yyyy',
                        'viewMode' => 'years',
                        'minViewMode' => 'years',
                        'removeButton' => true,
                    ]
                ]);
                ?>
            </div>

            <div class="box-footer">
                <?= Html::submitButton('<i class="glyphicon glyphicon-floppy-disk glyphicon-sm"> </i>' . Yii::t('app', ' Simpan'), ['class' => 'btn btn-primary btn-sm']) ?>
                <?= Html::a('<i class="glyphicon glyphicon-remove glyphicon-sm"></i> Cancel ', Yii::$app->request->referrer, ['class' => 'btn btn-danger btn-sm']) ?>
            </div>
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