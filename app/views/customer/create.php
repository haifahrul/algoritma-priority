<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */

$this->title = Yii::t('app', 'Tambah Customer');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['title'] = $this->title;
?>
<div class="customer-create">
    <div class="table-responsive">
        <?= $this->render('_form', [
            'model' => $model,
            'model2' => $model2,
            'model3' => $model3,
        ]) ?>
    </div>
</div>
