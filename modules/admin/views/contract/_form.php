<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Contract */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contract-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'project_id')->textInput() ?>
<!--    --><?//= Html::dropDownList($model, 'project_id', [], $projects, ['class' => 'form-control']) ?>
    <?= $form->field($model, 'project_id')->dropDownList($projects) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?/*= $form->field($model, 'user_id')->textInput() */?>

<!--    --><?//= $form->field($model, 'file_url')->fileInput() ?>

    <?/*= $form->field($model, 'status_id')->textInput() */?>

    <?= $form->field($model, 'deadline')->textInput(['type' => 'date']) ?>

    <?/*= $form->field($model, 'created_at')->textInput() */?><!--

    --><?/*= $form->field($model, 'updated_at')->textInput() */?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
