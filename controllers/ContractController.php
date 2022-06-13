<?php


namespace app\controllers;

use app\models\Contract;
use app\models\ContractExecution;
use app\models\ContractExecutionSearch;
use app\models\ContractSearch;
use app\models\Currency;
use app\models\ExpenseSearch;
use app\models\ImageUpload;
use app\models\Project;
use app\models\Status;
use app\models\User;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class ContractController extends Controller
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
     * Lists all Contract models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->checkStatus();
        $searchModel = new ContractSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'users'         => User::getUsers(),
            'statuses'      =>  Status::getStatuses()
        ]);
    }

    public function checkStatus()
    {
        $contracts = Contract::find()->all();
        $contractExecutions = ContractExecution::find()->all();

        $check = 0;
        $hasContract = 0;
        foreach ($contracts as $contract) {
            foreach ($contractExecutions as $contractExe) {
                if ($contract->id == $contractExe->contract_id){
                    if ($contractExe->status_id !== 4){
                        $check++;
                    }
                    $hasContract++;
                }
            }

            if($hasContract != 0) {
                if ($check != 0) {
                    $model = $this->findModel($contract->id);
                    $model->status_id = 5;
                    $model->save();
                } else {
                    $model = $this->findModel($contract->id);
                    $model->status_id = 6;
                    $model->save();
                }
            }
            $check = 0;
            $hasContract = 0;
        }
    }

    /**
     * Displays a single Contract model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->checkStatus();
        $searchModel = new ContractExecutionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andWhere(['contract_id' =>  $id]);

        $searchModelExpense = new ExpenseSearch();
        $dataProviderExpense = $searchModelExpense->search(\Yii::$app->request->queryParams);
        $dataProviderExpense->query->andWhere(['contract_id' => $id]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'users'         => User::getUsers(),
            'statuses'      =>  Status::getStatuses(),
            'contracts'     => Contract::getContracts(),
            'currencies'    => Currency::getCurrencies(),
            'searchModelExpense' => $searchModelExpense,
            'dataProviderExpense' => $dataProviderExpense
        ]);
    }

    /**
     * Creates a new Contract model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($project_id = 1)
    {
        $model = new Contract();
        if ((User::getMyRole() === 'admin') || (User::getMyRole() === 'superAdmin')){
            $projects = ArrayHelper::map(Project::find()->all(), 'id', 'title');
        } else {
            $projects = ArrayHelper::map(Project::find()->where(['user_id' => \Yii::$app->user->id])->all(), 'id', 'title');
        }
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
            'projects' => $projects,
            'project_id'    => $project_id,
            'currencies'    => Currency::getCurrencies()
        ]);
    }

    /**
     * Updates an existing Contract model.
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
            'projects' => Project::getProjects(),
            'currencies'    => Currency::getCurrencies()
        ]);
    }

    /**
     * Deletes an existing Contract model.
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
     * Finds the Contract model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Contract the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contract::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSetFile($id)
    {
        $model = new ImageUpload;

        if (\Yii::$app->request->isPost)
        {
            $contract = $this->findModel($id);
            $file = UploadedFile::getInstance($model, 'image');

            if ($contract->saveImage($model->uploadFile($file, $contract->file_url)))
            {
                return $this->redirect(['view',
                    'id' => $contract->id
                ]);
            }
        }

        return $this->render('image', [
            'model' => $model
        ]);
    }
}