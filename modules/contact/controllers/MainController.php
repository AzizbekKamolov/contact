<?php

namespace app\modules\contact\controllers;

//use accessBeahaviors;
use app\models\User;
use app\modules\contact\models\Category;
use app\modules\contact\models\Main;
use app\modules\contact\models\MainSearch;
use app\modules\contact\models\Subcategory;
use phpDocumentor\Reflection\Types\Integer;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Request;

/**
 * MainController implements the CRUD actions for Main model.
 */
class MainController extends Controller
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
     * Lists all Main models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MainSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Main model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Main model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Main();

        if ($this->request->isPost) {
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

    /**
     * Updates an existing Main model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $this->isAccess($model);
        $oldOwnerId = $model->owner_id;
        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->owner_id = $oldOwnerId;
             $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }


        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Main model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->isAccess($model);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Main model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Main the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Main::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionChoose()
    {
        $subCategoryCount = Subcategory::find()->where(['category_id' => $_POST['category']])->count();
        $category = isset($_POST['category']);
        if ($subCategoryCount > 0) {
            $subcategories = Subcategory::find()->where(['category_id' => $_POST['category']])->all();
            foreach ($subcategories as $subcategory) {
                echo "<option value='" . $subcategory->id . "'>" . $subcategory->title . "</option>";
            }
        } else {
            echo "<option>-</option>";
        }

    }

    public function isAccess($model){
        if (\Yii::$app->user->identity->id != $model['owner_id'] && User::getMyRole() != 'superAdmin'){
            return $this->redirect('/contact/main');
        }
    }
}
