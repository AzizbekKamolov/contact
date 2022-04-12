<?php

use yii\helpers\Html;

?>
<?= $this->checkRoute("update") ? Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) : "" ?>
<?php if (Yii::$app->user->id === $model->receive_user):?>
    <?= Html::a('Check Contract', ['contract-check', 'id' => $model->id], ['class' => ($model->status_id !== 2) ? 'btn btn-success disabled' : 'btn btn-success']) ?>
<?php elseif(Yii::$app->user->id === $model->exe_user_id): ?>
    <?= Html::a('Execute Contract', ['contract-exe', 'id' => $model->id], ['class' => (($model->status_id === 2) || ($model->status_id === 4)) ? 'btn btn-success disabled' : 'btn btn-success']) ?>
<?php endif; ?>
<?= $this->checkRoute("delete") ? Html::a('Удалить', ['delete', 'id' => $model->id], [
    'class' => 'btn btn-danger',
    'data' => [
        'confirm' => 'Are you sure you want to delete this item?',
        'method' => 'post',
    ],
]) : "" ?>