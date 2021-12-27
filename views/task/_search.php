<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TaskSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // $form->field($model, 'id') ?>

    <?= $form->field($model, 'project_id')->dropDownList($projects) ?>

    <?= $form->field($model, 'title') ?>

    <?php // $form->field($model, 'price') ?>

    <?= $form->field($model, 'deadline')->textInput(['type' => 'date']) ?>

    <?php echo $form->field($model, 'user_id')->dropDownList($users) ?>

    <?php  echo $form->field($model, 'status_id')->dropDownList($statuses) ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php // Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
