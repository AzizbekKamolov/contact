<?php


namespace app\controllers;

use app\models\Contract;
use app\models\ContractExecutionSearch;
use app\models\ContractSearch;
use app\models\Currency;
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
        $searchModel = new ContractSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $users = ArrayHelper::map(User::find()->all(), 'id', 'username');
        $statuses = ArrayHelper::map(Status::find()->all(), 'id', 'title');

//        $users = array('' => 'Ползователь') + $users;
//        $statuses = array('' => 'Статус') + $statuses;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'users'         => $users,
            'statuses'      =>  $statuses
        ]);
    }

    /**
     * Displays a single Contract model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new ContractExecutionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andWhere(['contract_id' =>  $id]);

        $users = ArrayHelper::map(User::find()->all(), 'id', 'username');
        $statuses = ArrayHelper::map(Status::find()->all(), 'id', 'title');

        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'users'         => $users,
            'statuses'      =>  $statuses
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

        $projects = ArrayHelper::map(Project::find()->where(['user_id' => \Yii::$app->user->id])->all(), 'id', 'title');
        $currencies = ArrayHelper::map(Currency::find()->all(), 'id', 'name');
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
            'currencies'    => $currencies
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
        $projects = ArrayHelper::map(Project::find()->all(), 'id', 'title');
        $currencies = ArrayHelper::map(Currency::find()->all(), 'id', 'name');

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
    }

        return $this->render('update', [
            'model' => $model,
            'projects' => $projects,
            'currencies'    => $currencies
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