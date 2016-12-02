<?php
namespace app\models;

use yii\base\Model;
use Yii;

/**
 * Account form
 */
class AccountForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_confirm;

    private $user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'unique',
             'targetClass'=>'\app\models\User',
             'message' => Yii::t('app', 'This username has already been taken.'),
             'filter' => function ($query) {
                 $query->andWhere(['not', ['id' => Yii::$app->user->getId()]]);
             }
            ],
            ['username', 'unique',
                'targetClass'=>'\app\models\MasterCustomer',
                'message' => Yii::t('app', 'This username has already been taken.'),
                'filter' => function ($query) {
                    $query->andWhere(['not', ['id' => Yii::$app->user->getId()]]);
                }
            ],
            [['username','password'], 'string', 'min' => 5, 'max' => 255],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'email'],
            ['email', 'unique',
             'targetClass'=>'\app\models\User',
             'message' => Yii::t('app', 'This email has already been taken.'),
             'filter' => function ($query) {
                 $query->andWhere(['not', ['id' => Yii::$app->user->getId()]]);
             }
            ],
            ['email', 'unique',
                'targetClass'=>'\app\models\MasterCustomer',
                'message' => Yii::t('app', 'This email has already been taken.'),
                'filter' => function ($query) {
                    $query->andWhere(['not', ['id' => Yii::$app->user->getId()]]);
                }
            ],
            [['username','email'], 'required'],
            ['password', 'string'],
            [['password'], 'compare', 'compareAttribute' => 'password_confirm',
                'message' => Yii::t('app', 'Please confirm the password below')],
            [['password_confirm'], 'compare', 'compareAttribute' => 'password'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username'=>Yii::t('app', 'Username'),
            'email'=>Yii::t('app', 'Email'),
            'password'=>Yii::t('app', 'Password'),
            'password_confirm'=>Yii::t('app', 'Confirm Password')
        ];
    }

    public function save()
    {
        $user = User::findOne(Yii::$app->user->id);
        $user->username = $this->username;
        $user->email = $this->email;
        if ($this->password) {
            $user->setPassword($this->password);
        }
        return $user->update();
    }

    public function setUser($user)
    {
        $this->user = $user;
        $this->email = $user->email;
        $this->username = $user->username;
    }
}
