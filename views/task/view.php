<?php

use app\models\Project;
use app\models\Status;
use app\models\Task;
use app\models\User;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Task */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Задачи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$myRole = \app\models\User::getMyRole();
?>
<div class="task-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= ($this->checkRoute('update')) ? Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) : "" ?>
        <?= ($this->checkRoute('delete')) ? Html::a('Удалить', ['delete', 'id' => $model->id], [
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
//            'title:ntext',
//            'price',
//            'deadline',
//            'user_id',
//            'status_id',
//            'created_at',
//            'updated_at',

            [
                'label' => 'Проект',
                'value' =>  function($data) {
                    return Project::getProjectById($data->project_id)->title;
                }
            ],
            [
                'label' => 'Название',
                'value' =>  function($data) {
                    return $data->title;
                }
            ],
            [
                'label' => 'Цена',
                'value' =>  function($data) {
                    return $data->price;
                }
            ],
            [
                'label' => 'Создатель',
                'value' =>  function($data) {
                    return User::getUserById($data->user_id)->fullname;
                }
            ],
            [
                'label' => 'Статус',
                'value' =>  function($data) {
                    return Status::getStatusById($data->status_id)->title;
                }
            ],
            [
                'label' => 'Создан',
                'value' =>  function($data) {
                    date_default_timezone_set('Asia/Tashkent');
                    return date('d M Y H:i:s',$data->created_at);
                }
            ],
            [
                'label' => 'Срок',
                'value' =>  function($data) {
                    return date('d M Y H:i:s', strtotime($data->deadline));
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
            <?= (Yii::$app->user->id === $model->user_id) ? Html::a('Создать Исп по Задачу', ['task-execution/create', 'task_id' => $model->id], ['class' => 'btn btn-success float-right']) : "" ?>
        </div>
    </div>
    <br>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'title',
//            'task_id',
//            'user_id',
//            'exe_user_id',
//            'status_id',
            //'info:ntext',
            //'done_date',
            //'mark',
            //'receive_date',
            //'receive_user',
            //'created_at',
            //'updated_at',
            [
                'label' => 'Название',
                'value' =>  function($data) {
                    return $data->title;
                }
            ],
            [
                'label' => 'Задача',
                'value' =>  function($data) {
                    return Task::getTaskById($data->task_id)->title;
                }
            ],
            [
                'label' => 'Исполнитель',
                'value' =>  function($data) {
                    return User::getUserById($data->exe_user_id)->fullname;
                }
            ],
            [
                'label' => 'Статус',
                'value' =>  function($data) {
                    return Status::getStatusById($data->status_id)->title;
                },
                'contentOptions' => function($data) {
                    return ['class' => Status::getStatusColor($data->status_id)];
                }
            ],
            [
                'header' => 'Меню',
                'format' => 'raw',
                'value' => function($data){
                    return Html::a('Перейти', ['task-execution/view', 'id'=>$data->id]);
                }
            ],

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
