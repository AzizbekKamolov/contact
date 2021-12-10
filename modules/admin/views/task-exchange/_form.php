<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TaskExchange */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-exchange-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'task_exe_id')->textInput() ?>

    <?= $form->field($model, 'exe_user_id')->textInput() ?>

    <?= $form->field($model, 'rec_user_id')->textInput() ?>

    <?= $form->field($model, 'status_id')->textInput() ?>

    <?= $form->field($model, 'info_executor')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'info_receiver')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
