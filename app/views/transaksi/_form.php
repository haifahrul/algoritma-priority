<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $model app\models\Transaksi */
/* @var $form yii\widgets\ActiveForm 
	author zaza z.h
*/

?>
<div class="transaksi-form form">
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

    <?= $form->field($model, 'service_id')->textInput() ?>

    <?= $form->field($model, 'sparepart_id')->textInput() ?>

    <?= $form->field($model, 'nota')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_pembayaran')->textInput(['maxlength' => true]) ?>

    <div class="col-md-2"></div>    
    <div class="form-group">
        <?= Html::submitButton( '<i class="glyphicon glyphicon-floppy-disk glyphicon-sm"> </i>'.Yii::t('app', ' Simpan') , ['class' => 'btn btn-primary' ]) ?>
        <?= Html::a('<i class="glyphicon glyphicon-remove glyphicon-sm"></i> Cancel ', Yii::$app->request->referrer, ['class' => 'btn btn-danger  ']) ?>
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