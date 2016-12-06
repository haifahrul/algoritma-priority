<?php
use dzas\admin\components\Admins;
use themes\adminlte\components\Nav;
use yii\web\View;
use app\modules\webmaster\components\Mimin;

//use yii\helpers\Html;
if (Yii::$app->user->isGuest) {
    $user = "guest";
} else {
    $url_profil = \yii\helpers\Url::to(['/personal/index']);
    $user = '<a href = "' . $url_profil . '">' . Yii::$app->user->identity->username . '</a>';
}
/* @var $this View */
?>

<?php
$items = [];
/*if(isset($this->params['menuCallback'])){
    $callback = $this->params['menuCallback'];
}elseif (class_exists('mdm\admin\components\MenuHelper')) {
    $callback = ['mdm\admin\components\MenuHelper','getAssignedMenu'];
}*/
if (isset($callback) && is_callable($callback)) {
    $items = call_user_func($callback, Yii::$app->user->id);
} else {
    $items = Yii::$app->menus->getMenuAdmin();
}

$menuItems = Mimin::filterRouteMenu($items);
?>
<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $avatar ?>" class="user-circle" alt="User Image">

            </div>
            <div class="pull-left info">

                <p><?php echo $user; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <!--        <form action="-->
        <?php //echo \yii\helpers\Url::to(['/site/search']); ?><!--" method="get" class="sidebar-form">-->
        <!--            <div class="input-group">-->
        <!--                <input type="text" name="keyword" class="form-control" id="search-txt" autocomplete="off"-->
        <!--                       placeholder="Search...">-->
        <!--              <span class="input-group-btn">-->
        <!--                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i-->
        <!--                        class="fa fa-search"></i></button>-->
        <!--              </span>-->
        <!--            </div>-->
        <!--        </form>-->
        <!-- /.search form -->

        <?php
        //$items = Admins::filterRouteMenu($items);
        echo Nav::widget([
            'options' => [
                'class' => 'sidebar-menu',
            ],
            'encodeLabels' => false,
            'items' => $menuItems
        ]);
        ?>
    </section>
</aside>
