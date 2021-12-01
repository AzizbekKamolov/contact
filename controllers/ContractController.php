<?php


namespace app\controllers;

use app\models\Contract;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ContractController extends Controller
{
    public function actionIndex()
    {
        $model = Contract::find()->all();

        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionView($id)
    {

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Contract::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}