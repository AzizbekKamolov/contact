<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TaskExecutionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-execution-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'task_id')->dropDownList($tasks) ?>

    <?php // $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'exe_user_id')->dropDownList($users) ?>

    <?= $form->field($model, 'status_id')->dropDownList($statuses) ?>

    <?php // echo $form->field($model, 'info') ?>

    <?php // echo $form->field($model, 'done_date') ?>

    <?php // echo $form->field($model, 'mark') ?>

    <?php // echo $form->field($model, 'receive_date') ?>

    <?php // echo $form->field($model, 'receive_user') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php // Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
