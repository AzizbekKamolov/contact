<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ContractExchange */

$this->title = 'Update Contract Exchange: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Contract Exchanges', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contract-exchange-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
