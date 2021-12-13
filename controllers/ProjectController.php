<?php


namespace app\controllers;

use app\models\ContractSearch;
use app\models\Project;
use app\models\ProjectSearch;
use app\models\Task;
use app\models\TaskSearch;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ProjectController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $searchModel = new ContractSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

//        if (User::getMyRole() !== 'admin') {
//            $dataProvider->query->andWhere(['project_id' =>  $id]);
//        }

        $dataProvider->query->andWhere(['project_id' =>  $id]);
        $dataProvider->setSort([
            'defaultOrder' => ['id'=>SORT_DESC],
        ]);

        $searchModelTask = new TaskSearch();
        $dataProviderTask = $searchModelTask->search(\Yii::$app->request->queryParams);
        $dataProviderTask->query->andWhere(['project_id' => $id]);
        $dataProviderTask->setSort([
            'defaultOrder' => ['id'=>SORT_DESC],
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelTask' => $searchModelTask,
            'dataProviderTask' => $dataProviderTask
        ]);
    }

    public function actionCreate()
    {
        $model = new Project();
        $user_id = \Yii::$app->user->id;

        if ($this->request->isPost) {
            $model->user_id = $user_id;
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}