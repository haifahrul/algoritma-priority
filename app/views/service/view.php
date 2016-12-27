<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\webmaster\models\Attribute;
use app\models\Service;
use app\modules\webmaster\components\Mimin;

/* @var $this yii\web\View */
/* @var $model app\models\Service */

$this->title = $model->kode_service . ' | ' . $model->kendaraan->no_plat;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['title'] = $this->title;
$formater = Yii::$app->formatter;
?>
<div class="service-view box">
    <div class="box-header with-border">
        <h1><?php Html::encode($this->title) ?></h1>
        <p>
            <?php
            if ((Mimin::filterRoute($this->context->id . '/delete', true))) {
                echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']);
            }
            ?>
            <?php
            if ((Mimin::filterRoute($this->context->id . '/delete', true))) {
                echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger btn-sm',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]);
            }
            ?>
            <?php
                echo Html::a(Yii::t('app', 'Checkout'), ['/transaksi/create', 'id' => $model->id], ['class' => 'btn btn-success btn-sm']);
            ?>
        </p>
    </div>
    <div class="box-body">
        <div class="col-md-6 col-xs-12">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
//                'id',
                    'kode_service',
                    'customer.nama',
                    'kendaraan.no_plat',
                    [
                        'attribute' => 'kendaraan.merek',
                        'fornmat' => 'raw',
                        'value' => Attribute::attribute_view('merek', $model->kendaraan->merek)
                    ],
                    [
                        'attribute' => 'kendaraan.tipe',
                        'fornmat' => 'raw',
                        'value' => Attribute::attribute_view('tipe', $model->kendaraan->tipe)
                    ],
                    [
                        'attribute' => 'kendaraan.jenis',
                        'fornmat' => 'raw',
                        'value' => Attribute::attribute_view('jenis', $model->kendaraan->jenis)
                    ],
                    'kendaraan.tahun',
                    [
                        'attribute' => 'created_at',
                        'format' => 'raw',
                        'value' => $formater->asDatetime($model['created_at'])
                    ],
                    [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'value' => Service::getStatus($model->status)
                    ]
                ],
            ]) ?>
        </div>
        <div class="col-md-6 col-xs-12">
            <?= \yii\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'showHeader' => true,
                'showOnEmpty' => true,
                'summary' => '',
                'tableOptions' => ['class' => 'table table-striped table-bordered table-condensed table-hover'],
                'columns' => ['nama', 'qty']
            ]) ?>
        </div>
    </div>
</div>