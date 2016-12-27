<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\webmaster\components\Mimin;

/* @var $this yii\web\View */
/* @var $model app\models\Transaksi */

$this->title = $transaksi['nota'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transaksi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['title'] = $this->title;
$formatter = Yii::$app->formatter;
?>

<div class="transaksi-view box">
    <div class="box-header with-border">
        <h1><?php Html::encode($this->title) ?></h1>
        <p>
            <?= Html::a('<i class="fa fa-arrow-left"></i><b> Kembali</b> ', ['index'],
                ['data-pjax' => 0, 'class' => 'btn btn-default btn-sm btn-tambah1']) ?>
            <?php
            //            if ((Mimin::filterRoute($this->context->id . '/delete', true))) {
            //                echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $transaksi['id']], ['class' => 'btn btn-primary btn-sm']);
            //            }
            ?>
            <?php
            echo Html::a(Yii::t('app', 'Print'), ['print', 'id' => $transaksi['id']], ['class' => 'btn btn-success btn-sm']);
            ?>
            <?php
            if ((Mimin::filterRoute($this->context->id . '/delete', true))) {
                echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $transaksi['id']], [
                    'class' => 'btn btn-danger btn-sm',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]);
            }
            ?>
        </p>
    </div>
    <div class="box-body">
        <div class="col-md-4 col-xs-12">
            <?= DetailView::widget([
                'model' => $transaksi,
                'attributes' => [
//                'id',
                    'nota',
                    [
                        'attribute' => 'service',
                        'format' => 'raw',
                        'value' => $transaksi['service']['kode_service']
                    ],
                    [
                        'attribute' => 'customer',
                        'format' => 'raw',
                        'value' => $transaksi['customer']['nama']
                    ],
                    [
                        'attribute' => 'no_telp',
                        'format' => 'raw',
                        'value' => $transaksi['customer']['no_telp']
                    ],
//                    [
//                        'attribute' => 'total_pembayaran',
//                        'format' => 'raw',
//                        'value' => $formatter->currencyCode . $formatter->asDecimal($transaksi['total_pembayaran'])
//                    ],
                ],
            ]) ?>
        </div>
        <div class="col-md-8 col-xs-12">
            <?= \yii\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'showHeader' => true,
                'showOnEmpty' => true,
                'summary' => '',
                'tableOptions' => ['class' => 'table table-striped table-bordered table-condensed table-hover'],
                'columns' => [
                    [
                        'attribute' => 'sparepart',
                        'value' => function ($data) {
                            return $data['sparepart']['nama'];
                        }
                    ],
                    'qty',
                    [
                        'attribute' => 'harga',
                        'value' => function ($data) {
                            $formatter = Yii::$app->formatter;
                            return $formatter->currencyCode . $formatter->asDecimal($data['sparepart']['harga']);
                        }
                    ],
                    [
                        'attribute' => 'total',
                        'value' => function ($data) {
                            $formatter = Yii::$app->formatter;
                            return $formatter->currencyCode . $formatter->asDecimal($data['qty'] * $data['sparepart']['harga']);
                        }
                    ],
                ]
            ]) ?>
            <h4><b>Total
                    Pembayaran <?= $formatter->currencyCode . $formatter->asDecimal($transaksi['total_pembayaran']) ?> </b>
            </h4>
        </div>
    </div>
</div>