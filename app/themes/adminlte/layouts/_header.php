<?php
use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Url;
use app\modules\webmaster\components\Mimin;
//use app\widgets\adminlte\Nav;
use themes\adminlte\components\Nav;

// $notifikasi =  Yii::$app->mycomponent->countExp(); 
//$listExp = Yii::$app->mycomponent->listExpLimit(5);
if (!Yii::$app->user->isGuest)
    $username = Yii::$app->user->identity->username;
else
    $username = "User Guest";
/* @var $this View */

$items = Yii::$app->menus->headerMenuWebmaster();
$menuItems = Mimin::filterRouteMenu($items);
?>

<header class="main-header">
    <a href="<?= Yii::$app->homeUrl; ?>" class="logo">
        <span class="logo-mini"><b>T</b></span>
        <span class="logo-lg"><?= Yii::$app->name ?></span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <!-- Navbar Menu sebelah kanan -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Notifications: dropdown bell -->
                <!--                <li class="dropdown notifications-menu">-->
                <!--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"-->
                <!--                       title="agenda">-->
                <!--                        <i class="fa fa-bell-o"></i>-->
                <!--                        <span class="label label-warning">jml agenda</span>-->
                <!--                    </a>-->
                <!--                    <ul class="dropdown-menu">-->
                <!--                        <li class="header"> agenda</li>-->
                <!--                        <li>-->
                <!--                            <ul class="menu">-->
                <!--                                <li>-->
                <!--                                    <a href="#">-->
                <!--                                        <i class="fa fa-fa-square text-aqua"></i> judul<span-->
                <!--                                            class="label-success label">&nbsp;tanggal </span>-->
                <!--                                    </a>-->
                <!--                                </li>-->
                <!---->
                <!--                            </ul>-->
                <!--                        </li>-->
                <!--                        <li class="footer"><a href="-->
                <?php //echo Url::to(["/event/index"]) ?><!--">View all</a>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!---->
                <!--                </li>-->

                <!-- Settings -->
                <?php if (Yii::$app->user->can('webmaster')) { ?>
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Settings"><i
                                class="fa fa-gears"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <?php
                            echo Nav::widget([
                                'items' => $menuItems,
                            ]);
                            ?>
                        </ul>
                    </li>
                <?php } ?>

                <!-- User Account: -->
                <li class="dropdown user user-menu">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= $avatar ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs">Username </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src='<?= $avatar ?>' class="img-circle" alt="User Image">
                            <p>
                                <?php echo $username ?>
                                <small>nama</small>
                                <small>rolename</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body1">
                            <div class="col-xs-4 text-center">
                            </div>
                            <div class="col-xs-4 text-center">
                            </div>
                            <div class="col-xs-4 text-center">
                            </div>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?= Html::a('Profile', Url::to(['/personal/index']), ['class' => 'btn btn-default btn-flat']); ?>
                                <!-- <a href="" class="btn btn-default btn-flat">Profile</a> -->
                            </div>
                            <div class="pull-right">
                                <?php
                                //cek sign atau sigout
                                if (Yii::$app->user->isGuest) {
                                    echo Html::a("Sign In ", Url::to(["/site/login"]), ['class' => 'btn btn-default btn-flat', 'linkOptions' => ['data-method' => 'post']]);
                                } else {
                                    //$btnsigin = Html::a("Sign out ",  yii\helpers\Url::to(["/site/logout"]) , ['class' => 'btn btn-default btn-flat', ]);
                                    echo Html::beginForm(['/site/logout'], 'post');
                                    echo Html::submitButton('Sign out', ['class' => 'btn btn-default btn-flat']);
                                    echo Html::endForm();
                                }
                                ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>