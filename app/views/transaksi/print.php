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
    </div>
    <div class="box-body">
        <div class="col-md-4 col-xs-12">
            <?= DetailView::widget([
                'model' => $transaksi,
                'attributes' => [
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
                        'attribute' => 'alamat',
                        'format' => 'raw',
                        'value' => $transaksi['customer']['alamat']
                    ],
                    [
                        'attribute' => 'no_telp',
                        'format' => 'raw',
                        'value' => $transaksi['customer']['no_telp']
                    ],
                    [
                        'attribute' => 'email',
                        'format' => 'raw',
                        'value' => $transaksi['customer']['email']
                    ],
                    [
                        'attribute' => 'no_plat',
                        'format' => 'raw',
                        'value' => $transaksi['kendaraan']['no_plat']
                    ],
                    [
                        'attribute' => 'merek',
                        'format' => 'raw',
                        'value' => $transaksi['kendaraan']['merek']
                    ],
                    [
                        'attribute' => 'tipe',
                        'format' => 'raw',
                        'value' => $transaksi['kendaraan']['tipe']
                    ],
                    [
                        'attribute' => 'jenis',
                        'format' => 'raw',
                        'value' => $transaksi['kendaraan']['jenis']
                    ],
                    [
                        'attribute' => 'tahun',
                        'format' => 'raw',
                        'value' => $transaksi['kendaraan']['tahun']
                    ],
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