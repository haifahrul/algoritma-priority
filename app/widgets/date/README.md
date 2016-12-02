
use app\widgets\date\DatePicker;
?>

//documentasi

<?= DatePicker::widget([
    'model' => $model,
    'attribute' => 'attrName',
    'language' => 'ru',
    'size' => 'lg',
    'readonly' => true,
    'placeholder' => 'Choose date',
    'clientOptions' => [
        'format' => 'L',
        'minDate' => '2015-08-10',
        'maxDate' => '2015-09-10',
    ],
    'clientEvents' => [
        'dp.show' => new \yii\web\JsExpression("function () { console.log('It works!'); }"),
    ],
]);?>

<?= $form->field($model, 'attrName')->widget(
    DatePicker::className(), [
        'addon' => false,
        'size' => 'sm',
        'clientOptions' => [
            'format' => 'L LT', //format date time
            //'format' => 'DD/MM/YYYY HH:mm'

            'stepping' => 30,
        ],
]);?>
```
**Without a model**

```
<?php
use nex\datepicker\DatePicker;
?>
<?= DatePicker::widget([
    'name' => 'datepickerTest',
    'value' => '09/13/2015',
    'clientOptions' => [
        'format' => 'L',
    ],
    'dropdownItems' => [
        ['label' => 'Yesterday', 'url' => '#', 'value' => \Yii::$app->formatter->asDate('-1 day')],
        ['label' => 'Tomorrow', 'url' => '#', 'value' => \Yii::$app->formatter->asDate('+1 day')],
        ['label' => 'Some value', 'url' => '#', 'value' => 'Special value'],
    ],
]);?>
```
untuk datepicker

    <?= $form->field($model, 'startime')->widget(
         DatePicker::className(), [
        //'addon' => true,
        //'size' => 'sm',
        'readonly'=>true,
        'clientOptions' => [
            //'format' => 'LT',
            'format' => 'DD/MM/YYYY',
        ],
    ]);?>
