<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sparepart */

$this->title = Yii::t('app', 'Tambah Sparepart');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Spareparts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['title'] = $this->title;
?>
<div class="sparepart-create">

    <h1><?php Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
