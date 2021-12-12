<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TaskExecution */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Task Executions', 'url' => ['index']];
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
            'title',
            'task_id',
            'user_id',
            'exe_user_id',
            [
                'label' => 'status',
                'value' => function($data){
                    return \app\models\Status::findOne(['id' => $data->status_id])->title;
                },
            ],
//            'status_id',
            'info:ntext',
            'done_date',
            'mark',
            'receive_date',
            'receive_user',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
