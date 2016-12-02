<?php
use app\assets\AdminlteAsset;
use app\assets\AwesomeAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */
AdminlteAsset::register($this);
AwesomeAsset::register($this);
$breadcrumbs = isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [];

$avatarUser = Yii::$app->params['avatarUrl'] . 'default.jpg';
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/favicon.ico" type="image/x-icon"/>

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<?php $this->beginBody() ?>
<!-- <body class="skin-purple sidebar-mini sidebar-collapse"> -->
<body class="sidebar-mini skin-blue">

<!-- div loading  -->
<div id="loading">
    <!-- <img src='../img/load1.gif' id='img-load' />" -->
    <!-- <img src='img/load1.gif' id='img-load' /> -->
</div>

</div>
<div class="wrapper">
    <?= $this->render('_header', ['avatar' =>$avatarUser]); ?>
    <?= $this->render('_sidebar', ['avatar' =>$avatarUser]); ?>
    <div class="content-wrapper">
        <section class="content-header">
            <h3><?= isset($this->params['breadcrumbs']) ? $this->title : '' ?></h3>
            <?=
            Breadcrumbs::widget([
                'tag' => 'ol',
                'encodeLabels' => false,
                'homeLink' => ['label' => '<i class="fa fa-dashboard"></i> Dashboard', 'url' => ['/site/index']],
                'links' => $breadcrumbs,
            ])
            ?>
        </section>
        <section class="content">
            <?= $content ?>
        </section>
    </div>
    <?php
    if (Yii::$app->session->hasFlash('success') || Yii::$app->session->hasFlash('warning') || Yii::$app->session->hasFlash('danger')):
        echo app\widgets\ToastrFlash::widget([
            'options' => [
                'positionClass' => 'toast-top-right'
            ]
        ]);
    endif;
    ?>
    <footer class="main-footer">
        <strong>Copyright &copy;</strong> <?php date('Y') ?> <a href="#">Topik</a>
        <span class="pull-right">Universitas Mercubuana</span>
    </footer>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>




