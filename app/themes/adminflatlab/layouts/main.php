<?php
/**
 * Created by PhpStorm.
 * User: haifa
 * Date: 13/12/2016
 * Time: 22.57
 */

use app\assets\AwesomeAsset;
use app\assets\AdminFlatLabAsset;
use app\assets\NprogressAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */
AdminFlatLabAsset::register($this);
NprogressAsset::register($this);
$breadcrumbs = isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [];
$avatarUser = Yii::$app->params['avatarUrl'] . 'default.jpg/';
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
<body>
<section id="container">
    <!--header start-->
    <header class="header white-bg">
        <?= $this->render('_header', ['avatarUser' => $avatarUser]); ?>
    </header>
    <!--header end-->

    <!--sidebar start-->
    <aside>
        <?= $this->render('_sidebar'); ?>
    </aside>
    <!--sidebar end-->

    <!--main content start-->
    <section id="main-content">
        <!-- Breadcrumbs -->
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            //'homeLink' => ['url' => Yii::$app->homeUrl, 'label' => 'Home']
        ]) ?>
        <?= $content ?>
    </section>
    <!--main content end-->

    <?php
    if (Yii::$app->session->hasFlash('success') || Yii::$app->session->hasFlash('warning') || Yii::$app->session->hasFlash('danger')):
        echo app\widgets\ToastrFlash::widget([
            'options' => [
                'positionClass' => 'toast-top-right',
            ]
        ]);
    endif;
    ?>

    <!--footer start-->
    <?= $this->render('_footer'); ?>
    <!--footer end-->
</section>

<?php $this->endBody() ?>

<script>
    //owl carousel
    $(document).ready(function () {
        $("#owl-demo").owlCarousel({
            navigation: true,
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true,
            autoPlay: true

        });
    });

    //custom select box
    $(function () {
        $('select.styled').customSelect();
    });
</script>

</body>
</html>
<?php $this->endPage() ?>




