<?php

namespace app\modules\contact\controllers;

use app\models\User;
use app\modules\contact\models\AdditionalField;
use app\modules\contact\models\AdditionalFieldsValue;
use app\modules\contact\models\AdditionalFieldValSearch;
use Faker\Core\File;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;
use yii\web\UploadedFile;

/**
 * AdditionalFieldsValController implements the CRUD actions for AdditionalFieldsValue model.
 */
class AdditionalFieldsValController extends Controller
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
     * Lists all AdditionalFieldsValue models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AdditionalFieldValSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AdditionalFieldsValue model.
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
     * Creates a new AdditionalFieldsValue model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new AdditionalFieldsValue();

        if ($model->load(\Yii::$app->request->post())) {
            $i = 0;
            while (!empty($file = UploadedFile::getInstance($model, "value[" . $i . ']'))) {
                $i = $i + 1;
                if ($file->size > 100000000) {
                    return $this->redirect('/additional-fields-val/create');
                } else {
                    $fileName = md5($file->name) . '.' . $file->getExtension();
                    $model->value = $fileName;
                    $model->created_by = Yii::$app->user->id;
                    Yii::$app->db->createCommand()->insert('additional_fields_values', $model->attributes)->execute();

                    $file->saveAs('uploads/files/' . $fileName);
                }
            }
            if (empty(UploadedFile::getInstance($model, "value[0]"))) {
                $model->save();
            }

            return $this->redirect('/contact/additional-fields-val');

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AdditionalFieldsValue model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $this->isAccess($model);
        $oldValue = $model->value;
        if ($this->request->isPost && $model->load($this->request->post())) {
            $i = 0;
            while (!empty($file = UploadedFile::getInstance($model, "value[" . $i . ']'))) {
                $i++;
                if ($file->size > 100000000) {
                    return $this->redirect('/additional-fields-val/create');
                } else {
                    $fileName = md5($file->name) . '.' . $file->getExtension();
                    $model->value = $fileName;
                    $model->created_by = Yii::$app->user->id;
                    $model->save();
                    $file->saveAs('uploads/files/' . $fileName);
                    $path = Yii::getAlias('@webroot') . '/uploads/files/' . $oldValue;
                    if (file_exists($path) && !empty($oldValue)) {
                        unlink($path);
                    }
                }
            }
            if (empty(UploadedFile::getInstance($model, "value[0]"))) {
                $model->save();
            }

            return $this->redirect('/contact/additional-fields-val');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AdditionalFieldsValue model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->isAccess($model);
        $path = Yii::getAlias('@webroot') . '/uploads/files/' . $model->value;
        if (file_exists($path) && !empty($model->value)) {
            unlink($path);
        }
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the AdditionalFieldsValue model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return AdditionalFieldsValue the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdditionalFieldsValue::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionChoose()
    {
        if ($this->request->isPost) {
            $additional = AdditionalField::find()->where(['id' => $_POST['category']])->one()->attributes;
            return $additional['type'];
        }
    }

    public function isAccess($model){
         if (\Yii::$app->user->identity->id != $model['created_by'] && User::getMyRole() != 'superAdmin') {
            return $this->redirect('/contact/additional-fields-val');
        }
    }
}
