<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\administrator\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="nav-tabs-custom">

    <ul class="nav nav-tabs">
        <li class="active"><a href="<?= Url::to(['/webmaster/user/']) ?>">Kelola User</a></li>
        <li><a href="<?= Url::to(['/webmaster/role/']) ?>">Kelola Role</a></li>
        <li><a href="<?= Url::to(['/webmaster/route/', 'id' => Yii::$app->user->id]) ?>">Kelola Route</a></li>
    </ul>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>

    <div class="btn-group">
        <?= Html::a('Role Users', ['/webmaster/role'], ['class' => 'btn btn-primary']) ?>
        <?php Html::a('Users', ['/webmaster/user'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Routes', ['/webmaster/route'], ['class' => 'btn btn-primary']) ?>
    </div>
    <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'tableOptions' => ['class' => 'table table-striped table-bordered table-condensed table-hover'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'id',
                'username',
                //'auth_key',
                //'password_hash',
                //'password_reset_token',
                'email:email',
                [
                    'attribute' => 'roles',
                    'format' => 'raw',
                    'value' => function($data) {
                        $roles = [];
                        foreach ($data->roles as $role) {
                            $roles[] = $role->item_name;
                        }

                        return Html::a(implode(', ', $roles), ['view', 'id' => $data->id]);
                    }
                ],
                [
                    'attribute' => 'status',
                    'format' => 'raw',
                    'filter' => [10 => 'aktif', 0 => 'banned'],
                    'options' => [
                        'width' => '80px',
                    ],
                    'value' => function($data) {
                        if ($data->status == 10)
                            return "<span class='label label-primary'>" . 'Active' . "</span>"; else
                            return "<span class='label label-danger'>" . 'Banned' . "</span>";
                    }
                ],
                [
                    'attribute' => 'created_at',
                    'filter' => FALSE,
                    'format' => ['date', 'php:d M Y H:i:s'],
                    'options' => [
                        'width' => '150px',
                    ],
                ],
                // [
                //   'attribute' => 'updated_at',
                //   'format' => ['date','php:d M Y H:i:s'],
                //   'options' => [
                //     'width' => '120px',
                //   ],
                // ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Options',
                    'contentOptions' => ['style' => 'width:80px;', 'class' => "text-center"],
                    'template' => '{view} {delete} {update} {login-as-user}',
                    'buttons' => [
                        'delete' => function($url, $model) {
                            //$url =  Url::to(['flagdeletegroup', 'keys'=>$model['id'],'group'=>$model['id_groupmessage'] ]);
                            $icon = '<span class = "glyphicon glyphicon-trash"> </span>';

                            return Html::a($icon, $url, [
                                'data-pjax' => 0,
                                'data-method' => 'post',
                            ]);
                        },
                        'login-as-user' => function($url, $model) {
                            $icon = '<span class = "fa fa-key" title="Login as user"> </span>';

                            return Html::a($icon, $url, [
                                'data-pjax' => 0,
                                'data-method' => 'post',
                            ]);
                        }
                    ],
                ],
            ],
        ]); ?>

    </div>
</div>