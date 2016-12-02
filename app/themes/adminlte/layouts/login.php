<?php
use app\assets\AdminlteAsset;
use yii\helpers\Html;

AdminlteAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <?php $this->beginBody() ?>

    <body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <img src="#" alt="" class="img-app1">
        </div><!-- /.login-logo -->
        <div class="login-box-body " id="box-shadow">
            <!-- <p class="login-box-msg">Sign in to start your session</p> -->
            <?= $content ?>
        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
    <?php $this->endBody() ?>
    </html>
<?php $this->endPage() ?>