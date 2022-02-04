<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaskExecution */

$this->title = 'Обновить вып. задачи: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Выполнение задач', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="task-execution-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tasks' => $tasks,
        'users' =>  $users
    ]) ?>

</div>
