<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Attribute */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Attribute',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Attribute'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="attribute-update">

    <h1><?php //Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
