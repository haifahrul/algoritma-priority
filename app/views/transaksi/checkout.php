<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use app\widgets\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Transaksi */

$this->title = Yii::t('app', 'Create Transaksi');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transaksi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['title'] = $this->title;
$formatter = Yii::$app->formatter;
?>
<div class="transaksi-create">
    <h1><?php Html::encode($this->title) ?></h1>

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
        ]);
        ?>

        <div class="box-body">
            <div class="col-sm-12 col-md-8">
                <?= $form->field($model, 'service_id')->textInput(['disabled' => true, 'value' => $dataService['kode_service']]) ?>

                <?= \yii\grid\GridView::widget([
                    'dataProvider' => $dataProvider,
                    'showHeader' => true,
                    'showOnEmpty' => true,
                    'summary' => '',
                    'tableOptions' => ['class' => 'table table-striped table-bordered table-condensed table-hover'],
                    'columns' => [
                        [
                            'attribute' => 'sparepart_id',
                            'value' => function ($data) {
                                return $data['sparepart']['nama'];
                            }
                        ],
                        [
                            'attribute' => 'qty',
                            'value' => function ($data) {
                                return $data['qty'];
                            }
                        ],
                        [
                            'attribute' => 'harga',
                            'value' => function ($data) {
                                $formatter = Yii::$app->formatter;
                                return $formatter->currencyCode . $formatter->asDecimal($data['sparepart']['harga']);
                            }
                        ]
                    ]
                ]) ?>
                <?= $form->field($model, 'total_pembayaran')->textInput(['maxlength' => true, 'disabled' => true, 'value' => $formatter->currencyCode . $formatter->asDecimal($totalPembayaran)]) ?>
                <?= $form->field($model, 'total_pembayaran')->hiddenInput(['maxlength' => true, 'readonly' => true, 'value' => $totalPembayaran])->label(false) ?>
            </div>
            <div class="col-sm-12 col-md-4 col-md-push-0">
                <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'disabled' => true, 'value' => $dataCustomer['nama']]) ?>
                <?= $form->field($model, 'no_telp')->textInput(['maxlength' => true, 'disabled' => true, 'value' => $dataCustomer['no_telp']]) ?>
                <?= $form->field($model, 'no_plat')->textInput(['maxlength' => true, 'disabled' => true, 'value' => $dataKendaraan['no_plat']]) ?>
            </div>
        </div>
        <div class="box-footer">
            <?= Html::submitButton('<i class="glyphicon glyphicon-floppy-disk glyphicon-sm"> </i>' . Yii::t('app', ' Simpan'), ['class' => 'btn btn-primary btn-sm']) ?>
            <?= Html::a('<i class="glyphicon glyphicon-remove glyphicon-sm"></i> Cancel ', Yii::$app->request->referrer, ['class' => 'btn btn-danger btn-sm']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

</div>