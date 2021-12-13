<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

?>

<div class="article-form">

    <?= DetailView::widget([
        'model' => $taskExchange,
        'attributes' => [
            'task_exe_id',
            'exe_user_id',
            'info:ntext',
            'created_at',
        ],
    ]) ?>

    <?= Html::a('Одобрить', ['task-approve', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Отказать', ['task-deny', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>

</div>
