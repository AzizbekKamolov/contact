<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ContractExecution */

$this->title = 'Создать исполнение контракта';
$this->params['breadcrumbs'][] = ['label' => 'Исполнение контрактов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-execution-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'users' =>  $users,
        'contracts' =>  $contracts,
        'contract_id' => $contract_id
    ]) ?>

</div>
