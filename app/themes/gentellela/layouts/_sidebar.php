<?php
use themes\gentellela\components\Nav;
use yii\helpers\Url;

?>
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="<?= Yii::$app->homeUrl ?>" class="site_title"><i><img
                        src="<?= Yii::$app->params['logo'] ?>" height="60" width="90"></i> <span>Jadwal P2K</span></a>
        </div>
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section"><br><br><br>
                <?php
                if (Yii::$app->user->can('admin')) {
                    $items = Yii::$app->menus->getMenuAdmin();
                } else if (Yii::$app->user->can('webmaster')) {
                    $items = Yii::$app->menus->getMenuWebmaster();
                }
                echo Nav::widget([
                    'encodeLabels' => FALSE,
                    'items' => $items,
                ]);
                ?>
            </div>
        </div>
        <!-- /sidebar menu -->
        <!-- /menu footer buttons -->
        <!--<div class="sidebar-footer hidden-small">-->
        <!--    <a data-toggle="tooltip" data-placement="top" title="Settings">-->
        <!--        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>-->
        <!--    </a>-->
        <!--    <a data-toggle="tooltip" data-placement="top" title="FullScreen">-->
        <!--        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>-->
        <!--    </a>-->
        <!--    <a data-toggle="tooltip" data-placement="top" title="Lock">-->
        <!--        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>-->
        <!--    </a>-->
        <!--    <a data-toggle="tooltip" data-placement="top" title="Logout">-->
        <!--        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>-->
        <!--    </a>-->
        <!--</div>-->
        <!-- /menu footer buttons -->
    </div>
</div>