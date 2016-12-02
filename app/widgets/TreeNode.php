<?php

namespace app\widgets;

use Yii;
use yii\helpers\Html;
use yii\web\View;

/**
 *
 * 
 * @author zzaza
 * @since 1.0
 */
class TreeNode extends \yii\bootstrap\Widget
{
      
    //susunan treenya seperti di kartik tree manager

    public $root = 'Root';

    public $icon = 'user';

    public $iconRoot = 'tree-conifer';
    
    public $query;


    public function init()
    {
        TreenodeAsset::register($this->getView());
        $this->initTreeView();
    }

    protected function initTreeView()
    {   
        $icon1 = '<span class="glyphicon glyphicon-'.$this->icon.'"></span>';
        $iconRoot = '<span class="glyphicon glyphicon-'.$this->iconRoot.'"></span>';

        $dataArray = $this->query->asArray()->all();

        $nodeDepth = $currDepth = $counter = 0;

        echo Html::beginTag('div', ['class' => 'tree']);
                echo Html::beginTag('ul') . "\n" .Html::beginTag('li') . "\n" ;
                echo '<a href="#">'.$iconRoot.'  '.$this->root.'</a>' . "\n" ;

        foreach ($dataArray as $key) {
            if ($key['lvl'] == 0 && $currDepth == 0) 
            {
                echo Html::beginTag('ul') . "\n" .Html::beginTag('li') . "\n" ;
                echo '<a href="#">'.$icon1.'  '.$key['nama_bagian'].'</a>' . "\n" ;
            }  else
            {
                $as = $currDepth-1;
                $sa = ${'x'.$as}+1;
                if ($key['lvl'] == ${'x'.$as}) {
                    echo Html::beginTag('li') . "\n";
                    echo '<a href="#">'.$icon1.'  '.$key['nama_bagian'].'</a>' . "\n" ;
                    echo  Html::endTag('/li') . "\n";
                } else if ($key['lvl'] == $sa){
                    echo Html::beginTag('ul') . "\n" .Html::beginTag('li') . "\n" ;
                    echo '<a href="#">'.$icon1.'  '.$key['nama_bagian'].'</a>' . "\n" ;
                } else
                {
                    $da = ${'x'.$as}-1;
                    if ($key['lvl'] == $da) {
                        echo Html::endTag('li') . "\n" ;
                        echo Html::endTag('ul') . "\n" ;
                        echo Html::beginTag('li') . "\n" ;
                        echo '<a href="#">'.$icon1.'  '.$key['nama_bagian'].'</a>' . "\n" ;
                    }else
                    {
                        $hasil = ${'x'.$as} - $key['lvl'];
                        for ($i=0; $i < $hasil ; $i++) { 
                            echo Html::endTag('li') . "\n" ;
                            echo Html::endTag('ul') . "\n" ;
                        }
                        echo Html::beginTag('li') . "\n" ;
                        echo '<a href="#">'.$icon1.'  '.$key['nama_bagian'].'</a>' . "\n" ;
                    }
                }
            }      

            ${'x'.$currDepth} = $key['lvl'];    
            ++$currDepth;
            ++$nodeDepth;
        }

        echo Html::endTag('div');
    }
}