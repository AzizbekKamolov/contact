<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-mark-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mark')->dropDownList($marks) ?>
    <?= $form->field($model, 'info')->textarea() ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
