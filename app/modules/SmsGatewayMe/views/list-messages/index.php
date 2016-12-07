<?php
use yii\widgets\Pjax;
use yii\grid\GridView;
use app\widgets\PageSize;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('app', 'List Messages');
$this->params['breadcrumbs'][] = $this->title;
$this->params['title'] = 'List' . $this->title;
?>

<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="" data-pjax=0><?= $this->title ?></a></li>
    </ul>
    <div class="customer-index">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <p>
        <div class="pull-right">
            <?= PageSize::widget([
                'id' => 'select_page'
            ]); ?>
        </div>

        <div class="table-responsive">
            <?php Pjax::begin(['id' => 'gridView']) ?>
            <?= GridView::widget([
                'id' => 'gridView',
                'emptyText' => 'Data tidak ada',
                'filterSelector' => 'select[name="per-page"]',
                'showHeader' => true,
                'showOnEmpty' => true,
                'emptyCell' => '',
                'tableOptions' => ['class' => 'table table-striped table-bordered table-condensed table-hover'],
                'dataProvider' => $dataProvider,
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'header' => 'No',
                        'contentOptions' => ['class' => 'text-center'],
                    ],
                    'message',
                    [
                        'attribute' => 'Contact',
                        'value' => function ($data) {
                            return $data['contact']['number'];
                        }
                    ],
                    'status',
                ],
            ]);
            ?>
            <?php Pjax::end() ?>
        </div>
    </div>
</div>