<?php
/**
 * Created by PhpStorm.
 * User: AlFatih
 * Date: 24/06/2016
 * Time: 17:40
 */

namespace app\behaviors;

use yii\base\Behavior;
use yii\web\User;


class LoginTimestampBehavior extends Behavior
{
    /**
     * @var string
     */
    public $attribute = 'logged_at';


    /**
     * @inheritdoc
     */
    public function events()
    {
        return [
            User::EVENT_AFTER_LOGIN => 'afterLogin'
        ];
    }

    /**
     * @param $event \yii\web\UserEvent
     */
    public function afterLogin($event)
    {
        $user = $event->identity;
        $user->touch($this->attribute);
        $user->save(false);
    }
}

/*
how to setting config web
    'user' => [
        'class'=>'yii\web\User',
        'identityClass' => 'app\models\User',
        'loginUrl'=>['/site/signin'],
        'enableAutoLogin' => true,
        'as afterLogin' => 'common\behaviors\LoginTimestampBehavior'
    ]

*/
