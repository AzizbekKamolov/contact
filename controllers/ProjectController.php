<?php


namespace app\controllers;

use app\models\ContractSearch;
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
        $searchModel = new ContractSearch();
        $dataProvider = $searchModel->search(1);
//        print_r($this->request->queryParams);die();
//        var_dump($this->request);die();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'contracts' => $contracts,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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