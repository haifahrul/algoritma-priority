<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\webmaster\models\Config */

$this->title = Yii::t('app', 'Tambah Config');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Configs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['title'] = $this->title;
?>
<div class="config-create">

    <h1><?php Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
