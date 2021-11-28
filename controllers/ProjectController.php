<?php


namespace app\controllers;

use app\models\Project;
use yii\base\Controller;

class ProjectController extends Controller
{
    public function actionIndex()
    {
        $model = Project::find()->all();

        return $this->render('index', [
            'model' => $model
        ]);
    }
}