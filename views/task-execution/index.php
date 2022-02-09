<?php

use app\models\Status;
use app\models\Task;
use app\models\User;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaskExecutionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Выполнение задач';
$this->params['breadcrumbs'][] = $this->title;
$myRole = \app\models\User::getMyRole();
if($myRole=="admin" || $myRole === "superAdmin"){
    $template = '{view}{update}{delete}';
}
else{
    $template = '{view}';
}
?>
<div class="task-execution-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= ($myRole !== "simpleUser") ? Html::a('Создать Вып. задач', ['create'], ['class' => 'btn btn-success']): "" ?>
    </p>

<!--    --><?php //echo $this->render('_search', [
//            'model' => $searchModel,
//            'tasks'         => $tasks,
//            'users'         => $users,
//            'statuses'      => $statuses
//    ]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'title',
            'task_id' => [
                'attribute' => 'task_id',
                'filter' => $tasks,
                'value' =>  function($data) {
                    return Task::getTaskById($data->task_id)->title;
                }
            ],
            'user_id' => [
                'attribute' => 'user_id',
                'filter' => $users,
                'value' =>  function($data) {
                    return User::getUserById($data->user_id)->fullname;
                }
            ],
            'exe_user_id' => [
                'attribute' => 'exe_user_id',
                'filter' => $users,
                'value' =>  function($data) {
                    return User::getUserById($data->exe_user_id)->fullname;
                }
            ],
            'status_id' => [
                'attribute' => 'status_id',
                'filter'    => $statuses,
                'value' =>  function($data) {
                    return Status::getStatusById($data->status_id)->title;
                },
                'contentOptions' => function($data) {
                    return ['class' => Status::getStatusColor($data->status_id)];
                }
            ],
            //'info:ntext',
            //'done_date',
            //'mark',
            //'receive_date',
            //'receive_user',
            //'created_at',
            //'updated_at',
//            [
//                'label' => 'Название',
//                'value' =>  function($data) {
//                    return $data->title;
//                }
//            ],
//            [
//                'label' => 'Задача',
//                'value' =>  function($data) {
//                    return \app\models\Task::find()->where(['id' => $data->task_id])->one()->title;
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
                'class' => 'yii\grid\ActionColumn',
                'template'  =>$template
            ],
        ],
    ]); ?>


</div>
