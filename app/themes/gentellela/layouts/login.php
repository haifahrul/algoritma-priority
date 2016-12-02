<?php
use yii\helpers\Html;
use app\assets\GentellelaAsset;

GentellelaAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Chrome, Firefox OS and Opera -->
        <meta name="theme-color" content="#2A3F54">
        <!-- Windows Phone -->
        <meta name="msapplication-navbutton-color" content="#2A3F54">
        <!-- iOS Safari -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <?php $this->beginBody() ?>

    <body class="login">
        <?= $content ?>
    </body>
    <?php $this->endBody() ?>
    </html>
<?php $this->endPage() ?>