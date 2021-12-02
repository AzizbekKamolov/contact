<?php


namespace app\controllers;

use app\models\ContractSearch;
use app\models\Task;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TaskController extends Controller
{
    public function actionIndex()
    {
        $model = Task::find()->all();

        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionView($id)
    {

        return $this->render('view', [
            'model' => $this->findModel($id),

        ]);
    }

    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}