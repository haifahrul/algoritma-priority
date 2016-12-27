<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use app\widgets\DynamicFormWidget;

/* @var $model app\models\Transaksi */
/* @var $form yii\widgets\ActiveForm
author A. Fakhrurozi S.
 */
?>

    <div class="transaksi-form form box">
        <?php $form = ActiveForm::begin([
            'id' => 'dynamic-form',
//            'options' => [
//                'class' => 'form-horizontal'
//            ],
//            'layout' => 'horizontal',
//            'fieldConfig' => [
////                'template' => "<div class=\"col-md-3\">{label}</div>\n<div class=\"col-md-8\">{input}{error}</div><div class=\"col-md-3\"></div>\n",
//                'template' => "<div class=\"\">{label}</div>\n<div class=\"col-md-8\">{input}{error}</div><div class=\"col-md-3\"></div>\n",
//                'labelOptions' => ['class' => 'text-left'],
//            ],
            //'enableAjaxValidation' => true,
            //'validateOnBlur' => true
        ]); ?>

        <div class="box-body">
            <div class="col-sm-12 col-md-7">
                <?= $form->field($model, 'service_id')->widget(Select2::className(), [
                    'data' => $dataService,
                    'options' => ['placeholder' => '--- Select kode service ---', 'id' => 'service_id'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]) ?>
                <!--                --><?php //$form->field($model, 'sparepart_id')->widget(Select2::className(), [
                //                    'data' => $dataSparepart,
                //                    'options' => ['placeholder' => '--- Select sparepart ---'],
                //                    'pluginOptions' => [
                //                        'allowClear' => true
                //                    ],
                //                ]) ?>

                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.input-item', // required: css class
                    'limit' => 999, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add-item', // css class
                    'deleteButton' => '.remove-item', // css class
                    'model' => $modelTransaksiSparepart[0],
                    'formId' => 'dynamic-form',
                    'formFields' => [
                        'sparepart_id',
                        'qty',
                        'harga'
                    ],
                ]); ?>

                <div class="table-responsive--">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th></th>
                            <th><?= Yii::t('app', 'Nama') ?></th>
                            <th><?= Yii::t('app', 'Qty') ?></th>
                            <th><?= Yii::t('app', 'Harga') ?></th>
                        </tr>
                        </thead>
                        <tbody class="container-items">
                        <?php foreach ($modelTransaksiSparepart as $i => $modelTransaksiSparepart): ?>
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
                                <td>
                                    <?php echo $form->field($modelTransaksiSparepart, "[{$i}]sparepart_id")->textInput()->label(FALSE) ?>
                                </td>
                                <td>
                                    <?= $form->field($modelTransaksiSparepart, "[{$i}]qty")->textInput()->label(FALSE) ?>
                                </td>
                                <td>
                                    <?= $form->field($modelTransaksiSparepart, "[{$i}]harga")->textInput(['readonly' => true])->label(FALSE) ?>
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
            <div class="col-sm-12 col-md-4 col-md-push-1">
                <?= $form->field($model, 'nama')->textInput(['id' => 'nama', 'maxlength' => true, 'disabled' => true]) ?>
                <?= $form->field($model, 'no_telp')->textInput(['id' => 'no_telp', 'maxlength' => true, 'disabled' => true]) ?>
                <?= $form->field($model, 'no_plat')->textInput(['id' => 'no_plat', 'maxlength' => true, 'disabled' => true]) ?>
                <?= $form->field($model, 'total_pembayaran')->textInput(['maxlength' => true, 'readonly' => true]) ?>
            </div>
        </div>
        <div class="box-footer">
            <?= Html::submitButton('<i class="glyphicon glyphicon-floppy-disk glyphicon-sm"> </i>' . Yii::t('app', ' Simpan'), ['class' => 'btn btn-primary btn-sm']) ?>
            <?= Html::a('<i class="glyphicon glyphicon-remove glyphicon-sm"></i> Cancel ', Yii::$app->request->referrer, ['class' => 'btn btn-danger btn-sm']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

<?php
$url = Url::to(['get-customer']);
$js = <<< JS
    var service = $('#service_id');
    var nama = $('#nama');
    var no_telp = $('#no_telp');
    var no_plat = $('#no_plat');
        
    service.change(function(data){
        var id = $(this).val(); 
        $.ajax({
            type: "get",
            id: id,
            url: '$url',
            dataType: "JSON",
            data: {id: id},
            success: function(data) {
                nama.val(data.nama);
                no_telp.val(data.no_telp);
                no_plat.val(data.no_plat);
            },
            // error: function(data) {
            //     console.log(data);
            // }
        });
    });
    
JS;
$this->registerJs($js);
?>