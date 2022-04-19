<?php

namespace app\controllers;

use app\models\Contract;
use app\models\ContractExchange;
use app\models\ContractExchangeSearch;
use app\models\ContractExecution;
use app\models\ContractExecutionSearch;
use app\models\FileUpload;
use app\models\Status;
use app\models\User;
use DateTime;
use phpDocumentor\Reflection\Types\Null_;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ContractExecutionController implements the CRUD actions for ContractExecution model.
 */
class ContractExecutionController extends Controller
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
     * Lists all ContractExecution models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContractExecutionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

//        if (User::getMyRole() === 'headOfDep'){
//            $dataProvider->query->andWhere(['user_id' => \Yii::$app->user->id])->orWhere(['receive_user' => \Yii::$app->user->id])->orWhere(['exe_user_id' => \Yii::$app->user->id]);
//            $dataProvider->setSort([
//                'defaultOrder' => ['id'=>SORT_DESC],
//            ]);
//        } elseif (User::getMyRole() === "simpleUser") {
//            $dataProvider->query->andWhere(['exe_user_id' =>  \Yii::$app->user->id])->orWhere(['receive_user' => \Yii::$app->user->id]);
//            $dataProvider->setSort([
//                'defaultOrder' => ['id'=>SORT_DESC],
//            ]);
//        }


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'users'         => User::getUsers(),
            'statuses'      =>  Status::getStatuses(),
            'contracts'     => Contract::getContracts()
        ]);
    }

    /**
     * Displays a single ContractExecution model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $a = ContractExchange::find()->all();
        $lastItem = end($a);
//        var_dump($lastItem);die();
        $searchModel = new ContractExchangeSearch();
        $dataProvider = $searchModel->search(($this->request->queryParams));
        $dataProvider->query->andWhere(['con_exe_id' =>  $id]);
//        $dataProvider->setSort([
//            'defaultOrder' => ['id'=>SORT_DESC],
//        ]);
        return $this->render('view', [
            'lastItem' => $lastItem,
            'model' => $this->findModel($id),
            'searchModel'  => $searchModel,
            'dataProvider'  => $dataProvider
        ]);
    }

    /**
     * Creates a new ContractExecution model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($contract_id = 1)
    {
        if (User::getMyRole() === 'admin' || User::getMyRole() === 'superAdmin') {
            $contracts = ArrayHelper::map(Contract::find()->all(), 'id', 'title');
        } else {
            $contracts = ArrayHelper::map(Contract::find()->where(['user_id' => \Yii::$app->user->id])->all(), 'id', 'title');
        }
        $model = new ContractExecution();

        if ($this->request->isPost) {
            $model->user_id = \Yii::$app->user->id;
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model'     =>  $model,
            'contracts' =>  $contracts,
            'users'     =>  User::getUsers(),
            'contract_id' => $contract_id
        ]);
    }

    /**
     * Updates an existing ContractExecution model.
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
            'contracts' =>  Contract::getContracts(),
            'users'     =>   User::getUsers()
        ]);
    }

    /**
     * Deletes an existing ContractExecution model.
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
     * Finds the ContractExecution model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ContractExecution the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ContractExecution::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionContractExe($id)
    {
        $model = new ContractExchange();
        $fileUpload = new FileUpload();
        $contractExecution = $this->findModel($id);

        if ($this->request->isPost)
        {
            $contractExecution = $this->findModel($id);
            $file = UploadedFile::getInstance($fileUpload, 'file');
            $info = $this->request->post("ContractExchange")['info'];
//            if($this->request->post("new_receive_user")){
//                $exe_model = new ContractExecution();
//                $exe_model->contract_id = ContractExecution::findOne($id)->contract_id;
//                $exe_model->user_id = \Yii::$app->user->id;
//                $exe_model->exe_user_id = $this->request->post("new_receive_user");
//                $exe_model->receive_user = \Yii::$app->user->id;
//                $exe_model->status_id = 1;
//                $exe_model->title = $this->request->post("ContractExchange")['info'];
//                if($exe_model->save()){
//                    return $this->redirect(['view', 'id' => $exe_model->id]);
//                }
//            }

            if($this->request->post("new_receive_user")){
                $contractExecution = $this->findModel($id);
                $file = UploadedFile::getInstance($fileUpload, 'file');
                $info = $this->request->post("ContractExchange")['info'];

                $model->con_exe_id = $id;
                $model->exe_user_id = $this->request->post("new_receive_user");
                $model->rec_user_id = \Yii::$app->user->id;
                $contractExecution->status_id = Status::findOne(['title' => 'В процессе'])->id;
                $model->info =$info;
                $model->saveFile($fileUpload->uploadFile($file, $model->file));

                if ($model->save() && $contractExecution->save()) {
                    return $this->redirect(['view', 'id' => $contractExecution->id]);
                }
            }

            if ($contractExecution->exe_user_id !== \Yii::$app->user->id)
            {
                $model->con_exe_id = $id;
                $model->exe_user_id = \Yii::$app->user->id;
                $model->rec_user_id = $contractExecution->exe_user_id;
                $model->info =$info;
                $model->saveFile($fileUpload->uploadFile($file, $model->file));

                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $contractExecution->id]);
                }
            }

            $model->con_exe_id = $id;
            $model->exe_user_id = \Yii::$app->user->id;
            $model->rec_user_id = $contractExecution->receive_user;
            $contractExecution->status_id = Status::findOne(['title' => 'Отправленная'])->id;
            $model->info =$info;
            $model->saveFile($fileUpload->uploadFile($file, $model->file));

            if ($model->save() && $contractExecution->save()) {
                return $this->redirect(['view', 'id' => $contractExecution->id]);
            }


        }

        return $this->render('contract-executor', [
            'model' => $model,
            'contractExecution' => $contractExecution,
            'fileUpload' => $fileUpload,
            'users' => User::getUsers()
        ]);
    }

    public function actionContractCheck($id)
    {
        $model = $this->findModel($id);
        $contractExchange = ContractExchange::find()->where(['con_exe_id' => $id])->orderBy(['id' => SORT_DESC])->one();

        if ($model->receive_date === NULL)
        {
            $receive_date = \date('Y-m-d H:i:s');
            $model->receive_date = $receive_date;
            $model->save();
        }

        return $this->render('contract-receiver',[
            'model' => $model,
            'contractExchange' => $contractExchange
        ]);
    }

    public function actionContractApprove($id)
    {
        $contractExecution = $this->findModel($id);
        $marks = [
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
        ];

        if ($this->request->isPost)
        {
            $mark = $this->request->post('ContractExecution')['mark'];
            $info = $this->request->post('ContractExecution')['info'];
//            var_dump($info);die();
            $done_date = \date('Y-m-d H:i:s');

            $contractExecution->status_id   = Status::findOne(['title' => 'Одобренная'])->id;
            $contractExecution->mark        = $mark;
            $contractExecution->info        = $info;
            $contractExecution->done_date   = $done_date;

            if($contractExecution->save())
            {
                return $this->redirect(['view', 'id' => $contractExecution->id]);
            }
        }

        return $this->render('contract-mark',[
            'model' => $contractExecution,
            'marks' =>  $marks
        ]);
    }

    public function actionContractDeny($id)
    {
        $model = new ContractExchange();
        $fileUpload = new FileUpload();

        if ($this->request->isPost)
        {
            $contractExecution = $this->findModel($id);
            $file = UploadedFile::getInstance($fileUpload, 'file');
            $info = $this->request->post("ContractExchange")['info'];

            $model->con_exe_id = $id;
            $model->exe_user_id = \Yii::$app->user->id;
            $model->rec_user_id = $contractExecution->exe_user_id;
            $contractExecution->status_id = Status::findOne(['title' => 'Отказанная'])->id;
            $model->info =$info;
//            var_dump($fileUpload->uploadFile($file, $model->file));die();
            $model->saveFile($fileUpload->uploadFile($file, $model->file));

            if ($model->save() && $contractExecution->save()) {
                return $this->redirect(['view', 'id' => $contractExecution->id]);
            }

        }

        return $this->render('contract-deny', [
            'model' => $model,
            'fileUpload' => $fileUpload
        ]);
    }
}
