<?php
namespace app\models;

use Yii;

/**
 * This is the model class for table "social_media".
 *
 * @property string $social_media
 * @property integer $id
 * @property string $username
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 */
class SocialMedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'social_media';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['social_media'], 'string'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['username'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'social_media' => 'Social Media',
            'id' => 'ID',
            'username' => 'Username',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
