<?php
use yii\helpers\Url;
use yii\helpers\Html;

?>
<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="#" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="<?= Yii::$app->params['avatarUrl'] . '/default.jpg' ?>" alt=""> <?= Yii::$app->user->identity->username ?>
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="<?= Url::to(['site/profile']) ?>"> <?= Yii::t('app', 'Profile') ?> </a></li>
                        <!--                        <li>-->
                        <!--                            <a href="javascript:;">-->
                        <!--                                <span class="badge bg-red pull-right">50%</span>-->
                        <!--                                <span>--><? //= Yii::t('app', 'Settings') ?><!--</span>-->
                        <!--                            </a>-->
                        <!--                        </li>-->
                        <!--                        <li><a href="javascript:;">--><? //= Yii::t('app', 'Help') ?><!--</a></li>-->
                        <?php
                        if (Yii::$app->user->can('admin')) { ?>
                            <li><a href="<?= Url::to(['/admin/site/logout']) ?>" data-method="POST"><i class="fa fa-sign-out pull-right"></i> <?= Yii::t('app', 'Log Out') ?> </a></li>
                        <?php } else if (Yii::$app->user->can('webmaster')) { ?>
                            <li><a href="<?= Url::to(['/webmaster/site/logout']) ?>" data-method="POST"><i class="fa fa-sign-out pull-right"></i> <?= Yii::t('app', 'Log Out') ?> </a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php /*
                <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"
                       aria-expanded="false">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge bg-green">6</span>
                    </a>
                    <!--list menu pesan -->
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                        <li>
                            <a>
                                <span class="image"><img src="<?= Yii::$app->params['avatarUrl'] . '/default.jpg' ?>" alt="Profile Image"/></span>
                                <span>
                                  <span>Admin</span>
                                  <span class="time">3 mins ago</span>
                                </span>
                                <span class="message">
                                  Film festivals used to be do-or-die moments for movie makers. They were where...
                                </span>
                            </a>
                        </li>
                        <li>
                            <div class="text-center">
                                <a>
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
 */ ?>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->
