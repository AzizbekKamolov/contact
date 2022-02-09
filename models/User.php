<?php

namespace app\models;
use mdm\admin\models\Assignment;
use mdm\admin\models\User as UserModel;
use yii\helpers\ArrayHelper;

class User extends UserModel
{
    public static function getMyRole()
    {
        $row = (new \yii\db\Query())
            ->from('auth_assignment')
            ->where(['user_id' => \Yii::$app->user->getId()])
            ->one();
        if($row){
            return $row['item_name'];
        }
        else {
            return 'guest';
        }
    }

    public static function getUsers()
    {
        return ArrayHelper::map(User::find()->all(), 'id', 'fullname');
    }

    public static function getUserById($id)
    {
        return User::find()->where(['id' => $id])->one();
    }
}
