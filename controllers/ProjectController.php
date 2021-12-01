<?php


namespace app\controllers;

use app\models\Project;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ProjectController extends Controller
{
    public function actionIndex()
    {
        $model = Project::find()->all();

        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionView($id)
    {
        $contracts = $this->findModel($id)->contracts;

        return $this->render('view', [
            'model' => $this->findModel($id),
            'contracts' => $contracts
        ]);
    }

    public function actionHello($id)
    {
        return 'Hello woorld ' . $id    ;
    }

    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}