<?php



namespace app\widgets\nav;
use yii\web\AssetBundle;

class DropdownXAsset extends AssetBundle
{
    public $baseUrl = '@web';


   public function init() {
        $path = "app/widgets/nav/assets/";
  
        $this->css[] = $path.'css/dropdown-x.css';
        $this->js[] = $path.'js/dropdown-x.js';
    }
}