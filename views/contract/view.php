<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Contract */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Контракты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$myRole = \app\models\User::getMyRole();
?>
<div class="contract-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= ($myRole === "admin" || $myRole === "superAdmin") ? Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) : "" ?>
        <?= (Yii::$app->user->id === $model->user_id || $myRole === "admin" || $myRole === "superAdmin") ? Html::a('Загрузить файл', ['set-file', 'id' => $model->id], ['class' => 'btn btn-success']) : "" ?>
        <?= ($myRole === "admin" || $myRole === "superAdmin") ? Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) : "" ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
//            'project_id',
//            'title',
//            'description:ntext',
//            'price',
//            'user_id',
//            'file_url:url',
//            'status_id',
//            'deadline',
//            'created_at',
//            'updated_at',
            [
                'label' => 'Проект',
                'value' =>  function($data) {
                    return \app\models\Project::find()->where(['id' => $data->project_id])->one()->title;
                }
            ],
            [
                'label' => 'Название',
                'value' =>  function($data) {
                    return $data->title;
                }
            ],
            [
                'label' => 'Описание',
                'value' =>  function($data) {
                    return $data->description;
                }
            ],
            [
                'label' => 'Цена',
                'value' =>  function($data) {
                    return $data->price;
                }
            ],
            [
                'label' => 'Валюта',
                'value' =>  function($data) {
                    return \app\models\Currency::find()->where(['id' => $data->currency_id])->one()->name;
                }
            ],
            [
                'label' => 'Создатель',
                'value' =>  function($data) {
                    return \app\models\User::find()->where(['id' => $data->user_id])->one()->username;
                }
            ],
            [
                    'label' => 'Документ',
                    'value' => function($data)
                    {
                        return Html::a('Загрузить',  '../uploads/' . $data->file_url, [ ($data->file_url) ? '' : 'class' => 'btn  disabled']);
                    },
                    'format' => 'raw',
            ],
            [
                'label' => 'Статус',
                'value' =>  function($data) {
                    return \app\models\Status::find(['id' => $data->status_id])->one()->title;
                }
            ],
            [
                'label' => 'Срок',
                'value' =>  function($data) {
                    return date('d M Y', strtotime($data->deadline));
                }
            ],
            [
                'label' => 'Создан',
                'value' =>  function($data) {
                    date_default_timezone_set('Asia/Tashkent');
                    return date('d M Y H:i:s',$data->created_at);
                }
            ],

        ],
    ]) ?>

    <br>
    <div class="row">
        <div class="col-9">
            <h1>Исполнение по <span style="color: rgba(0, 0, 0, 0.4);"><?= $model->title?></span></h1>
        </div>
        <div class="col-3">
            <?= (Yii::$app->user->id === $model->user_id) ? Html::a('Создать Исп по Kонтракт', ['contract-execution/create', 'contract_id' => $model->id], ['class' => 'btn btn-success float-right']) : "" ?>
        </div>
    </div>
    <br>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'title',
            'contract_id' => [
                'attribute' => 'contract_id',
                'value' =>  function($data) {
                    return \app\models\Contract::find()->where(['id' => $data->contract_id])->one()->title;
                }
            ],
            'user_id' => [
                'attribute' => 'user_id',
                'filter' => $users,
                'value' =>  function($data) {
                    return \app\models\User::find()->where(['id' => $data->user_id])->one()->username;
                }
            ],
            'exe_user_id' => [
                'attribute' => 'exe_user_id',
                'filter' => $users,
                'value' =>  function($data) {
                    return \app\models\User::find()->where(['id' => $data->exe_user_id])->one()->username;
                }
            ],
            'status_id' => [
                'attribute' => 'status_id',
                'filter' => $statuses,
                'value' =>  function($data) {
                    return \app\models\Status::find()->where(['id' => $data->status_id])->one()->title;
                }
            ],
            //'info:ntext',
            //'done_date',
            //'mark',
            //'receive_date',
            'receive_user' => [
                'attribute' => 'receive_user',
                'filter' => $users,
                'value' =>  function($data) {
                    return \app\models\User::find()->where(['id' => $data->receive_user])->one()->username;
                }
            ],
            //'created_at',
            //'updated_at',
//            [
//                'label' => 'Название',
//                'value' =>  function($data) {
//                    return $data->title;
//                }
//            ],
//            [
//                'label' => 'Контракт',
//                'value' =>  function($data) {
//                    return \app\models\Contract::find()->where(['id' => $data->contract_id])->one()->title;
//                }
//            ],
//            [
//                'label' => 'Создатель',
//                'value' =>  function($data) {
//                    return \app\models\User::find()->where(['id' => $data->user_id])->one()->username;
//                }
//            ],
//            [
//                'label' => 'Исполнитель',
//                'value' =>  function($data) {
//                    return \app\models\User::find()->where(['id' => $data->exe_user_id])->one()->username;
//                }
//            ],
//            [
//                'label' => 'Статус',
//                'value' =>  function($data) {
//                    return \app\models\Status::find()->where(['id' => $data->status_id])->one()->title;
//                }
//            ],
            [
                'header' => 'Меню',
                'format' => 'raw',
                'value' => function($data){
                    return Html::a('Перейти', ['contract-execution/view', 'id'=>$data->id]);
                }
            ],

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
