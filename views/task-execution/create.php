<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaskExecution */

$this->title = 'Создать выполнение задачи';
$this->params['breadcrumbs'][] = ['label' => 'Выполнение задач', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-execution-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tasks' => $tasks,
        'users' => $users,
        'task_id' => $task_id
    ]) ?>

</div>
