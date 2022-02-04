<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
<div class="row">
    <?php // $form->field($model, 'id') ?>

    <div class="col-3"> <?= $form->field($model, 'title') ?> </div>

    <?php // $form->field($model, 'description') ?>

    <div class="col-3"><?= $form->field($model, 'budget_sum') ?></div>

    <?php // $form->field($model, 'project_year') ?>

    <div class="col-3"><?php  echo $form->field($model, 'user_id')->dropDownList($users) ?></div>

    <div class="col-3"><?php  echo $form->field($model, 'status_id')->dropDownList($statuses) ?></div>

    <?php // echo $form->field($model, 'deadline') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group col-3">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php // Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>

</div>
