<?php

namespace app\controllers;

use app\models\Currency;
use app\models\Project;
use app\models\Status;
use app\models\Task;
use app\models\TaskExecution;
use app\models\TaskExecutionSearch;
use app\models\TaskSearch;
use app\models\User;
use DateTime;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Task models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->checkStatus();
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel'   => $searchModel,
            'dataProvider'  => $dataProvider,
            'projects'      => Project::getProjects(),
            'users'         => User::getUsers(),
            'statuses'      => Status::getStatuses()
        ]);
    }

    public function checkStatus()
    {
        $tasks = Task::find()->all();
        $taskExecutions = TaskExecution::find()->all();

        $check = 0;
        $hasTask = 0;
        foreach ($tasks as $task) {
            foreach ($taskExecutions as $taskExe) {
                if ($task->id == $taskExe->task_id){
                    if ($taskExe->status_id !== 4){
                        $check++;
                    }
                    $hasTask++;
                }
            }

            if($hasTask != 0) {
                if ($check != 0) {
                    $model = $this->findModel($task->id);
                    $model->status_id = 5;
                    $model->save();
                } else {
                    $model = $this->findModel($task->id);
                    $model->status_id = 6;
                    $model->save();
                }
            }
            $check = 0;
            $hasTask = 0;
        }
    }

    /**
     * Displays a single Task model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->checkStatus();
        $searchModel = new TaskExecutionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andWhere(['task_id' =>  $id]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($project_id = 1)
    {
        $model = new Task();
        $taskExeModel = new TaskExecution();
//        $projects = ArrayHelper::map(Project::find()->where(['user_id' => \Yii::$app->user->id])->all(), 'id', 'title');
        if ((User::getMyRole() === 'admin') || (User::getMyRole() === 'superAdmin')){
            $projects = ArrayHelper::map(Project::find()->all(), 'id', 'title');
        } else {
            $projects = ArrayHelper::map(Project::find()->where(['user_id' => \Yii::$app->user->id])->all(), 'id', 'title');
        }

        if ($this->request->isPost) {
            $task = $this->request->post("Task");
            $taskExe = $this->request->post('TaskExecution');

            $model->project_id = $task['project_id'];
            $model->title = $task['title'];
            $model->deadline = $task['deadline'];
            $model->user_id = \Yii::$app->user->id;
            $model->status_id = Status::findOne(['title' => 'В процессе'])->id;

            if ($model->save()) {
                $taskExeModel->title = $model->title;
                $taskExeModel->task_id = $model->id;
                $taskExeModel->user_id = $model->user_id;
                $taskExeModel->exe_user_id = $taskExe['exe_user_id'];
                $taskExeModel->status_id = Status::findOne(['title' => 'В процессе'])->id;
                $taskExeModel->receive_user = $model->user_id;

                if ($taskExeModel->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'taskExeModel' => $taskExeModel,
            'projects' => $projects,
            'project_id' => $project_id,
            'users'    => User::getUsers()
        ]);
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
//            var_dump($model->touch('created_at'));die();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'projects' => Project::getProjects(),
            'currencies'    => Currency::getCurrencies()
        ]);
    }

    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
