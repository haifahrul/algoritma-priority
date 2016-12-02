How to Use Widgets
============================

Yii 2 Basic Project Template Widgets.

Contains list of widgets in `app/widgets`

##Table of Contents
- [Date and Time](#markdown-header-date-and-time)
    - [Date Picker](#markdown-header-date-picker)
    - [Date Range Picker](#markdown-header-date-range-picker)
    - [Date Time Picker](#markdown-header-date-time-picker)
- [Select2](#markdown-header-select2)
- [Highchart](#markdown-header-highchart)
- [File Input](#markdown-header-file-input)
- [Tabular Input](#markdown-header-tabular-input)
    - [Mdmsoft (Misbahul Munir)](#markdown-header-mdmsoft-misbahul-munir)
    - [Dynamic Form Widget](#markdown-header-dynamic-form-widget)
- [Editor](#markdown-header-editor)
    - [TinyMCE](#markdown-header-tinyMCE)
    - [CKEditor](#markdown-header-CKEditor)
- [Export Data](#markdown-header-Export-data)
    - [Export Excel](#markdown-header-export-excel)
        - [Export data only one worksheet](#markdown-header-export-data-only-one-worksheet)
        - [Export data with multiple worksheet](#markdown-header-export-data-with-multiple-worksheet)

##Date and Time
###Date Picker
```
use app\widgets\DatePicker;

<?= DatePicker::widget([
	'model' => $model,
	'attribute' => 'date',
	'template' => '{addon}{input}',
		'clientOptions' => [
			'autoclose' => true,
			'format' => 'dd-M-yyyy'
		]
]);
?>
```

```
<?php
// with an ActiveForm instance
?>

<?= $form->field($model, 'date')->widget(DatePicker::className(), [
		// inline too, not bad
 		'inline' => true,
 		// modify template for custom rendering
		'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
		'clientOptions' => [
			'autoclose' => true,
			'format' => 'dd-M-yyyy'
		]
]);
?>
```

**Example of use without a model**
```
use app\widgets\DatePicker;

<?= DatePicker::widget([
	'name' => 'Test',
	'value' => '02-16-2012',
	'template' => '{addon}{input}',
		'clientOptions' => [
			autoclose' => true,
			'format' => 'dd-M-yyyy'
		]
]);
?>
```

###Date Range Picker

This widget renders a Bootstrap DateRangePicker Input control.

**Example of use with a form**

The following example works with a model that has two attributes named `date_from` and `date_to`.

###Date Time Picker
```
use app\widgets\DateTimePicker;

<?= DateTimePicker::widget([
    'model' => $model,
    'attribute' => 'created_at',
    'language' => 'es',
    'size' => 'ms',
    'clientOptions' => [
        'autoclose' => true,
        'format' => 'dd MM yyyy - HH:ii P',
        'todayBtn' => true
    ]
]);
?>
```

##Select2
```
use app\widgets\Select2Widget;
use yii\helpers\ArrayHelper;

<?= $form->field($model, 'attribute')->widget(
    Select2Widget::className(),
    [
        'items'=>ArrayHelper::map(Catalog::find()->all(), 'id', 'name')
    ]
);
?>
```

**Ajax**
```
use app\widgets\Select2Action;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'ajax' => [
                'class' => Select2Action::className(),
                'dataCallback' => [$this, 'dataCallback'],
            ],
        ];
    }

    public function dataCallback($q)
    {
        $query = new ActiveQuery(Catalog::className());
        return [
            'results' =>  $query->select([
                    'catalog_id as id',
                    'catalog_name as text',
                ])
                ->filterWhere(['like', 'catalog_name', $q])
                ->asArray()
                ->limit(20)
                ->all(),
        ];
    }
}

// Form edit view:
$form->field($model, 'attribute')->widget(
    Select2Widget::className(),
    [
        'ajax' => ['site/ajax']
    ]
);
```

##Highchart
Example to use
```
use app\widgets\Highcharts;
use yii\web\JsExpression;

<?php
echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'Combination chart',
        ],
        'xAxis' => [
            'categories' => ['Apples', 'Oranges', 'Pears', 'Bananas', 'Plums'],
        ],
        'labels' => [
            'items' => [
                [
                    'html' => 'Total fruit consumption',
                    'style' => [
                        'left' => '50px',
                        'top' => '18px',
                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                    ],
                ],
            ],
        ],
        'series' => [
            [
                'type' => 'column',
                'name' => 'Jane',
               'data' => [3, 2, 1, 3, 4],
            ],
            [
                'type' => 'column',
              'name' => 'John',
                'data' => [2, 3, 5, 7, 6],
            ],
            [
                'type' => 'column',
               'name' => 'Joe',
                'data' => [4, 3, 3, 9, 0],
            ],
            [
                'type' => 'spline',
                'name' => 'Average',
                'data' => [3, 2.67, 3, 6.33, 3.33],
                'marker' => [
                    'lineWidth' => 2,
                    'lineColor' => new JsExpression('Highcharts.getOptions().colors[3]'),
                    'fillColor' => 'white',
                ],
            ],
            [
                'type' => 'pie',
                'name' => 'Total consumption',
                'data' => [
                   [
                        'name' => 'Jane',
                        'y' => 13,
                        'color' => new JsExpression('Highcharts.getOptions().colors[0]'), // Jane's color
                    ],
                    [
                        'name' => 'John',
                        'y' => 23,
                        'color' => new JsExpression('Highcharts.getOptions().colors[1]'), // John's color
                    ],
                    [
                       'name' => 'Joe',
                        'y' => 19,
                        'color' => new JsExpression('Highcharts.getOptions().colors[2]'), // Joe's color
                    ],
                ],
                'center' => [100, 80],
                'size' => 100,
                'showInLegend' => false,
                'dataLabels' => [
                    'enabled' => false,
                ],
            ],
        ],
    ]
);
?>
```

##File Input
Example to use
```
<?php
echo FileInput::widget([
    'model' => $model,
    'attribute' => 'nm_city', // image is the attribute
    // using STYLE_IMAGE allows me to display an image. Cool to display previously
    // uploaded images
    //'thumbnail' => $model->getAvatarImage(),
    'style' => FileInput::STYLE_IMAGE

]);?>
```

##Tabular Input
### mdmsoft [Misbahul Munir](https://mdmunir.wordpress.com/2016/03/20/yii2-tutorial-tabular-input/)

```
use \mdm\behavior\ar\RelationTrait;

class Order extends ActiveRecord {
    public function getItems() {
        return $this->hasMany(Item::className(),['order_id'=>'id']);
    }
    public function setItems($value) {
        $this->loadRelated('items', $value);
    }
}
```

**If appear error** `not found`, **you can use this class**
```
class Order extends ActiveRecord {
    public function getItems() {
        return $this->hasMany(Item::className(),['order_id'=>'id']);
    }
    public function behaviors() {
        return [
            [
                'class' => 'mdm\behaviors\ar\RelationBehavior',
                //'beforeRSave' => function($item){
                     //return $item->qty != 0;
                //}
            ],
        ];
    }
}
```

#####Config in your controller
```
$model = new Order();
if($model->load(Yii::$app->request->post()){
    $model->items = Yii::$app->request->post('Item',[]);
    $model->save();
}
```

#####Add this class
```
class Item extends ActiveRecord {
    public function getOrder() {
        return $this->hasOne(Order::className(),['id'=>'order_id']);
    }
}
```

#####In your view
```
use app/widgets/TabularInput;

<table>
<?= TabularInput::widget([
        'id' => 'detail-grid',
        'allModels' => $model->items,
        'modelClass' => OrderItem::className(),
        'options' => ['tag' => 'tbody'],
        'itemOptions' => ['tag' => 'tr'],
        'itemView' => '_item_detail',
        'clientOptions' => [
            'btnAddSelector' => '#btn-add',
        ]
    ]);
?>
</table>
```

###Dynamic Form Widget [wbraganca](https://github.com/wbraganca/yii2-dynamicform)

If `DynamicForm` from `app/widgets` folder error, you can use composer to install it on 3-th party folder (vendor).

Create class model
```
namespace app\components;

use Yii;
use yii\helpers\ArrayHelper;

class Model extends \yii\base\Model
{
    /**
     * Creates and populates a set of models.
     *
     * @param string $modelClass
     * @param array $multipleModels
     * @return array
     */
    public static function createMultiple($modelClass, $multipleModels = [])
    {
        $model    = new $modelClass;
        $formName = $model->formName();
        $post     = Yii::$app->request->post($formName);
        $models   = [];

        if (! empty($multipleModels)) {
            $keys = array_keys(ArrayHelper::map($multipleModels, 'id', 'id'));
            $multipleModels = array_combine($keys, $multipleModels);
        }

        if ($post && is_array($post)) {
            foreach ($post as $i => $item) {
                if (isset($item['id']) && !empty($item['id']) && isset($multipleModels[$item['id']])) {
                    $models[] = $multipleModels[$item['id']];
                } else {
                    $models[] = new $modelClass;
                }
            }
        }

        unset($model, $formName, $post);

        return $models;
    }
}
```

In controller
- actionCreate
```
$model = [new YourModel];

if ($model[0]->load(Yii::$app->request->post())) {
    $model = Model::createMultiple(YourModel::className());
    Model::loadMultiple($model, Yii::$app->request->post());

    // Ajax validation
    if (Yii::$app->request->isAjax) {
        Yii::$app->response->format = Response::FORMAT_JSON;

        return ArrayHelper::merge(ActiveForm::validateMultiple($model));
    }

    // Validate models
    $valid = Model::validateMultiple($model, ['attribute_1', attribute_1]);
    // $valid = Model::validateMultiple($model);

    if ($valid) {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            foreach ($model as $value) {
                $x = new YourModel();
                $x->attribute_1 = $value->attribute_1;
                $x->attribute_2 = $value->attribute_2;
                $x->save();
            }
            if ($x->save()) {
                $transaction->commit();
                Yii::$app->session->setFlash('success', ' Data telah disimpan!');

                return $this->redirect(['index']);
            }
        } catch (Exception $e) {
            $transaction->rollBack();
            Yii::$app->session->setFlash('danger', ' Data gagal disimpan!');
        }
    }
}
```

- actionUpdate
```
use yii\helpers\ArrayHelper;

$model = [$this->findModel($id)];

if ($model[0]->load(Yii::$app->request->post())) {
    $oldIDs = ArrayHelper::map($model, 'id', 'id');
    $model = Model::createMultiple(YourModel::classname(), $model);
    Model::loadMultiple($model, Yii::$app->request->post());
    $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($model, 'id', 'id')));
    $valid = Model::validateMultiple($model);
    if ($valid) {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            if (!empty($deletedIDs)) {
                YourModel::deleteAll(['id' => $deletedIDs]);
            }
            foreach ($model as $value) {
                $x = new YourModel();
                $x->attribute_1 = $value->attribute_1;
                $x->attribute_2 = $value->attribute_2;
                $x->save();
            }
            if ($x->save()) {
                $transaction->commit();
                Yii::$app->session->setFlash('success', ' Data telah disimpan!');

                return $this->redirect(['index']);
            }
        } catch (Exception $e) {
            $transaction->rollBack();
            Yii::$app->session->setFlash('danger', ' Data gagal disimpan!');
        }
    }
} else {
    if (Yii::$app->request->isAjax) {
        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    } else {
        return $this->render('update', [
            //'model' => $model,
            'model' => (empty($model)) ? [new Dosen] : $model
        ]);
    }
}
```

In view
```
//use app\widgets\DynamicFormWidget; // use namespace below if this namespace error
use wbraganca\dynamicform\DynamicFormWidget;

<?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
<?php DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_wrapper',
    'widgetBody' => '.container-items',
    'widgetItem' => '.input-item',
    //'limit' => 10,
    'min' => 1,
    'insertButton' => '.add-button',
    'deleteButton' => '.remove-button',
    'model' => $model[0],
    'formId' => 'dynamic-form',
    'formFields' => [
        'attribute_1',
        'attribute_2'
    ],
]); ?>

<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th><?= Yii::t('app', 'attribute_1') ?></th>
        <th><?= Yii::t('app', 'attribute_2') ?></th>
        <th></th>
    </tr>
    </thead>
    <tbody class="container-items">
    <?php foreach ($model as $i => $model): ?>
        <tr class="input-item">
            <td class="col-sm-4">
            <?php
                // necessary for update action.
                if (!$modelAddress->isNewRecord) {
                    echo Html::activeHiddenInput($model, "[{$i}]id");
                }
            ?>
            </td>
                <?= $form->field($model, "[{$i}]attribute_1")->textInput(['maxlength' => TRUE])->label(FALSE) ?>
            </td>
            <td class="col-sm-4">
                <?= $form->field($model, "[{$i}]attribute_2")->textInput(['maxlength' => TRUE])->label(FALSE) ?>
            </td>
            <td class="text-center vcenter">
                <button type="button" class="remove-button btn btn-danger btn-xs"><span class="fa fa-minus"></span></button>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="5" class="text-right">
            <?= Html::submitButton($val->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary btn-sm']) ?>
        </td>
        <td class="text-center">
            <button type="button" class="add-button btn btn-success btn-sm"><span class="fa fa-plus"> <?= Yii::t('app', 'Add') ?></span>
            </button>
        </td>
    </tr>
    </tfoot>
</table>

<?php DynamicFormWidget::end(); ?>
<?php ActiveForm::end(); ?>
```

##Editor
###TinyMce
```
<?= $form->field($model, 'message')->widget(TinyMce::className(), [
    'options' => ['rows' => 6],
    'language' => 'en_CA',
    'clientOptions' => [
        'plugins' => [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
        ],
        'toolbar1' => "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
        'toolbar2'=> "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
        'image_advtab'=> true ,
        'external_filemanager_path' => yii::getAlias('@web')."/filemanager/",
        "filemanager_title"=>"Responsive Filemanager" ,
        "external_plugins" => [
            "filemanager" => "http://localhost/webapp/dashboard_pnri/assets/5d405f35/plugins/responsivefilemanager/plugin.js"]
        ]
    ]);
?>
```
###CKEditor
```
<?= $form->field($model, 'message')->widget(CKEditor::className(), [
    'options' => [
    'rows' => 6,
    ],
    'clientOptions'=>[
        'filebrowserBrowseUrl' =>  yii::getAlias('@web/vendor').'/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
        'filebrowserUploadUrl' =>  yii::getAlias('@web/vendor').'/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
        'filebrowserImageBrowseUrl' =>  yii::getAlias('@web/vendor').'/filemanager/dialog.php?type=1&editor=ckeditor&fldr='

    ],
    'preset' => 'standard'
])
?>
```

##Export Data
Exporting data into an excel file.

###Export data only one worksheet
```
<?php
app\widgets\ExportExcel::widget([
    'models' => $allModels,
    'mode' => 'export', //default value as 'export'
    'columns' => ['column1','column2','column3'], //without header working, because the header will be get label from attribute label.
    'header' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3'],
]);

app\widgets\ExportExcel::export([
    'models' => $allModels,
    'columns' => ['column1','column2','column3'], //without header working, because the header will be get label from attribute label.
    'header' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3'],
]);
?>
```
###Export data with multiple worksheet
```
<?php
app\widgets\ExportExcel::widget([
    'isMultipleSheet' => true,
    'models' => [
        'sheet1' => $allModels1,
        'sheet2' => $allModels2,
        'sheet3' => $allModels3
    ],
    'mode' => 'export', //default value as 'export'
    'columns' => [
        'sheet1' => ['column1','column2','column3'],
        'sheet2' => ['column1','column2','column3'],
        'sheet3' => ['column1','column2','column3']
    ],
    //without header working, because the header will be get label from attribute label.
    'header' => [
        'sheet1' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3'],
        'sheet2' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3'],
        'sheet3' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3']
    ],
]);

app\widgets\ExportExcel::export([
    'isMultipleSheet' => true,
    'models' => [
        'sheet1' => $allModels1,
        'sheet2' => $allModels2,
        'sheet3' => $allModels3
    ], 'columns' => [
        'sheet1' => ['column1','column2','column3'],
        'sheet2' => ['column1','column2','column3'],
        'sheet3' => ['column1','column2','column3']
    ],
    //without header working, because the header will be get label from attribute label.
    'header' => [
        'sheet1' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3'],
        'sheet2' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3'],
        'sheet3' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3']
    ],
]);
```