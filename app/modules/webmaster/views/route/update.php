<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\Route */

$this->title = 'Update Route: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Routes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="route-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
