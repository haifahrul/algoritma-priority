<?php
namespace app\widgets\adminlte;

use yii\base\Widget;
use yii\helpers\Html;

class Panel extends Widget
{
    public $title = '';
    public $type = self::TYPE_DEFAULT;
    public $encode = true;
    public $idPanel = "";
    public $idHeading = "";
    public $options = "";
    public $jsOptions = "";
    CONST TYPE_DEFAULT = 'panel-default';
    CONST TYPE_SUCCESS = 'panel-success';
    CONST TYPE_WARNING = 'panel-warning';
    CONST TYPE_PRIMARY = 'panel-primary';
    CONST TYPE_DANGER = 'panel-danger';

    public function init()
    {
        parent::init();
        ob_start();
    }

    public function run()
    {
        if ($this->encode) {
            $title = Html::encode($this->title);
        } else {
            $title = $this->title;
        }
        $start = '<div class="panel ' . $this->type . '" style="' . $this->options . '"id="' . $this->idPanel . '" >';
        $start .= '<div class="panel-heading" id="' . $this->idHeading . '">' . $title . '</div>';
        $start .= '<div class="panel-content" style="margin:2%">';
        $ender = '</div></div>';
        $content = ob_get_clean();
        return $start . $content . $ender;
    }
}