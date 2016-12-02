<?php
namespace app\widgets\adminlte;

// required adminlte css
use yii\base\Widget;
use yii\helpers\Html;

class Smallbox extends Widget
{
    public $title = '';
    public $konten = "";
    public $type = self::AQUA;
    public $encode = true;
    public $icon = "";
    public $footerIcon = "";
    public $footer;
    public $id = "";
    public $link = "";
    public $options = "";
    public $jsOptions = "";
    CONST AQUA = 'bg-aqua';
    CONST GREEN = 'bg-green';
    CONST YELLOW = 'bg-yellow';
    CONST RED = 'bg-red';

    public function init()
    {
        parent::init();
        // ob_start();
    }

    public function run()
    {
        if ($this->encode) {
            $title = Html::encode($this->title);
            $footer = Html::encode($this->footer);
        } else {
            $title = $this->title;
            $footer = $this->footer;
        }
        $start = '<div class="small-box ' . $this->type . '" style="' . $this->options . '"id="' . $this->id . '" >';
        $start .= '<div class="inner">';
        $start .= '<h3>' . $title . '</h3>';
        $start .= '<p>' . $this->konten . '</p>';
        $start .= '</div>';
        $start .= '<div class="icon"><i class="' . $this->icon . '"></i></div>';
        $start .= '<a class = "small-box-footer" href="' . $this->link . '">' . $footer . '  <i class="' . $this->footerIcon . '"></i></a>';
        $ender = '</div>';
        // $content = ob_get_clean();
        // return $start.$content.$ender;
        return $start . $ender;
    }
}