<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\webmaster\components\Mimin;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */

$this->title = $model->kode_customer . ' | ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['title'] = $this->title;
?>

<div class="customer-view box">
    <div class="box-header with-border">
        <h1><?php Html::encode($this->title) ?></h1>
        <p>
            <?= Html::a('<i class="fa fa-arrow-left"></i><b> Kembali</b> ', ['index'],
                ['data-pjax' => 0, 'class' => 'btn btn-default btn-sm btn-tambah1']) ?>
            <?= Html::a('<i class="glyphicon glyphicon-plus glyphicon-sm"></i> Create Customer Baru ', ['create-new-customer'],
                ['data-pjax' => 0, 'class' => 'btn btn-primary btn-sm btn-tambah1']) ?>
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
        </p>
    </div>
    <div class="box-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'kode_customer',
                'nama',
                'alamat',
                'no_telp',
                'email:email',
            ],
        ]) ?>
    </div>
</div>