<?php

use app\models\Currency;
use app\models\Status;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use \app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Проекты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$myRole = \app\models\User::getMyRole();
?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= ($myRole === "admin") ? Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) : "" ?>
        <?= ($myRole === "admin") ? Html::a('Delete', ['delete', 'id' => $model->id], [
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
//            'title',
//            'description:ntext',
//            'budget_sum',
//            'currency_id',
//            'project_year',
//            'user_id',
//            'status_id',
//            'deadline',
//            'created_at',
//            'updated_at',
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
                'label' => 'Бюджет',
                'value' =>  function($data) {
                    return $data->budget_sum;
                }
            ],
            [
                'label' => 'Валюта',
                'value' =>  function($data) {
                    return Currency::getCurrencyById($data->currency_id)->name;
                }
            ],
            [
                'label' => 'Дата проекта',
                'value' =>  function($data) {
                    return $data->project_year;
                }
            ],
            [
                'label' => 'Ответственный',
                'value' =>  function($data) {
                    return User::getUserById($data->user_id)->fullname;
                }
            ],
            [
                'label' => 'Статус',
                'value' =>  function($data) {
                    return Status::getStatusById($data->status_id)->title;
                },
//                'contentOptions' => function($data) {
//                    return ['class' => Status::getStatusColor($data->status_id)];
//                },
            ],
            [
                'label' => 'Срок',
                'value' =>  function($data) {
                    return $data->deadline;
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
            <h1>Контракты по <span style="color: rgba(0, 0, 0, 0.4);"><?= $model->title?></span></h1>
        </div>
        <div class="col-3">
            <?= (Yii::$app->user->id === $model->user_id || $myRole == "admin" || $myRole == "superAdmin") ? Html::a('Создать Kонтракт', ['contract/create', 'project_id' => $model->id], ['class' => 'btn btn-success float-right']) : "" ?>
        </div>
    </div>
    <br>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'project_id',
            'title',
//            'description:ntext',
            'price' => [
                'attribute' => 'price',
                'value' => function($data) {
                    return $data->price;
                }
            ],
            //'user_id',
            //'file_url:url',
            'status_id' => [
                'attribute' => 'status_id',
                'filter' => $statuses,
                'value' =>  function($data) {
                    return Status::getStatusById($data->status_id)->title;
                },
                'contentOptions' => function($data) {
                    return ['class' => Status::getStatusColor($data->status_id)];
                }
            ],
            //'deadline',
            //'created_at',
            //'updated_at',
//            [
//                'label' => 'Название',
//                'value' =>  function($data) {
//                    return $data->title;
//                }
//            ],
//            [
//                'label' => 'Описание',
//                'value' =>  function($data) {
//                    return $data->description;
//                }
//            ],
//            [
//                'label' => 'Цена',
//                'value' =>  function($data) {
//                    return $data->price;
//                }
//            ],
//            [
//                'label' => 'Статус',
//                'value' =>  function($data) {
//                    return \app\models\Status::find(['id' => $data->status_id])->one()->title;
//                }
//            ],
            [
                    'header' => 'Меню',
                    'format' => 'raw',
                    'value' => function($data){
                        return Html::a('Перейти', ['contract/view', 'id'=>$data->id]);
                    }
            ],
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <br>
    <div class="row">
        <div class="col-9">
            <h1>Задачи по <span style="color: rgba(0, 0, 0, 0.4);"><?= $model->title?></span></h1>
        </div>
        <div class="col-3">
            <?= (Yii::$app->user->id === $model->user_id || $myRole == "admin" || $myRole == "superAdmin") ? Html::a('Создать Задача', ['task/create', 'project_id' => $model->id], ['class' => 'btn btn-success float-right']) : "" ?>
        </div>
    </div>
    <br>

    <?= GridView::widget([
        'dataProvider' => $dataProviderTask,
        'filterModel' => $searchModelTask,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//
//            'id',
//            'project_id',
            'title:ntext',
            'price' => [
                'attribute' => 'price',
                'value' => function($data) {
                    return $data->price;
                }
            ],
            'deadline' => [
                'attribute' => 'deadline',
                'value' =>  function($data) {
                    return $data->deadline;
                }
            ],
            //'user_id',
            'status_id' => [
                'attribute' => 'status_id',
                'filter' => $statuses,
                'value' =>  function($data) {
                    return Status::getStatusById($data->status_id)->title;;
                },
                'contentOptions' => function($data) {
                    return ['class' => Status::getStatusColor($data->status_id)];
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
//                'label' => 'Цена',
//                'value' =>  function($data) {
//                    return $data->price;
//                }
//            ],
//            [
//                'label' => 'Срок',
//                'value' =>  function($data) {
//                    return $data->deadline;
//                }
//            ],
//            [
//                'label' => 'Статус',
//                'value' =>  function($data) {
//                    return \app\models\Status::find(['id' => $data->status_id])->one()->title;
//                }
//            ],
            [
                'header' => 'Меню',
                'format' => 'raw',
                'value' => function($data){
                    return Html::a('Перейти', ['task/view', 'id'=>$data->id]);
                }
            ],

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
