<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ContractExecution */

$this->title = 'Update Contract Execution: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Contract Executions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contract-execution-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'users' =>  $users,
        'contracts' =>  $contracts
    ]) ?>

</div>
