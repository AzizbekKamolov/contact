<?php
namespace app\components;

use mdm\admin\components\Helper;

class View extends \yii\web\View
{
    public function testA()
    {
        return \Yii::$app->user->id;
    }

    public function checkRoute($route)
    {
        return Helper::checkRoute($route);
    }
}