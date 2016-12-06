<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>
<div class="site-login">
    <br>
    <div class="row">
        <div class="col s12 m6 offset-m3">
            <h1 class="center-align"><?= Html::encode($this->title) ?></h1>
            <?php $form = ActiveForm::begin([
                'fieldConfig' => [
//                    'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
//                    'labelOptions' => ['class' => 'col-lg-1 control-label'],
//                    'template' => "{label}\n<div class=\"col m12 s12\">{input}</div>\n<div class=\"col m12 s12\">{error}</div>",
//                    'labelOptions' => ['class' => 'col m1 s12'],
                        'template' => "{label}{input}{error}",
//                        'labelOptions' => ['class' => 'col s12 m6 offset-m3']
                ],
            ]); ?>

            <div class="input-field">
                <?php echo $form->field($model, 'username')->textInput(['class' => 'validate']) ?>
            </div>
            <div class="input-field">
                <?php echo $form->field($model, 'password')->passwordInput() ?>
            </div>

            <!--            <div class="row">-->
            <!--                <div class="input-field">-->
            <!--                    <input id="username" type="text" class="validate">-->
            <!--                    <label for="username" data-error="Tolong diisi">Username</label>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            <div class="row">-->
            <!--                <div class="input-field">-->
            <!--                    <input id="password" type="password" class="validate">-->
            <!--                    <label for="password">Password</label>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            <div class="row">-->
            <?= Html::submitButton('Login', ['class' => 'col s12 waves-effect waves-light btn']) ?>
            <!--            </div>-->

            <?php ActiveForm::end(); ?>
            <!--        </div>-->
        </div>
    </div>
</div>