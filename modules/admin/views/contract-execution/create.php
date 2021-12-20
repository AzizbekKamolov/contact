<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ContractExecution */

$this->title = 'Create Contract Execution';
$this->params['breadcrumbs'][] = ['label' => 'Contract Executions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-execution-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'users' =>  $users,
        'contracts' =>  $contracts
    ]) ?>

</div>
