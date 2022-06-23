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

    <div class="card card-outline card-success">
        <div class="card-header">
            <h1 class="card-title text-bold">
                <?= Html::encode($this->title) ?>
                <?= ($this->checkRoute('update')) ? Html::a('<i class="fas fa-pen"></i>', ['update', 'id' => $model->id], ['class' => 'text-primary mx-2', 'title' => 'Обнавить задача']) : "" ?>
                <?= ($this->checkRoute('delete')) ? Html::a('<i class="fas fa-times"></i>', ['delete', 'id' => $model->id], [
                    'class' => 'text-danger',
                    'title' => 'Удалить задача',
                    'data' => [
                        'confirm' => 'Вы уверены, что хотите удалить этот задача?',
                        'method' => 'post',
                    ],
                ]) : "" ?>
            </h1>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body" >
            <div class="row">
                <div class="col-6">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
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
                        ],
                    ]) ?>
                </div>
                <div class="col-6">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
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
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>

    <div class="card card-outline card-success collapsed-card">
        <div class="card-header">
            <h1 class="card-title">
                Исполнение по <span class="mr-1 text-bold" style="color: black;"><?= $model->title?></span>
                <?= (Yii::$app->user->id === $model->user_id || $myRole == "admin" || $myRole == "superAdmin") ? Html::a('+', ['task-execution/create', 'task_id' => $model->id], ['class' => 'btn btn-info', 'title' => 'Создать Исп по Kонтракт']) : "" ?>
            </h1>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
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
                ],
            ]); ?>
        </div>
        <!-- /.card-body -->
    </div>

</div>
