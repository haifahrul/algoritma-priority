<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SocialMediaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Social Media';
$this->params['breadcrumbs'][] = $this->title;
$this->params['title'] = 'List' . $this->title;
?>
<div class="nav-tabs-custom">

    <ul class="nav nav-tabs">
        <li class="active"><a href="" data-pjax=0><?= $this->title ?></a></li>
    </ul>

    <div class="social-media-index">

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p>
        <div class="pull-right">
            <?= \app\widgets\PageSize::widget([
                'id' => 'select_page'
            ]); ?>

        </div>
        <?= Html::a('<i class="glyphicon glyphicon-plus glyphicon-sm"></i> Tambah ', ['baru'], ['data-pjax' => 0, 'class' => 'btn btn-primary  btn-tambah1']) ?>
        <?= Html::button('<span class="glyphicon glyphicon-remove glyphicon-sm"></span> Hapus', ['data-pjax' => 0, 'class' => 'btn btn-danger', 'title' => 'hapus', 'id' => 'btn-deletes']) ?>

        </p>
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
                    ['class' => 'yii\grid\CheckboxColumn',
                        'name' => 'select'
                    ],
                    ['class' => 'yii\grid\SerialColumn',
                        'header' => 'No',
                        'contentOptions' => ['class' => 'text-center'],
                    ],
                    'social_media',
                    'id',
                    'username',
                    'user_id',
                    'created_at',
                    // 'updated_at',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        //'header'=>'Pilihan',
                        'contentOptions' => ['style' => 'width:90px;', 'class' => 'text-center'],
                        'template' => '{view} {update} {delete}',
                        'header' => 'Options',
                        'buttons' => [
                            //'delete'=>function($url,$model){
                            //   $icon = '<span class = "glyphicon glyphicon-trash"> </span>';
                            //   return Html::a($icon, $url , [
                            //           'data-confirm' => 'are you sure you want to delete this item ?',
                            //           'data-method'=> 'post', 
                            //           'class' => 'delete_id' 
                            //       ]); 
                            //}, 
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
$url = Url::to(['hapusitems']);
$js = <<<JS
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

<?php
// Modal::begin([
//   //'size'=> 'modal-lg',
//   'id' => 'modalform',
//   'options'=>['class'=> 'modal fade'],
//   'header' => '<h4 class="text-center modal-title">Create</h4>',]);
//echo '<div id="modalContent"></div>';
//Modal::end();
?>

