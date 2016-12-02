<?php
namespace app\widgets\adminlte;

use yii\base\Widget;
use yii\helpers\Html;

class Infobox extends Widget
{
    /*<div class="info-box bg-red">
      <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Likes</span>
        <span class="info-box-number">41,410</span>
        <-- The progress section is optional -->
        <div class="progress">
          <div class="progress-bar" style="width: 70%"></div>
        </div>
        <span class="progress-description">
          70% Increase in 30 Days
        </span>
      </div><!-- /.info-box-content -->
    </div><!-- /.info-box -->
    */
    public $title = '';
    public $type = self::TYPE_AQUA;
    public $encode = true;
    public $icon = "";
    public $infoText = "";
    public $infoNumber = "";
    public $progress = "";
    public $progressDescription = "";
    public $tipeSolid = true;
    public $options = "";
    public $jsOptions = "";
    public $id = "";
    CONST TYPE_AQUA = 'bg-aqua';
    CONST TYPE_GREEN = 'bg-green';
    CONST TYPE_YELOW = 'bg-yellow';
    CONST TYPE_RED = 'bg-red';

    public function init()
    {
        parent::init();
        // ob_start();
    }

    public function run()
    {
        if ($this->encode) {
            $title = Html::encode($this->title);
            $infoText = Html::encode($this->infoText);
            $infoNumber = Html::encode($this->infoNumber);
            $progress = Html::encode($this->progress);
            $progressDescription = Html::encode($this->progressDescription);
        } else {
            $title = $this->title;
        }
        if ($this->tipeSolid) {
            $start = '<div class="info-box ' . $this->type . '" style="' . $this->options . '"id="' . $this->id . '" >';
            $start .= '<span class="info-box-icon"><i class="' . $this->icon . '"></i></span>';
        } else {
            $start = '<div class="info-box " style="' . $this->options . '"id="' . $this->id . '" >';
            $start .= '<span class="info-box-icon ' . $this->type . ' "><i class="' . $this->icon . '"></i></span>';
        }
        $start .= '<div class="info-box-content">';
        $start .= '<span class="info-box-text">' . $infoText . '</span>';
        $start .= '<span class="info-box-number">' . $infoNumber . '</span>';
        $start .= ' <div class="progress">';
        $start .= '<div class="progress-bar" style="width: ' . $progress . '%"></div></div>';
        $start .= '<span class="progress-description">' . $progressDescription . '</span>';
        $ender = '</span></div></div>';
        // $content = ob_get_clean();
        // return $start.$content.$ender;
        return $start . $ender;
    }
}