<?php


namespace app\controllers;

use app\models\Contract;
use app\models\ContractSearch;
use app\models\Currency;
use app\models\ExpenseSearch;
use app\models\Project;
use app\models\ProjectSearch;
use app\models\Status;
use app\models\StatusChanges;
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
//        $this->checkStatus();
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);


        return $this->render('index', [
            'searchModel'   => $searchModel,
            'dataProvider'  => $dataProvider,
            'users'         => User::getUsers(),
            'statuses'      =>  Status::getStatuses()
        ]);
    }

//    public function checkStatus()
//    {
//        $contracts  = Contract::find()->all();
//        $tasks      = Task::find()->all();
//        $projects   = Project::find()->all();
//
//        $check = 0;
//        $hasProject = 0;
//        foreach ($projects as $project) {
//            foreach ($contracts as $contract) {
//                if ($project->id == $contract->project_id){
//                    if ($contract->status_id !== 6){
//                        $check++;
//                    }
//                    $hasProject++;
//                }
//            }
//
//            foreach ($tasks as $task) {
//                if ($project->id == $task->project_id){
//                    if ($task->status_id !== 6){
//                        $check++;
//                    }
//                    $hasProject++;
//                }
//            }
//
//            if($hasProject != 0) {
//                if ($check != 0) {
//                    $model = $this->findModel($project->id);
//                    $model->status_id = 5;
//                    $model->save();
//                } else {
//                    $model = $this->findModel($project->id);
//                    $model->status_id = 6;
//                    $model->save();
//                }
//            }
//            $check = 0;
//            $hasProject = 0;
//        }
//    }

    public function actionView($id)
    {
        $searchModel = new ContractSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        $dataProvider->query->andWhere(['project_id' =>  $id]);
//        $dataProvider->setSort([
//            'defaultOrder' => ['id'=>SORT_DESC],
//        ]);

        $searchModelTask = new TaskSearch();
        $dataProviderTask = $searchModelTask->search(\Yii::$app->request->queryParams);
        $dataProviderTask->query->andWhere(['project_id' => $id]);

        $searchModelExpense = new ExpenseSearch();
        $dataProviderExpense = $searchModelExpense->search(\Yii::$app->request->queryParams);
        $dataProviderExpense->query->andWhere(['project_id' => $id]);

        return $this->render('view', [
            'model'             => $this->findModel($id),
            'searchModel'       => $searchModel,
            'dataProvider'      => $dataProvider,
            'searchModelTask'   => $searchModelTask,
            'dataProviderTask'  => $dataProviderTask,
            'statuses'          => Status::getStatuses(),
            'contracts'         => ArrayHelper::map(Contract::find()->where(['project_id' => $id])->all(), 'id', 'title'),
            'currencies'        => Currency::getCurrencies(),
            'searchModelExpense' => $searchModelExpense,
            'dataProviderExpense' => $dataProviderExpense
        ]);
    }

    public function actionCreate()
    {
        $model = new Project();
        $user_id = \Yii::$app->user->id;

        if ($this->request->isPost) {
            $model->currency_id = 1;
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model'         => $model,
//            'currencies'    => Currency::getCurrencies(),
            'users'         => User::getUsers()
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model'         => $model,
            'currencies'    => Currency::getCurrencies(),
            'users'         => User::getUsers()
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

    public function actionProjectSend($id)
    {
        $model = new StatusChanges();

        if ($this->request->isPost)
        {
            $model->object_type = StatusChanges::PROJECT_TYPE;
            $model->object_id   = $id;
            $model->status_id   = Status::findOne(['title' => 'Отправленная'])->id;
            $model->comment     = $this->request->post("StatusChanges")["comment"];
            $model->user_id     = \Yii::$app->user->id;

            $project = Project::findOne($id);
            $project->status_id = Status::findOne(['title' => 'Отправленная'])->id;
            $project->save();

            if ($model->save())
            {
                $this->redirect(['view', 'id' => $id]);
            }
        }

        return $this->render('project-send',[
            'model' => $model
        ]);
    }

    public function actionProjectApprove($id)
    {
        $product = Project::findOne($id);
        $product->status_id = Status::findOne(['title' => 'Завершенная'])->id;

        if ($product->save())
        {
            \Yii::$app->session->setFlash('success', "Проект одобрен");
            $this->redirect(['view', 'id' => $id]);
        }
    }
    public function actionProjectDeny($id)
    {
//        var_dump($id);die();
        $product = Project::findOne($id);
        $product->status_id = Status::findOne(['title' => 'Отказанная'])->id;

        if ($product->save())
        {
            \Yii::$app->session->setFlash('success', "Проект отклонен");
            $this->redirect(['view', 'id' => $id]);
        }
    }


}