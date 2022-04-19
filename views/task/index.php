<?php

use app\models\Project;
use app\models\Status;
use app\models\User;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Задачи';
$this->params['breadcrumbs'][] = $this->title;
$myRole = \app\models\User::getMyRole();
    if($myRole === "superAdmin"){
        $template = '{view}{update}{delete}';
    }
    else{
        $template = '{view}';
    }
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= ($myRole !== "simpleUser") ? Html::a('Создать Задача', ['create'], ['class' => 'btn btn-success']) : "" ?>
    </p>

<!--    --><?php //echo $this->render('_search', [
//            'model'         => $searchModel,
//            'projects'      => $projects,
//            'users'         => $users,
//            'statuses'      => $statuses
//    ]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'project_id' => [
                'attribute' => 'project_id',
                'filter'    =>  $projects,
                'value' =>  function($data) {
                    return Project::getProjectById($data->project_id)->title;
                }
            ],
            'title:ntext',
//            'price',
            'user_id' => [
                'attribute' => 'user_id',
                'filter'    => $users,
                'value'     =>  function($data) {
                    return User::getUserById($data->user_id)->fullname;
                }
            ],
            'deadline' => [
                'attribute' => 'deadline',
                'value' =>  function($data) {
                    return date('d M Y H:i:s', strtotime($data->deadline));
                }
            ],
            'status_id' => [
                'attribute' => 'status_id',
                'filter'    => $statuses,
                'value'     =>  function($data) {
                    return Status::getStatusById($data->status_id)->title;
                },
                'contentOptions' => function($data) {
                    return ['class' => Status::getStatusColor($data->status_id)];
                }
            ],
            //'created_at',
            //'updated_at',
//            [
//                'label' => 'Проект',
//                'value' =>  function($data) {
//                    return \app\models\Project::find(['id' => $data->project_id])->one()->title;
//                }
//            ],
//            [
//                'label' => 'Название',
//                'value' =>  function($data) {
//                    return $data->title;
//                }
//            ],
//            [
//                'label' => 'Срок',
//                'value' =>  function($data) {
//                    return $data->deadline;
//                }
//            ],
//            [
//                'label' => 'Создатель',
//                'value' =>  function($data) {
//                    return \app\models\User::find()->where(['id' => $data->user_id])->one()->username;
//                }
//            ],
//            [
//                'label' => 'Статус',
//                'value' =>  function($data) {
//                    return \app\models\Status::find(['id' => $data->status_id])->one()->title;
//                }
//            ],


            [
                'class' => 'yii\grid\ActionColumn',
                'template'  =>$template
            ],
        ],
    ]); ?>


</div>
