<?php
/**
 * Created by PhpStorm.
 * User: haifa
 * Date: 7/1/2016
 * Time: 23:27
 */
namespace app\components;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

class MyBehavior {
    public function behaviors() {
        return [
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => ['created_by', 'updated_by'],
                    BaseActiveRecord::EVENT_BEFORE_UPDATE => 'updated_by'
                ],
            ],
            //[
            //    'class' => TimestampBehavior::className(),
            //    'attributes' => [
            //        ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
            //        ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
            //    ],
            //    // if you're using datetime instead of UNIX timestamp:
            //    // 'value' => new Expression('NOW()'),
            //],
        ];
    }


}