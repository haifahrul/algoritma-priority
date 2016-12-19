<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;

/* @var $model app\models\Service */
/* @var $form yii\widgets\ActiveForm
author A. Fakhrurozi S.
 */

?>
    <div class="service-form form box">
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
        <div class="box-body">
            <?= $form->field($model, 'customer_id')->widget(Select2::className(), [
                'data' => $dataCustomer,
                'options' => ['id' => 'customer-id', 'placeholder' => '--- Select customer ---'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])
            ?>
            <?= $form->field($model, 'kendaraan_id')->widget(DepDrop::className(), [
                'type' => DepDrop::TYPE_SELECT2,
                'options' => ['id' => 'kendaraan-id'],
                'pluginOptions' => [
                    'depends' => ['customer-id'],
                    'placeholder' => '--- Select ---',
                    'url' => Url::to(['/service/list-kendaraan'])
                ]
            ]);
            ?>
            <?= $form->field($model, 'keluhan')->textarea(['rows' => 6]) ?>
        </div>

        <div class="box-footer">
            <?= Html::submitButton('<i class="glyphicon glyphicon-floppy-disk glyphicon-sm"> </i>' . Yii::t('app', ' Simpan'), ['class' => 'btn btn-primary btn-sm']) ?>
            <?= Html::a('<i class="glyphicon glyphicon-remove glyphicon-sm"></i> Cancel ', Yii::$app->request->referrer, ['class' => 'btn btn-danger btn-sm']) ?>
        </div>

        <?php ActiveForm::end(); ?>

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