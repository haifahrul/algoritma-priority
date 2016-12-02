<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\administrator\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Roles';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="nav-tabs-custom">

        <ul class="nav nav-tabs">
            <li><a href="<?= Url::to(['/webmaster/user/']) ?>">Kelola User</a></li>
            <li class="active"><a href="<?= Url::to(['/webmaster/role/']) ?>">Kelola Role</a></li>
            <li><a href="<?= Url::to(['/webmaster/route/', 'id' => Yii::$app->user->id]) ?>">Kelola Route</a></li>
        </ul>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <p>
        <div class="btn-group">
            <?php Html::a('Role Users', ['/webmaster/role'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Users', ['/webmaster/user'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Route', ['/webmaster/route'], ['class' => 'btn btn-primary']) ?>
        </div>
        <?= Html::a('Create Role', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'contentOptions' => ['class' => 'text-center', 'width' => 30],
                    ],
                    [
                        'attribute' => 'type',
                        'label' => '',
                        'filter' => false,
                        'contentOptions' => ['class' => 'text-center', 'width' => 80],
                        'format' => 'raw',
                        'value' => function ($data) {
                            $append = Html::a('<span class = "glyphicon glyphicon-collapse-down"> </span>', '#', ['key' => $data['name'],
                                'onclick' => '$(this).ekspan()'
                            ]);
                            return $append;
                        }
                    ],
                    'name',
                    /*
                    'type',
                    'description:ntext',
                    'rule_name',
                    'data:ntext',
                    // 'created_at',
                    // 'updated_at',
                    */
                    [
                        'contentOptions' => ['class' => 'text-center', 'width' => 90],
                        'class' => 'yii\grid\ActionColumn'
                    ],
                ],
            ]); ?>
        </div>
    </div>

<?php
$urldetail = \yii\helpers\Url::to(["/webmaster/role/detail"]);
$customScript = <<< SCRIPT
(function($) {

    $.fn.ekspan = function(){
       var key = $(this).attr('key')
        var a = $( this ); 
        $(this).children().toggleClass('glyphicon-collapse-down');
        $(this).children().toggleClass('glyphicon-collapse-up');
        var td = $(a).parent(); // get parent dari element td
        var tr = $(td).parent(); // get element tr
        var tdCount = $(tr).children().length; // get jumlah kolom pada tr
        var table = $(tr).parent(); // get element table
        var datakey; 
        datakey = tr.data('key');

        if($(table).find('.'+ datakey.toString()).length != 0){
            $(table).children("."+datakey.toString() ).remove();
         }
        else
        {
            var trDetail = document.createElement("tr"); // create element tr for detail
            $(trDetail).attr("class","trDetail "+ datakey ); // add class trDetail for element tr 
            $(trDetail).attr('id', 'tb-detail');
            var tdDetail = document.createElement("td"); // create element td for detail tr
            $(tdDetail).attr("colspan",tdCount); // add element coolspan at td
            // get content via ajax
            $.get("$urldetail?name="+key, function( data ) {
              var html =  $.parseJSON(data);
                $(tdDetail).html( html.result );

            }).fail(function() {
                alert( "error" );
            });
            $(trDetail).append(tdDetail); // add td to tr
            $(tr).after(trDetail);  // add tr to table
        };
                    
    }
})(jQuery);
SCRIPT;
$this->registerJs($customScript, \yii\web\View::POS_READY);

?>