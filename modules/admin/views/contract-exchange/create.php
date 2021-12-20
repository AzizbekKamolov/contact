<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ContractExchange */

$this->title = 'Create Contract Exchange';
$this->params['breadcrumbs'][] = ['label' => 'Contract Exchanges', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-exchange-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
