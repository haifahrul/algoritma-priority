<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\Route */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Routes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nav-tabs-custom">

    <ul class="nav nav-tabs">
      <li><a href="">Kelola Role <?= $model->name ?></a></li>
      
    </ul> 

    <p>
        <?= Html::a('Index', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->name], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->name], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'alias',
            'type',
            'status',
        ],
    ]) ?>

</div>
