<?php
/**
 * Created by PhpStorm.
 * User: AlFatih
 * Date: 25/06/2016
 * Time: 22:27
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<?php if (!empty($results)): ?>
    <table class="table table-stripped"></table>
    <?php
    foreach ($results as $item):
        //print_r($item->query)
        //print_r($item->status)
        //print_r($item->origin_details)
        //print_r($item->results)
        ?>
        <?php
        $no = 0;
        foreach ($item->result[0]->costs as $cost)
            ?>
            <tr>
            <th>Service</th>
            <th><?php $cost->service ?></th>
        </tr>
        <tr>
            <th>Deskripsi</th>
            <th><?php $cost->description ?></th>
        </tr>
        <tr>
            <th>Biaya</th>
            <th><?php $cost->cost[$no]->value ?></th>
        </tr>
        <tr>
            <th>Etd</th>
            <th><?php $cost->cost[$no]->etd ?></th>
        </tr>


    <?php endforeach; ?>

    <?php endforeach; ?>
<?php endif; ?>
?>
<div class="cek-ongkir">
    <?php $form = ActiveForm::begin([]) ?>
    <?= $form->field($model, 'origin')->textInput() ?>
    <?= $form->field($model, 'destination')->textInput() ?>
    <?= $form->field($model, 'weight')->textInput(['value' => 1000]) ?>
    <?= $form->field($model, 'courier')->dropDownList([
        'jne' => 'JNE',
        'pos' => 'POS',
        'tiki' => 'TIKI',
    ]) ?>
    <div class="form-group">
        <?= Html::submitButton('Cek Ongkir', [
            'class' => 'btn btn-primary'
        ]) ?>
    </div>
    <?php ActiveForm::end() ?>
</div>

