<?php
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\webmaster\models\search\ConfigSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('app', 'Configs');
$this->params['breadcrumbs'][] = $this->title;
$this->params['title'] = 'List' . $this->title;
?>
<div class="box">
    <div class="box-header with-border">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <p>
        <div class="pull-right">
            <?= \app\widgets\PageSize::widget([
                'id' => 'select_page'
            ]); ?>
        </div>
                <?php echo Html::a('<i class="glyphicon glyphicon-plus glyphicon-sm"></i> Create ', ['create'],
                    ['data-pjax' => 0, 'class' => 'btn btn-primary btn-sm btn-tambah1']) ?>
<!--        --><?php //echo Html::button('<span class="glyphicon glyphicon-remove glyphicon-sm"></span> Delete',
//            ['data-pjax' => 0, 'class' => 'btn btn-danger btn-sm', 'title' => 'hapus', 'id' => 'btn-deletes']) ?>
        </p>
    </div>
    <div class="box-body">
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
                    ['class' => 'yii\grid\CheckboxColumn',
                        'name' => 'select'
                    ],
                    ['class' => 'yii\grid\SerialColumn',
                        'header' => 'No',
                        'contentOptions' => ['class' => 'text-center'],
                    ],
//                    'id',
                    'code',
                    'key',
                    'value:ntext',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        //'header'=>'Pilihan',
                        'contentOptions' => ['style' => 'width:90px;', 'class' => 'text-center'],
                        'template' => '{view} {update}',
                        'header' => 'Options',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                $icon = '<i class = "glyphicon glyphicon-zoom-in"></i>';

                                return Html::a($icon, $url, [
                                    'data-pjax' => 0,
                                    'class' => 'btn btn-default btn-xs btn-view',
                                    'title' => Yii::t('app', 'View')
                                ]);
                            },
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
<?php $url = Url::to(['delete-items']);
$js = <<< JS
$(document).on("click","#btn-deletes", function() {
if(confirm("Apakah Anda yakin ingin menghapus item ini ?")){
var keys = $("#gridView").yiiGridView("getSelectedRows");
$.ajax({
type: "post",
url: '$url',
data: {keys},
success: function(data) {
$.pjax.reload({container:"#grid"});
},
});
return false;
};
});
$(document).on('click', '.btn-tambah',function(e){
var url = $(this).attr("href");
$("#modalform").modal("show")
.find("#modalContent")
.load( url);
$('.modal-title').text("judul modal ");
e.preventDefault();
});
;
JS;
$this->registerJs($js);
?>
<?php // Modal::begin([
//   //'size'=> 'modal-lg',
//   'id' => 'modalform',
//   'options'=>['class'=> 'modal fade'],
//   'header' => '<h4 class="text-center modal-title">Create</h4>',]);
// echo '<div id="modalContent"></div>';
// Modal::end();
?>

