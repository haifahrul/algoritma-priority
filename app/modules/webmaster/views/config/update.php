<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\webmaster\models\Config */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Config',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Configs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="config-update">

    <h1><?php //Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
