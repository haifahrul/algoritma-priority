<?php
namespace app\widgets\adminlte;
// required adminlte css
//animatison
use yii\base\Widget;
use yii\helpers\Html;

class Box extends Widget
{

  public $title = '';
  public $tooltip_m="";
  public $tooltip_c="";
  public $type  = self::TDEFAULT;
  public $encode= true;
  public $footer;
  public $titlesmall= false;
  public $typeButton = "";
  public $idButton ="";
  public $defaultCollapsed = false;


  private $button="";
  private $typeBox;
 // button tool output
  public $id="";
  
  


  public $options="";
  public $jsOptions="";



  CONST INFO = 'box-info';
  CONST SUCCESS = 'box-success';
  CONST PRIMARY = 'box-primary';
  CONST TDEFAULT = 'box-default';
  CONST WARNING = 'box-warning';
  CONST DANGER = 'box-danger';
  


  public function init()
  {
    parent::init();

    ob_start();
  }

  public function run()
  {
    if($this->encode){
      $title = Html::encode($this->title);
      $footer = Html::encode($this->footer);

    }else{
      $title= $this->title;
      $footer = $this->footer;
    }

    $colapse = $this->defaultCollapsed?"collapsed-box":"";
    if( $this->defaultCollapsed ){
      $collapse ="collapsed-box";
      $diplay = "none";
      $this->typeButton = "collapse"; 
    }else{
      $collapse = " "; 
      $diplay = "block";

    } 
     switch($this->typeButton) {
       case "both";
          $this->button = '<button id ="'.$this->idButton.'" data-original-title="'.$this->tooltip_m.'" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title=""><i class="fa fa-minus"></i></button> <button data-original-title="'.$this->tooltip_c.'" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title=""><i class="fa fa-times"></i></button>';
        break;
      case "hapus":
          $this->button = '<button id ="'.$this->idButton.'" data-original-title="'.$this->tooltip_m.'" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title=""><i class="fa fa-minus"></i></button> ';
        break;
      case "collapse":
        $this->button = '<button id ="'.$this->idButton.'" data-original-title="'.$this->tooltip_c.'" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title=""><i class="fa fa-plus"></i></button>'; 
        break;
      default:
         $this->button = '<button id ="'.$this->idButton.'" data-original-title="'.$this->tooltip_c.'" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title=""><i class="fa fa-minus"></i></button>'; 
        break;

    }

    if($this->titlesmall)
      $boxtitle='<h5 class="box-title" style="font-size: 14px">'.$this->title.'</h5>';
    else
      $boxtitle='<h3 class="box-title">'.$this->title.'</h3>';


    $start = '<div class="box '.$this->type.' '.$colapse.'" style='.$this->options.' "id="'.$this->id.'" >';
    $start .= '<div class="box-header with-border">';
    $start .= $boxtitle ;

    $start .= '<div class="box-tools pull-right">';
    $start .= $this->button;
    $start .= '</div></div>';
    $start .= '<div style="display: '.$diplay.'" class="box-body">';
 
    $ender = '</div>';
    if($this->footer != '' || !isset($this->footer))
    $ender .= '  <div style="display: block;" class="box-footer">'.$this->footer.'</div>';
    $ender .= '</div>';
    $content = ob_get_clean();
    return $start.$content.$ender;

    
  }
}

      