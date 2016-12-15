<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;

/* @var $model app\models\Service */
/* @var $form yii\widgets\ActiveForm
author A. Fakhrurozi S.
 */

$this->title = Yii::t('app', 'Tambah Service');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['title'] = $this->title;
?>

    <div class="service-create ">
        <div class="box">
            <div class="box-body">
                <h1><?php Html::encode($this->title) ?></h1>

                <div class="service-form form">
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
                    <?= $form->field($model, 'customer_id')->textInput(['maxlength' => true, 'disabled' => true, 'value' => $service['customer']['nama']]) ?>
                    <?= $form->field($model, 'kendaraan_id')->textInput(['maxlength' => true, 'disabled' => true, 'value' => $service['no_plat']]) ?>
                    <!-- Value -->

                    <?= $form->field($model, 'keluhan')->textarea(['rows' => 6]) ?>

                </div>
                <div class="box-footer">
                    <?= Html::submitButton('<i class="glyphicon glyphicon-floppy-disk glyphicon-sm"> </i>' . Yii::t('app', ' Simpan'), ['class' => 'btn btn-primary btn-sm']) ?>
                    <?= Html::a('<i class="glyphicon glyphicon-remove glyphicon-sm"></i> Cancel ', ['/kendaraan/index'], ['class' => 'btn btn-danger btn-sm']) ?>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
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