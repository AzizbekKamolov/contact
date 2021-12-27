<?php


namespace app\controllers;

use app\models\ContractSearch;
use app\models\Currency;
use app\models\Project;
use app\models\ProjectSearch;
use app\models\Status;
use app\models\Task;
use app\models\TaskSearch;
use app\models\User;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ProjectController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $users = ArrayHelper::map(User::find()->all(), 'id', 'username');
        $statuses = ArrayHelper::map(Status::find()->all(), 'id', 'title');

        $users = array('' => 'Ползователь') + $users;
        $statuses = array('' => 'Статус') + $statuses;

        return $this->render('index', [
            'searchModel'   => $searchModel,
            'dataProvider'  => $dataProvider,
            'users'         => $users,
            'statuses'      =>  $statuses
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

        $currencies = ArrayHelper::map(Currency::find()->all(), 'id', 'name');

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
            'currencies' => $currencies
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $currencies = ArrayHelper::map(Currency::find()->all(), 'id', 'name');

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'currencies' => $currencies
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