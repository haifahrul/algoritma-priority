<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Kendaraan */

$this->title = Yii::t('app', 'Tambah Kendaraan');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kendaraans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['title'] = $this->title;
?>
<div class="kendaraan-create">

    <h1><?php Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataCustomer' => $dataCustomer
    ]) ?>

</div>
