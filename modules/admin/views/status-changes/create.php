<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StatusChanges */

$this->title = 'Create Status Changes';
$this->params['breadcrumbs'][] = ['label' => 'Status Changes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-changes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
