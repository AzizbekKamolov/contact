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
if( $myRole === "superAdmin"){
    $template = '{view}{update}{delete}';
}
else{
    $template = '{view}';
}
?>
<div class="task-execution-index">

    <div class="card card-outline card-success">
        <div class="card-header">
            <h1 class="card-title text-bold">
                <?= Html::encode($this->title) ?>
                <?= ($myRole !== "simpleUser") ? Html::a('+', ['create'], ['class' => 'btn btn-info ml-2', 'title' => 'Создать Вып. задач']) : "" ?>
            </h1>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

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

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template'  =>$template
                    ],
                ],
            ]); ?>
        </div>
        <!-- /.card-body -->
    </div>

</div>
