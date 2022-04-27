<?php

use app\models\Status;
use app\models\Task;
use app\models\User;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TaskExecution */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Выполнение задач', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$myRole = \app\models\User::getMyRole();
?>
<div class="task-execution-view">

    <div class="card card-outline card-success collapsed-card">
        <div class="card-header">
            <h1 class="card-title text-bold">
                <?= Html::encode($this->title) ?>
                <?= $this->checkRoute("update") ? Html::a('<i class="fas fa-pen"></i>', ['update', 'id' => $model->id], ['class' => 'text-primary mx-2', 'title' => 'Обнавить Проект']) : "" ?>
                <?php  if ($model->receive_user === Yii::$app->user->id):?>
                    <?= Html::a('<i class="fas fa-check"></i>', ['task-check', 'id' => $model->id], ['class' => ($model->status_id !== 2) ? 'btn text-primary mx-2 disabled' : 'text-primary mx-2','title' => 'Проверить задачу']) ?>
                <?php elseif(Yii::$app->user->id === $model->exe_user_id): ?>
                    <?= Html::a('<i class="fas fa-play"></i>', ['task-exe', 'id' => $model->id], ['class' => (($model->status_id === 2) || ($model->status_id === 4)) ? 'btn text-success mx-2 disabled' : 'text-success mx-2', 'title' => 'Выполнить задачу']) ?>
                <?php endif; ?>
                <?= $this->checkRoute("delete") ? Html::a('<i class="fas fa-times"></i>', ['delete', 'id' => $model->id], [
                    'class' => 'text-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) : "" ?>
            </h1>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
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
                                'label' => 'Создатель',
                                'value' =>  function($data) {
                                    return User::getUserById($data->user_id)->fullname;
                                }
                            ],
                            [
                                'label' => 'Исполнитель',
                                'value' =>  function($data) {
                                    return User::getUserById($data->exe_user_id)->fullname;
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
                                'label' => 'Статус',
                                'value' =>  function($data) {
                                    return Status::getStatusById($data->status_id)->title;
                                }
                            ],
                            [
                                'label' => 'Оценка',
                                'value' =>  function($data) {
                                    return ($data->mark) ? $data->mark . ' из 5. Описание: ' . $data->info : '';
                                }
                            ],
                            [
                                'label' => 'Получатель',
                                'value' =>  function($data) {
                                    return  User::getUserById($data->receive_user)->fullname;
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
                                'label' => 'Дата завершения',
                                'value' =>  function($data) {
                                    return ($data->done_date) ? date('d M Y H:i:s', strtotime($data->done_date)) : '(не завершено)';
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
                Хронология
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
                        'label' => 'Исполнитель',
                        'value' =>  function($data) {
                            return  User::getUserById($data->exe_user_id)->fullname;
                        }
                    ],
                    [
                        'label' => 'Получатель',
                        'value' =>  function($data) {
                            return  User::getUserById($data->rec_user_id)->fullname;
                        }
                    ],
                    [
                        'label' => 'Описание',
                        'value' =>  function($data) {
                            return $data->info;
                        }
                    ],
                    [
                        'label' => 'Документ',
                        'value' => function($data)
                        {
                            return Html::a('Загрузить',  Url::to('/uploads/' . $data->file), [ ($data->file) ? '' : 'class' => 'btn  disabled']);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'label' => 'Создан',
                        'value' =>  function($data) {
                            date_default_timezone_set('Asia/Tashkent');
                            return date('d M Y H:i:s',$data->created_at);
                        }
                    ],

                ],
            ]); ?>
        </div>
        <!-- /.card-body -->
    </div>

</div>
