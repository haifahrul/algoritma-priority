<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Transaksi */

$this->title = $model['service']['kode_service'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transaksi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['title'] = $this->title;
$formatter = Yii::$app->formatter;
?>

<div class="transaksi-view box">
    <div class="box-header with-border">
        <h1><?php Html::encode($this->title) ?></h1>
        <p>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    </div>
    <div class="box-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
//                'id',
                [
                    'attribute' => 'service_id',
                    'format' => 'raw',
                    'value' => $model['service']['kode_service']
                ],
                [
                    'attribute' => 'sparepart_id',
                    'format' => 'raw',
                    'value' => $model['sparepart']['nama']
                ],
                'nota',
                [
                    'attribute' => 'total_pembayaran',
                    'format' => 'raw',
                    'value' => $formatter->currencyCode . $formatter->asDecimal($model['total_pembayaran'])
                ],
            ],
        ]) ?>
    </div>
</div>