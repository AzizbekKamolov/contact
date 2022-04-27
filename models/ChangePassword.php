<?php

namespace app\models;
use Yii;
use app\models\User;
use yii\base\Model;

class ChangePassword extends Model
{
    public $newPassword;
    public $retypePassword;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['newPassword'], 'string', 'min' => 6],
            [['retypePassword'], 'compare', 'compareAttribute' => 'newPassword'],
        ];
    }


    /**
     * Change password.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function change($id)
    {
        if ($this->validate()) {
            /* @var $user User */
//            $user = Yii::$app->user->identity;
            $user = User::find()->where(['id' => $id])->one();
            $user->setPassword($this->newPassword);
            $user->generateAuthKey();
            if ($user->save()) {
                return true;
            }
        }

        return false;
    }
}
