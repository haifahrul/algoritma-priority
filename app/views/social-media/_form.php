<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $model app\models\SocialMedia */
/* @var $form yii\widgets\ActiveForm
author A. Fakhrurozi S.
 */
?>
    <div class="social-media-form form">
        <?php $form = ActiveForm::begin([
            'options' => [
                'class' => 'form-horizontal'],
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "<div class=\"col-md-2\">{label}</div>\n<div class=\"col-md-7\">{input}{error}</div><div class=\"col-md-3\"></div>\n",
                'labelOptions' => ['class' => 'text-left'],
            ],
            //'enableAjaxValidation' => true,
            //'validateOnBlur' => true
        ]); ?>

        <?= $form->field($model, 'social_media')->dropDownList(['facebook' => 'Facebook', 'google' => 'Google', 'twitter' => 'Twitter', 'github' => 'Github',], ['prompt' => '']) ?>

        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'user_id')->textInput() ?>

        <?= $form->field($model, 'created_at')->textInput() ?>

        <?= $form->field($model, 'updated_at')->textInput() ?>

        <div class="col-md-2"></div>
        <div class="form-group">
            <?= Html::a('<i class="glyphicon glyphicon-remove glyphicon-sm"></i> Cancel ', Yii::$app->request->referrer, ['class' => 'btn btn-danger  ']) ?>
            <?= Html::submitButton('<i class="glyphicon glyphicon-floppy-disk glyphicon-sm"> </i>' . ' Simpan', ['class' => 'btn btn-primary']) ?>
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