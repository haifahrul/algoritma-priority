<?php

use yii\helpers\Html;
use app\assets\MaterialAsset;

/**
 * @var $this \yii\base\View
 * @var $content string
 */
//$this->registerAssetBundle('MaterialAsset');
MaterialAsset::register($this);
?>
<?php $this->beginPage(); ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

        <title><?php echo Html::encode($this->title); ?></title>
        <?php $this->head(); ?>

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <div class="container">
        <div class="section">
            <?php echo $content; ?>
        </div>
    </div>

    <!--  Scripts-->
<!--    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>-->

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage(); ?>