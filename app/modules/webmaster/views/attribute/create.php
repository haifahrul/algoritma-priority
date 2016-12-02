<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Attribute */

$this->title = Yii::t('app', 'Tambah Attribute');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Attribute'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['title'] = $this->title;
?>
<div class="attribute-create">

    <h1><?php Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
