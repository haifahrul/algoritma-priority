<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use  app\modules\webmaster\models\Route;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model hscstudio\mimin\models\AuthItem */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nav-tabs-custom">

    <ul class="nav nav-tabs">
      <li class="active"><a href="">Kelola Role <?= $model->name ?></a></li>
      
    </ul> 

    <p>
        <?= Html::a('Daftar', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Edit', ['update', 'id' => $model->name], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete', 'id' => $model->name], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading">Informasi</div>

      
      <?= DetailView::widget([
          'options'=>[
              "class"=>"table-list table table-condensed1 table-striped1 table-hover "
          ],
          'model' => $model,
          'attributes' => [
              'name',
              //'type',
              //'description:ntext',
              //'rule_name',
              //'data:ntext',
              [
                'attribute' => 'created_at',
                'format' => ['date','php:d M Y H:i:s'],
              ],
              [
                'attribute' => 'updated_at',
                'format' => ['date','php:d M Y H:i:s'],
              ],
          ],
      ]) ?>
      </div>
    </div>
    
    <div class="table-responsive grid-role">
        <p class="well">
          <label><input type="checkbox" id="checkAll"/> Check all</label>
          <label><input type="checkbox" id="inverse"/> Check inverse</label>
          <?php  echo Html::button('Simpan ', ['class' => 'btn btn-primary', 'title'=>'simpan perubhan ','id'=>'simpan']) ?>
          <?php  echo Html::button('Reset ', ['class' => 'btn btn-danger', 'title'=>'Reset ','id'=>'reset']) ?>

        </p>

    <?php
    //$types = Route::find()->where(['status' => 1])->groupBy(['type',  'name', 'alias', 'status' ])->all();
    $types = Route::find()->select('type')->where(['status' => 1])->distinct(['type'])->orderBy('type')->all();
    
    echo "<table class='table table-condensed table-striped table-hover'>";
    echo "<tr>";
      echo "<th>Type</th>";
      echo "<th>Permision</th>";
    echo "<tr>";
    $auth = Yii::$app->authManager;
    //echo "<tbody>";
    foreach ($types as $type) {
      echo "<tr>";
      echo "<td>".$type->type."</td>";
      echo "<td>";
      $aliass = Route::find()->where([
        'status' => 1,
        'type' => $type->type,
      ])->all();
      foreach ($aliass as $alias) {
          echo "<label style='display:block;width:100px;float:left;overflow:hidden;'>";
          //$permission = $auth->getPermission($alias->name);
          //$roleExist = $auth->getRole($model->name);
          $checked = false;
          if(Route::checkRolepermission($model->name, $alias->name) == 1)$checked = true;
         //if($permission) $checked = true;
          //if($auth->hasChild ( $alias->name, $model->name ))$checked = true;
          echo Html::checkbox($type->type.'_'.$alias->alias,$checked,[
              'title' => $alias->name,
              'class' => 'checkboxPermission',
          ]).' '.$alias->alias;
          echo "</label>";
      }
      echo "</td>";
      echo "</tr>";
    }
    //echo "</tbody>";
    echo "</table>";
    ?>

    </div>
</div>

<?php
$url =  \yii\helpers\Url::to(["generateall",'roleName'=>$model->name]);
$url2 =  \yii\helpers\Url::to(["selectrole"]);
$url3 =  \yii\helpers\Url::to(["selectreset",'roleName'=>$model->name]);
$this->registerJs('
  $(".checkboxPermission").bind("click", function(){
      setPermission($(this).attr("title"));
  });

  function setPermission(permissionName){
    $.post( "'.Url::to(['permission','roleName'=>$model->name]).'&permissionName="+permissionName, function( data ) {
        console.log(data.data)
        // alert("You have  success modify role : '.$model->name.' "+ data.data)
        toastr.success("You have  success modify role : '.$model->name.' "+ data.data)
    });
  }

 ');

$js = <<<JS
var cek=[];
 $("#checkAll").change(function () {
    cek=[];
    $("input:checkbox.checkboxPermission").prop('checked', $(this).prop("checked"));
    var roleName =  '$model->name';
      if ($(this).is(':checked')){
          //$.get('$url', function( data ) { console.log(data.data)});
        $(".checkboxPermission").each(function() {
          cek.push($(this).attr("title"));
        });
    }
});

$('#inverse').change(function (){
    var i = 0 ;
     cek=[];
     console.log(cek.length);
      $(".checkboxPermission").each(function() {
        if ($(this).is(':checked')) {
          $(this).attr('checked', false);
        }else{
          cek.push($(this).attr("title"));
          $(this).prop('checked', true);
        }

     });
    console.log(cek.length);

});
  $('#simpan').click(function (){
    if(cek.length > 0){
      var roleName= '$model->name'
      $.ajax({
       url: '$url2', 
       type: "post",
       data: { cek, roleName },
       success: function(data) {
          cek=[];
          //alert("successfull");
          toastr.success('data berhasil ditambahkan')
       },
    });
    }  

  }); 

  $('#reset').click(function (){
     cek = [];
    $(".checkboxPermission").each(function() {
      $(this).prop('checked', false);
    });
     $.post('$url3', function( data ) {
      console.log(data.data)
    });
  }); 


JS;
    $this->registerJs($js);