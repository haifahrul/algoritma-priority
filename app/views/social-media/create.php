<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SocialMedia */
$this->title = 'Tambah Social Media';
$this->params['breadcrumbs'][] = ['label' => 'Social Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['title'] = $this->title;
?>
<div class="social-media-create">

    <h1><?php Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
