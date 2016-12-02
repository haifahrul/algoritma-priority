<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
use app\widgets\Select2Widget;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nav-tabs-custom">

    <ul class="nav nav-tabs">
      <li class="active"><a href="#">Kelola User</a></li>
      
    </ul>   
    <p>
        <?= Html::a('daftar user', ['index', ], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('edit', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'email:email',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value'=> $model->status == 10 ? 'aktif' : 'no aktif'
                // Other options
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

    <?php $form = ActiveForm::begin([]); ?>
    <?php 
        echo $form->field($authAssignment, 'item_name')->widget(
            Select2Widget::className(),
            [
                'items'=>$authItems,
                'multiple' => true,
            ]
        )->label('Role'); 

     ?>
    <?php
    /*echo $form->field($authAssignment, 'item_name')->widget(Select2::classname(), [
      'data' => $authItems,
      'options' => [
        'placeholder' => 'Pilih role ...',
      ],
      'pluginOptions' => [
        'allowClear' => true,
        'multiple' => true,
      ],
    ])->label('Role');*/ ?>

    <div class="form-group">
        <?= Html::submitButton('<span class="fa fa-retweet"></span>'.' Reset', [
            'class' => 'btn btn-danger',
            'name'=>'reset',
            'data-confirm'=>"Apakah anda yakin mereset data ini ?",
        ]) ?>
        <?= Html::submitButton('<span class="fa fa-save"></span>'.' Simpan', [
            'class' => $authAssignment->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            //'data-confirm'=>"Apakah anda yakin akan menyimpan data ini?",
        ]) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
