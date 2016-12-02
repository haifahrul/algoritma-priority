<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<div>
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <?php $form = ActiveForm::begin(); ?>
                <h1>Login Form</h1>
                <?= $form->field($model, 'username')->textInput(['autofocus' => TRUE, 'placeholder' => 'Username'])->label(FALSE) ?>
                <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password'])->label(FALSE) ?>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                <?php
                if ($model->captchaNeeded) {
                    echo $form->field($model, 'verifyCode', $fieldOptions3)->widget(Captcha::className());
                }
                ?>
                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-default submit', 'name' => 'login-button']) ?>
                </div>
                <div class="form-group">
                    <?= Yii::t('app', 'If you forgot your password you can') ?> <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                </div>
                <?php ActiveForm::end(); ?>
                <div class="clearfix"></div>
                <div class="separator">
                    <div class="clearfix"></div>
                    <br/>
                    <div>
                        <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                        <p>©2016 All Rights Reserved. Teknik Elektro UMJ! Privacy and Terms</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>