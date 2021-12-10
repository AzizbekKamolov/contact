<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaskExecution */

$this->title = 'Create Task Execution';
$this->params['breadcrumbs'][] = ['label' => 'Task Executions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-execution-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tasks' => $tasks,
        'users' => $users
    ]) ?>

</div>
