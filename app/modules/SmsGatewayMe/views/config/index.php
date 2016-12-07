<?php
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\SmsGatewayMe\models\SmsGatewayMeConfigSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('app', 'Sms Gateway Me Configs');
$this->params['breadcrumbs'][] = $this->title;
$this->params['title'] = 'List' . $this->title;
?>

<div class="nav-tabs-custom">
    <div class="sms-gateway-me-config-index">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <p>
            <!--        --><?php //echo Html::a('<i class="glyphicon glyphicon-plus glyphicon-sm"></i> Create ', ['create'],
            //            ['data-pjax' => 0, 'class' => 'btn btn-primary btn-tambah1']) ?>
            <!--        </p>-->
        <div class="clearfix"></div>
        <div class="table-responsive">
            <?php Pjax::begin(['id' => 'grid']) ?>
            <?= GridView::widget([
                'id' => 'gridView',
                'emptyText' => 'Data tidak ada',
                //'summary'=>'',
                //'showFooter'=>true,
                //'filterPosition'=>'', // bisa header, footer or body
                'filterSelector' => 'select[name="per-page"]',
                'showHeader' => true,
                'showOnEmpty' => true,
                'emptyCell' => '',
                'tableOptions' => ['class' => 'table table-striped table-bordered table-condensed table-hover'],
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'header' => 'No',
                        'contentOptions' => ['style' => 'width:20px;', 'class' => 'text-center'],
                    ],
                    'code',
                    'key',
                    'value:ntext',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions' => ['style' => 'width:90px;', 'class' => 'text-center'],
                        'template' => '{update}',
                        'header' => 'Options',
                        'buttons' => [
                            'update' => function ($url, $model) {
                                $icon = '<i class = "fa fa-pencil"></i>';

                                return Html::a($icon, $url, [
                                    'id' => 'btn-update-row',
                                    'data-pjax' => 0,
                                    'class' => 'btn btn-default btn-xs',
                                    'title' => Yii::t('app', 'Update')
                                ]);
                            },
                        ],
                    ],
                ],
            ]);
            ?>
            <?php Pjax::end() ?>
        </div>
    </div>
</div>

<?php
$js = <<< JS
    $(document).on('click', '#btn-update-row',function(e){
        var url = $(this).attr("href");
        $("#modalform").modal("show").find("#modalContent").load( url);
        $('.modal-title').text("judul modal");
        e.preventDefault();
    });
;
JS;

$this->registerJs($js);
?>

<?php
Modal::begin([
    //'size'=> 'modal-lg',
    'id' => 'modalform',
    'options' => ['class' => 'modal fade'],
    'header' => '<h4 class="text-center modal-title">Create</h4>'
]);
echo '<div id="modalContent"></div>';
Modal::end();
?>

