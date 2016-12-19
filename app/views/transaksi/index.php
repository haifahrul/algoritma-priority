<?php
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TransaksiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('app', 'Transaksi');
$this->params['breadcrumbs'][] = $this->title;
$this->params['title'] = 'List' . $this->title;
?>
<div class="box">
    <div class="transaksi-index">
        <div class="box-header with-border">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <p>
            <div class="pull-right">
                <?= \app\widgets\PageSize::widget([
                    'id' => 'select_page'
                ]); ?>
            </div>
            <?= Html::a('<i class="glyphicon glyphicon-plus glyphicon-sm"></i> Create ', ['create'],
                ['data-pjax' => 0, 'class' => 'btn btn-primary btn-sm btn-tambah1']) ?>
            <?= Html::button('<span class="glyphicon glyphicon-remove glyphicon-sm"></span> Delete',
                ['data-pjax' => 0, 'class' => 'btn btn-danger btn-sm', 'title' => 'hapus', 'id' => 'btn-deletes']) ?>
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
//                        'id',
                        [
                            'attribute' => 'service_id',
                            'format' => 'raw',
                            'value' => function ($data) {
                                return $data['service']['kode_service'];
                            }
                        ],
                        [
                            'attribute' => 'sparepart_id',
                            'format' => 'raw',
                            'value' => function ($data) {
                                return $data['sparepart']['nama'];
                            }
                        ],
                        'nota',
                        [
                            'attribute' => 'total_pembayaran',
                            'format' => 'raw',
                            'value' => function ($data) {
                                $formatter = Yii::$app->formatter;
                                return $formatter->currencyCode . $formatter->asDecimal($data['total_pembayaran']);
                            }
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            //'header'=>'Pilihan',
                            'contentOptions' => ['style' => 'width:90px;', 'class' => 'text-center'],
                            'template' => '{view} {update} {delete}',
                            'header' => 'Options',
                            'buttons' => [
                            ],
                        ],
                    ],
                ]);
                ?>
                <?php Pjax::end() ?>
            </div>
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

