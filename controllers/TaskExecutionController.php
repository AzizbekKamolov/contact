<?php

namespace app\controllers;

use app\models\Project;
use app\models\Status;
use app\models\Task;
use app\models\TaskExchange;
use app\models\TaskExchangeSearch;
use app\models\TaskExecution;
use app\models\TaskExecutionSearch;
use app\models\User;
use Cassandra\Date;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * TaskExecutionController implements the CRUD actions for TaskExecution model.
 */
class TaskExecutionController extends Controller
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
     * Lists all TaskExecution models.
     * @return mixed
     */
    public function actionIndex()
    {
        $myRole = User::getMyRole();

        $searchModel = new TaskExecutionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        if ($myRole === 'headOfDep'){
            $dataProvider->query->andWhere(['user_id' =>  \Yii::$app->user->id])->orWhere(['receive_user' => \Yii::$app->user->id])->orWhere(['exe_user_id' => \Yii::$app->user->id]);
            $dataProvider->setSort([
                'defaultOrder' => ['id'=>SORT_DESC],
            ]);
        } elseif ($myRole === "simpleUser") {
            $dataProvider->query->andWhere(['exe_user_id' =>  \Yii::$app->user->id])->orWhere(['receive_user' => \Yii::$app->user->id]);
            $dataProvider->setSort([
                'defaultOrder' => ['id'=>SORT_DESC],
            ]);
        }

        return $this->render('index', [
            'searchModel'   => $searchModel,
            'dataProvider'  => $dataProvider,
            'tasks'         => Task::getTasks(),
            'users'         => User::getUsers(),
            'statuses'      => Status::getStatuses()
        ]);
    }

    /**
     * Displays a single TaskExecution model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new TaskExchangeSearch();
        $dataProvider = $searchModel->search(($this->request->queryParams));
        $dataProvider->query->andWhere(['task_exe_id' =>  $id]);
//        $dataProvider->setSort([
//            'defaultOrder' => ['id'=>SORT_DESC],
//        ]);


        return $this->render('view', [
            'model'         => $this->findModel($id),
            'searchModel'  => $searchModel,
            'dataProvider'  => $dataProvider
        ]);
    }

    /**
     * Creates a new TaskExecution model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($task_id = 1)
    {
        $tasks = ArrayHelper::map(Task::find()->where(['user_id' => \Yii::$app->user->id])->all(), 'id', 'title');
        $model = new TaskExecution();

        if ($this->request->isPost) {
            $model->user_id = \Yii::$app->user->id;
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'tasks' => $tasks,
            'users' =>  User::getUsers(),
            'task_id' => $task_id
        ]);
    }

    /**
     * Updates an existing TaskExecution model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'tasks' => Task::getTasks(),
            'users' =>  User::getUsers()
        ]);
    }

    /**
     * Deletes an existing TaskExecution model.
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
     * Finds the TaskExecution model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return TaskExecution the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TaskExecution::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionTaskExe($id)
    {
        $model = new TaskExchange;

        if ($this->request->isPost)
        {
            $taskExecution = $this->findModel($id);
            $info = $this->request->post("TaskExchange")['info'];

            $model->task_exe_id = $id;
            $model->exe_user_id = \Yii::$app->user->id;
            $model->rec_user_id = $taskExecution->receive_user;
            $taskExecution->status_id = Status::findOne(['title' => 'Отправленная'])->id;
            $model->info =$info;
//            var_dump($taskExecution->save());die();
            if ($model->save() && $taskExecution->save()) {
                return $this->redirect(['view', 'id' => $taskExecution->id]);
            }

        }

        return $this->render('task-executor', [
            'model' => $model
        ]);
    }

    public function actionTaskCheck($id)
    {
        $model = $this->findModel($id);
        $taskExchange = TaskExchange::find()->where(['task_exe_id' => $id])->orderBy(['id' => SORT_DESC])->one();
//        var_dump($taskExchange);die();

        return $this->render('task-receiver',[
            'model' => $model,
            'taskExchange' => $taskExchange
        ]);
    }

    public function actionTaskDeny($id)
    {
        $model = new TaskExchange;

        if ($this->request->isPost)
        {
            $taskExecution = $this->findModel($id);
            $info = $this->request->post("TaskExchange")['info'];

            $model->task_exe_id = $id;
            $model->exe_user_id = $taskExecution->exe_user_id;
            $model->rec_user_id = \Yii::$app->user->id;
            $taskExecution->status_id = Status::findOne(['title' => 'Отказанная'])->id;
            $model->info =$info;

            if ($model->save() && $taskExecution->save()) {
                return $this->redirect(['view', 'id' => $taskExecution->id]);
            }

        }

        return $this->render('task-deny', [
            'model' => $model
        ]);
    }

    public function actionTaskApprove($id)
    {
        $taskExecution = $this->findModel($id);
        $marks = [
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
        ];



        if ($this->request->isPost)
        {
            $mark = $this->request->post('TaskExecution')['mark'];
            $done_date = \date('Y-m-d H:i:s');
//            var_dump($done_date);die();

            $taskExecution->status_id   = Status::findOne(['title' => 'Одобренная'])->id;
            $taskExecution->mark        = $mark;
            $taskExecution->done_date   = $done_date;

            if($taskExecution->save())
            {
                return $this->redirect(['view', 'id' => $taskExecution->id]);
            }
        }

        return $this->render('task-mark',[
            'model' => $taskExecution,
            'marks' =>  $marks
        ]);
    }
}
