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

    <?= $form->field($model, 'task_id')->dropDownList($tasks, ['prompt' => 'Выберите задачу', 'options'=> [$task_id => ["Selected"=>true]]]) ?>


    <?= $form->field($model, 'exe_user_id')->dropDownList($users, ['prompt' => 'Выберите исполнитель']) ?>

    <?php // $form->field($model, 'info')->textarea(['rows' => 6]) ?>


    <?php // $form->field($model, 'receive_date')->textInput() ?>

    <?= $form->field($model, 'receive_user')->dropDownList($users, ['prompt' => 'Выберите получатель']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
