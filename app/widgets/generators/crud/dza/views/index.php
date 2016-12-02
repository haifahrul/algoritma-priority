<?php
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var Generator by created Zaza zayinul h */
$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();
echo "<?php\n";
?>
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use <?= $generator->indexWidgetType === 'grid' ? "yii\\grid\\GridView" : "yii\\widgets\\ListView" ?>;
/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = <?php echo $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>;
$this->params['breadcrumbs'][] = $this->title;
$this->params['title'] = 'List'.$this->title;
?>
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="" data-pjax=0><?= "<?= " ?>$this->title ?></a></li>
    </ul>
    <div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-index">
        <?php if (!empty($generator->searchModelClass)): ?>
            <?= "    <?php " . ($generator->indexWidgetType === 'grid' ? "// " : "") ?>echo $this->render('_search', ['model' => $searchModel]); ?>
        <?php endif; ?>
        <p>
        <div class="pull-right">
            <?= "<?= " ?> \app\widgets\PageSize::widget([
            'id'=>'select_page'
            ]); ?>
        </div>
        <?= "<?= " ?>Html::a('<i class="glyphicon glyphicon-plus glyphicon-sm"></i> Create ' , ['create'],
        ['data-pjax'=>0,'class' => 'btn btn-primary btn-tambah1']) ?>
        <?= "<?= " ?>Html::button('<span class="glyphicon glyphicon-remove glyphicon-sm"></span> Delete',
        ['data-pjax'=>0, 'class' => 'btn btn-danger', 'title'=>'hapus','id'=>'btn-deletes']) ?>
        </p>
        <div class="clearfix"></div>
        <div class="table-responsive">
            <?= "<?php " ?> Pjax::begin(['id' => 'grid' ]) ?>
            <?php if ($generator->indexWidgetType === 'grid'): ?>
                <?= "<?= " ?>GridView::widget([
                'id'=>'gridView',
                'emptyText'=>'Data tidak ada',
                //'summary'=>'',
                //'showFooter'=>true,
                //'filterPosition'=>'', // bisa header, footer or body
                'filterSelector' => 'select[name="per-page"]',
                'showHeader' => true,
                'showOnEmpty'=>true,
                'emptyCell'=>'',
                'tableOptions' =>['class' => 'table table-striped table-bordered table-condensed table-hover'],
                'dataProvider' => $dataProvider,
                <?= !empty($generator->searchModelClass) ? "'filterModel' => \$searchModel,\n        'columns' => [\n" : "'columns' => [\n"; ?>
                ['class' => 'yii\grid\CheckboxColumn',
                'name'=>'select'
                ],
                ['class' => 'yii\grid\SerialColumn',
                'header'=>'No',
                'contentOptions' =>['class' =>'text-center' ],
                ],
                <?php
                $count = 0;
                if (($tableSchema = $generator->getTableSchema()) === FALSE) {
                    foreach ($generator->getColumnNames() as $name) {
                        if (++$count < 6) {
                            echo "            '" . $name . "',\n";
                        } else {
                            echo "            // '" . $name . "',\n";
                        }
                    }
                } else {
                    foreach ($tableSchema->columns as $column) {
                        $format = $generator->generateColumnFormat($column);
                        if (++$count < 6) {
                            echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                        } else {
                            echo "            // '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                        }
                    }
                }
                ?>
                [
                'class' => 'yii\grid\ActionColumn',
                //'header'=>'Pilihan',
                'contentOptions' => ['style' => 'width:90px;','class'=> 'text-center'],
                'template'=>'{view} {update} {delete}',
                'header'=>'Options',
                'buttons' => [
                ],
                ],
                ],
                ]);
                ?>
            <?php else: ?>
                <?= "<?= " ?>ListView::widget([
                'dataProvider' => $dataProvider,
                'itemOptions' => ['class' => 'item'],
                'itemView' => function ($model, $key, $index, $widget) {
                return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
                },
                ]) ?>
            <?php endif; ?>
            <?= "<?php " ?> Pjax::end() ?>
        </div>
    </div>
</div>
<?= "<?php " ?>
$url=Url::to(['delete-items']);
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
<?= "<?php " ?>
// Modal::begin([
//   //'size'=> 'modal-lg',
//   'id' => 'modalform',
//   'options'=>['class'=> 'modal fade'],
//   'header' => '<h4 class="text-center modal-title">Create</h4>',]);
// echo '<div id="modalContent"></div>';
// Modal::end();
?>

