<?php
use app\assets\AwesomeAsset;
use app\assets\GentellelaAsset;
use app\assets\NprogressAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */
GentellelaAsset::register($this);
AwesomeAsset::register($this);
NprogressAsset::register($this);
$breadcrumbs = isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [];
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
    <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/favicon.ico" type="image/x-icon"/>

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<?php $this->beginBody() ?>
<!-- <body class="skin-purple sidebar-mini sidebar-collapse"> -->
<body class="nav-md">

<div class="container body">
    <div class="main_container">

        <?= $this->render('_header'); ?>
        <?= $this->render('_sidebar'); ?>

        <!-- page content -->
        <div class="right_col" role="main">
            <!-- Breadcrumbs -->
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                //'homeLink' => ['url' => Yii::$app->homeUrl, 'label' => 'Home']
            ]) ?>
            <?= $content ?>
        </div>
        <?php
        if (Yii::$app->session->hasFlash('success') || Yii::$app->session->hasFlash('warning') || Yii::$app->session->hasFlash('danger')):
            echo app\widgets\ToastrFlash::widget([
                'options' => [
                    'positionClass' => 'toast-top-right',

                ]
            ]);
        endif;
        ?>

        <!-- footer content -->
        <footer>
            <div class="pull-right">
                <?= Yii::t('app', 'Majoring in Electrical, Engineering Faculty University of Muhammadiyah Jakarta') ?>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>




