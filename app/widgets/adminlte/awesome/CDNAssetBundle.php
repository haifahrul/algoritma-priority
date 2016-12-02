<?php

namespace app\widgets\adminlte\awesome;

class CDNAssetBundle extends AssetBundle
{
    public function init()
    {
        parent::init();

        \Yii::warning(sprintf('You are using an deprecated class `%s`.', __CLASS__));
    }
}