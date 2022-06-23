<?php

use app\models\Status;
use app\models\Task;
use app\models\User;
use kartik\select2\Select2;
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
                    'task_id' =>[
                        'attribute'=>'task_id',
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'task_id',
                            'name' => 'kv-type-01',
                            'data' => $tasks,
                            'options' => [
                                'class' => 'form-control',
                                'placeholder' => 'Задача',

                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'selectOnClose' => true,
                            ]
                        ]),
                        'value' =>  function($data) {
                            return Task::getTaskById($data['task_id'])->title;
                        },
                    ],
                    'user_id' =>[
                        'attribute'=>'user_id',
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'user_id',
                            'name' => 'kv-type-01',
                            'data' => $users,
                            'options' => [
                                'class' => 'form-control',
                                'placeholder' => 'Создатель',

                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'selectOnClose' => true,
                            ]
                        ]),
                        'value' =>  function($data) {
                            return User::getUserById($data['user_id'])->fullname;
                        },
                    ],
                    'exe_user_id' =>[
                        'attribute'=>'exe_user_id',
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'exe_user_id',
                            'name' => 'kv-type-01',
                            'data' => $users,
                            'options' => [
                                'class' => 'form-control',
                                'placeholder' => 'Исполнитель',

                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'selectOnClose' => true,
                            ]
                        ]),
                        'value' =>  function($data) {
                            return User::getUserById($data['exe_user_id'])->fullname;
                        },
                    ],
                    'status_id' => [
                        'attribute'=>'status_id',
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'status_id',
                            'name' => 'kv-type-01',
                            'data' => $statuses,
                            'options' => [
                                'class' => 'form-control',
                                'placeholder' => 'Статус',

                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'selectOnClose' => true,
                            ]
                        ]),
                        'value' =>  function($data) {
                            return Status::getStatusById($data['status_id'])->title;
                        },
                        'contentOptions' => function($data) {
                            return ['class' => Status::getStatusColor($data['status_id'])];
                        }
                    ],

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => $template,
                        'buttons' => [
                            'view' => function($url, $model, $key) {
                                $i = '<i class="fas fa-eye"></i>';
                                return Html::a($i, ['task-execution/view', 'id' => $model['id']],[]);
                            },
                            'update' => function($url, $model, $key) {
                                $i = '<i class="fas fa-pen"></i>';
                                return Html::a($i, ['task-execution/update', 'id' => $model['id']],[]);
                            },
                            'delete' => function($url, $model, $key) {
                                $i = '<i class="fas fa-trash"></i>';
                                return Html::a($i, ['task-execution/delete', 'id' => $model['id']],[]);
                            },
                        ],
                    ],
                ],
            ]); ?>
        </div>
        <!-- /.card-body -->
    </div>

</div>
