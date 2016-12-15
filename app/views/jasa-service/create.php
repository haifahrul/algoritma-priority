<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JasaService */

$this->title = Yii::t('app', 'Tambah Jasa Service');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Jasa Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['title'] = $this->title;
?>
<div class="jasa-service-create">

    <h1><?php Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
