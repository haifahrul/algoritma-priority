<?php
use app\assets_b\AdminAsset;
use yii\helpers\Html;

AdminAsset::register($this);
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

    <body class="hold-transition blank-page">
    <div class="">
        <?= $content ?>
    </div><!-- /.login-box -->
    <?php $this->endBody() ?>
    </html>
<?php $this->endPage() ?>