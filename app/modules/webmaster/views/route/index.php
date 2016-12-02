<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\administrator\models\RouteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Routes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nav-tabs-custom">

    <ul class="nav nav-tabs">
        <li><a href="<?= Url::to(['/webmaster/user/']) ?>">Kelola User</a></li>
        <li><a href="<?= Url::to(['/webmaster/role/']) ?>">Kelola Role</a></li>
        <li class="active"><a href="<?= Url::to(['/webmaster/route/', 'id' => Yii::$app->user->id]) ?>">Kelola Route</a></li>
    </ul>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
    <div class="btn-group">
        <?= Html::a('Role Users', ['/webmaster/role'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Users', ['/webmaster/user'], ['class' => 'btn btn-primary']) ?>
        <?php Html::a('Routes', ['/webmaster/route'], ['class' => 'btn btn-primary']) ?>
    </div>
    <div class="btn-group">
        <?= Html::a('Create Route', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Generate Route', ['generate'], ['class' => 'btn btn-success']) ?>
    </div>
    <?= Html::a('Delete Route', ['hapusitems'], ['class' => 'btn btn-danger ', 'id' => 'hapus', 'data-pjax' => 0]) ?>
    </p>

    <div class="table-responsive">
        <?php Pjax::begin(['id' => 'grid']) ?>
        <?= GridView::widget([
            'id' => 'gridView',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'tableOptions' => ['class' => 'table table-striped  table-hover table-condensed'],

            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                ['class' => 'yii\grid\CheckboxColumn',
                    'name' => 'select'
                ],
                'type',
                'alias',
                'name',
                [
                    'attribute' => 'status',
                    'filter' => [0 => 'off', 1 => 'on'],
                    'format' => 'raw',
                    'options' => [
                        'width' => '80px',
                    ],
                    'value' => function ($data) {
                        if ($data->status == 1)
                            return "<span class='label label-primary'>" . 'On' . "</span>";
                        else
                            return "<span class='label label-danger'>" . 'Off' . "</span>";
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions' => ['class' => 'text-center'],

                ],
            ],
        ]); ?>
        <?php Pjax::end() ?>
    </div>

</div>

<?php

$customScript = <<< SCRIPT
  $("#hapus").on("click", function(e) {
     if(confirm("Are you sure you want to delete this item ?")){
      e.preventDefault()
        var keys = $("#gridView").yiiGridView("getSelectedRows");
        var url = $(this).attr('href');
        $.ajax({
          type: "POST",
           url: url , 
           data: {keys},
           success: function(data) {
             $.pjax.reload({container:"#grid"});
           },
        });
    }
        return false;
});
SCRIPT;
$this->registerJs($customScript, \yii\web\View::POS_READY);
?>
