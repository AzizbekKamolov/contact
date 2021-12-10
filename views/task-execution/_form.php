<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TaskExecution */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-execution-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'task_id')->dropDownList($tasks) ?>

<!--    --><?//= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'exe_user_id')->dropDownList($users) ?>

<!--    --><?//= $form->field($model, 'status_id')->textInput() ?>

    <?= $form->field($model, 'info')->textarea(['rows' => 6]) ?>

<!--    --><?//= $form->field($model, 'done_date')->textInput() ?>

<!--    --><?//= $form->field($model, 'mark')->textInput() ?>

<!--    --><?//= $form->field($model, 'receive_date')->textInput() ?>

<!--    --><?//= $form->field($model, 'receive_user')->textInput() ?>

<!--    --><?//= $form->field($model, 'created_at')->textInput() ?>

<!--    --><?//= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
