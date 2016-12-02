<?php

namespace app\modules\webmaster\models;

use Yii;

/**
 * This is the model class for table "route".
 *
 * @property string $name
 * @property string $alias
 * @property string $type
 */
class Route extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'route';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'alias'], 'required'],
            [['name', 'alias', 'type'], 'string', 'max' => 64],
            [['status'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'alias' => 'Alias',
            'type' => 'Type',
            'status' => 'Status',
        ];
    }

    public static function checkRolepermission($roleName, $permission){
        return \Yii::$app->db
        ->createCommand("SELECT 1 FROM auth_item_child WHERE parent =:roleName and child = :permission ")
        ->bindValue(':roleName',$roleName)
        ->bindValue(':permission', $permission)
        ->queryScalar(); 
    } 
}
