<?php


namespace app\models;
use mdm\admin\components\UserStatus;
use mdm\admin\models\form\Signup as SignupForm;
use Yii;
use yii\helpers\ArrayHelper;

class Signup extends SignupForm
{
    public $fullname;
    public $username;
    public $email;
    public $password;
    public $retypePassword;

    public function rules()
    {
        $class = \Yii::$app->getUser()->identityClass ? : 'mdm\admin\models\User';
        return [
            ['fullname', 'filter', 'filter' => 'trim'],
            ['fullname', 'required'],
            ['fullname', 'unique', 'targetClass' => $class, 'message' => 'This fullname has already been taken.'],
            ['fullname', 'string', 'min' => 2, 'max' => 255],

            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => $class, 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => $class, 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['retypePassword', 'required'],
            ['retypePassword', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    public function signup()
    {
        if ($this->validate()) {
            $class = \Yii::$app->getUser()->identityClass ? : 'mdm\admin\models\User';
            $user = new $class();
            $user->username = $this->username;
            $user->fullname = $this->fullname;
            $user->email = $this->email;
            $user->status = ArrayHelper::getValue(Yii::$app->params, 'user.defaultStatus', UserStatus::ACTIVE);
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
}