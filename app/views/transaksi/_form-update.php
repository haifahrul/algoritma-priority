<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;

/* @var $model app\models\Transaksi */
/* @var $form yii\widgets\ActiveForm
author A. Fakhrurozi S.
 */

?>
    <div class="transaksi-form form box">
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
            <?= $form->field($model, 'service_id')->widget(Select2::className(), [
                'data' => $dataService,
                'options' => ['placeholder' => '--- Select kode service ---', 'id' => 'service_id'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>
            <?= $form->field($model, 'sparepart_id')->widget(Select2::className(), [
                'data' => $dataSparepart,
                'options' => ['placeholder' => '--- Select sparepart ---'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>
            <?= $form->field($model, 'nota')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'total_pembayaran')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="box-footer">
            <?= Html::submitButton('<i class="glyphicon glyphicon-floppy-disk glyphicon-sm"> </i>' . Yii::t('app', ' Simpan'), ['class' => 'btn btn-primary btn-sm']) ?>
            <?= Html::a('<i class="glyphicon glyphicon-remove glyphicon-sm"></i> Cancel ', Yii::$app->request->referrer, ['class' => 'btn btn-danger btn-sm']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

<?php $script = <<<JS
    
    $('#service_id').change(function(data){
        var customer_id = $('#service_id').val();
        alert(customer_id);
    });
    
JS;
$this->registerJs($script);
?>