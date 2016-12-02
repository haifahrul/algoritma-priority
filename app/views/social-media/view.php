<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SocialMedia */
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Social Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['title'] = $this->title;
echo app\widgets\ToastrFlash::widget([
    'options' => [
        'positionClass' => 'toast-top-right'
    ]
]);
?>
<div class="social-media-view">


    <h1><?php Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Perbaharui', ['update', 'id' => $model->id, 'user_id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete', 'id' => $model->id, 'user_id' => $model->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Apakah anda yakin menghapus item ini?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'social_media',
            'id',
            'username',
            'user_id',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>