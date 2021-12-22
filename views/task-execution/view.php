<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TaskExecution */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Выполнение задач', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="task-execution-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if (Yii::$app->user->id === $model->receive_user):?>
            <?= Html::a('Check task', ['task-check', 'id' => $model->id], ['class' => ($model->status_id !== 2) ? 'btn btn-success disabled' : 'btn btn-success']) ?>
        <?php else: ?>
            <?= Html::a('Execute task', ['task-exe', 'id' => $model->id], ['class' => (($model->status_id === 2) || ($model->status_id === 4)) ? 'btn btn-success disabled' : 'btn btn-success']) ?>
        <?php endif; ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
//            'title',
//            'task_id',
//            'user_id',
//            'exe_user_id',
//            'status_id',
//            'info:ntext',
//            'done_date',
//            'mark',
//            'receive_date',
//            'receive_user',
//            'created_at',
//            'updated_at',
            [
                'label' => 'Название',
                'value' =>  function($data) {
                    return $data->title;
                }
            ],
            [
                'label' => 'Задача',
                'value' =>  function($data) {
                    return \app\models\Task::find()->where(['id' => $data->task_id])->one()->title;
                }
            ],[
                'label' => 'Создатель',
                'value' =>  function($data) {
                    return \app\models\User::find()->where(['id' => $data->user_id])->one()->username;
                }
            ],[
                'label' => 'Исполнитель',
                'value' =>  function($data) {
                    return \app\models\User::find()->where(['id' => $data->exe_user_id])->one()->username;
                }
            ],
            [
                'label' => 'Статус',
                'value' =>  function($data) {
                    return \app\models\Status::find()->where(['id' => $data->status_id])->one()->title;
                }
            ],
            [
                'label' => 'Описание',
                'value' =>  function($data) {
                    return $data->info;
                }
            ],
            [
                'label' => 'Дата завершения',
                'value' =>  function($data) {
                    return $data->done_date;
                }
            ],
            [
                'label' => 'Оценка',
                'value' =>  function($data) {
                    return $data->mark;
                }
            ],
            [
                'label' => 'Дата получения',
                'value' =>  function($data) {
                    return $data->receive_date;
                }
            ],
            [
                'label' => 'Получатель',
                'value' =>  function($data) {
                    return \app\models\User::find()->where(['id' => $data->receive_user])->one()->username;
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
    <h1>Обмены задачами</h1>
    <br>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'task_exe_id',
//            'exe_user_id',
//            'rec_user_id',
//            'info:ntext',
//            'created_at',
//            'updated_at',
            [
                'label' => 'Исполнитель',
                'value' =>  function($data) {
                    return \app\models\User::find()->where(['id' => $data->exe_user_id])->one()->username;
                }
            ],
            [
                'label' => 'Получатель',
                'value' =>  function($data) {
                    return \app\models\User::find()->where(['id' => $data->rec_user_id])->one()->username;
                }
            ],
            [
                'label' => 'Описание',
                'value' =>  function($data) {
                    return $data->info;
                }
            ],
            [
                'label' => 'Создан',
                'value' =>  function($data) {
                    date_default_timezone_set('Asia/Tashkent');
                    return date('d M Y H:i:s',$data->created_at);
                }
            ],

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
