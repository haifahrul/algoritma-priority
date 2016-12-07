<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */

$this->title = Yii::t('app', 'Test Send SMS');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['title'] = $this->title;
?>

<div class="test-send-sms col-md-6">

    <h1><?php Html::encode($this->title) ?></h1>

    <div class="test-send-sms-form form">

        <?php $form = ActiveForm::begin([
            'method' => 'post',
        ]); ?>

        <?= $form->field($model, 'number')->textInput(['maxlength' => true])->label('Nomor Telepon') ?>
        <?= $form->field($model, 'message')->textarea(['rows' => 6])->label('Pesan') ?>

        <div class="form-group">
            <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end() ?>
    </div>
</div>
