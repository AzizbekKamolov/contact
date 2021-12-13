<?php

namespace app\models;
use mdm\admin\models\Assignment;
use mdm\admin\models\User as UserModel;

class User extends UserModel
{
    public function getMyRole()
    {
        $row = (new \yii\db\Query())
            ->from('auth_assignment')
            ->where(['user_id'=>\Yii::$app->user->getId()])
            ->one();
        if($row){
            return $row['item_name'];
        }
        else {
            return 'guest';
        }
    }
}
