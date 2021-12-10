<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaskExchange */

$this->title = 'Create Task Exchange';
$this->params['breadcrumbs'][] = ['label' => 'Task Exchanges', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-exchange-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
