<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\webmaster\components\Mimin;

/* @var $this yii\web\View */
/* @var $model app\models\JasaService */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Jasa Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['title'] = $this->title;
$formatter = Yii::$app->formatter;
?>

<div class="jasa-service-view box">
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
        </p>
    </div>
    <div class="box-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'nama',
                [
                    'attribute' => 'biaya',
                    'value' => $formatter->currencyCode . ' ' . $formatter->asDecimal($model->biaya)
                ]
            ],
        ]) ?>
    </div>
</div>