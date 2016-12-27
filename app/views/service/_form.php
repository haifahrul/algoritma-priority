<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;
use app\widgets\DynamicFormWidget;
use wbraganca\selectivity\SelectivityWidget;
use yii\jui\AutoComplete;

/* @var $model app\models\Service */
/* @var $form yii\widgets\ActiveForm
author A. Fakhrurozi S.
 */
?>
    <div class="service-form box">
        <?php $form = ActiveForm::begin([
            'id' => 'dynamic-form',
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
                'data' => $model->isNewRecord ? [] : $dataKendaraan,
                'options' => ['id' => 'kendaraan-id'],
                'pluginOptions' => [
                    'depends' => ['customer-id'],
                    'placeholder' => '--- Select ---',
                    'url' => Url::to(['/service/list-kendaraan'])
                ]
            ]);
            ?>
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.input-item', // required: css class
                'limit' => 999, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelServiceDetail[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'nama'
                ],
            ]); ?>

            <div class="table-responsive--">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th></th>
                        <th><?= Yii::t('app', 'Nama Service') ?></th>
                        <th><?= Yii::t('app', 'Qty') ?></th>
                    </tr>
                    </thead>
                    <tbody class="container-items">
                    <?php foreach ($modelServiceDetail as $i => $modelServiceDetail): ?>
                        <?php
                        // necessary for update action.
//                        if (!$modelServiceDetail->isNewRecord) {
//                            echo Html::activeHiddenInput($modelServiceDetail, "[{$i}]service_id");
//                        }
                        ?>
                        <tr class="input-item">
                            <td class="text-center">
                                <button type="button" class="remove-item btn btn-danger btn-xs"><i
                                        class="fa fa-minus"></i></button>
                            </td>
                            <td class="col-md-10">
                                <!--                                --><?php //echo $form->field($modelServiceDetail, "[{$i}]nama")->widget(AutoComplete::className(), [
                                //                                    'clientOptions' => [
                                //                                        'source' => $dataSparepart,
                                //                                    ],
                                //                                ])->label(false) ?>
                                <?php echo $form->field($modelServiceDetail, "[{$i}]nama")->textInput()->label(FALSE) ?>
                                <!--                                --><?php //echo $form->field($modelServiceDetail, "[{$i}]nama")->widget(SelectivityWidget::className(), [
                                //                                    'pluginOptions' => [
                                //                                        'allowClear' => true,
                                //                                        'items' => $dataSparepart,
                                //                                        'placeholder' => 'No city selected'
                                //                                    ]
                                //                                ])->label(false) ?>
                            </td>
                            <td>
                                <?= $form->field($modelServiceDetail, "[{$i}]qty")->textInput()->label(FALSE) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="3" class="text-right">
                            <!--                            --><?php //if ($model->isNewRecord) { ?>
                            <?= Html::button('<span class = "glyphicon glyphicon-plus"></span> ' . Yii::t('app', ''), ['class' => 'add-item btn btn-success btn-xs']) ?>
                            <!--                            --><?php //} ?>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <?php DynamicFormWidget::end(); ?>
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