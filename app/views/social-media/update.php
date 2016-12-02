<?php
/* @var $this yii\web\View */
/* @var $model app\models\SocialMedia */
$this->title = 'Perbaharui Social Media: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Social Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Perbaharui';
?>
<div class="social-media-update">

    <h1><?php //Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
