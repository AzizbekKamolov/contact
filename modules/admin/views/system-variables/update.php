<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SystemVariables */

$this->title = 'Update System Variables: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'System Variables', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="system-variables-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
