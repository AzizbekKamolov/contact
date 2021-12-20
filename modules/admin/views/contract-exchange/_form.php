<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ContractExchange */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contract-exchange-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'con_exe_id')->textInput() ?>

    <?= $form->field($model, 'exe_user_id')->textInput() ?>

    <?= $form->field($model, 'rec_user_id')->textInput() ?>

    <?= $form->field($model, 'info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'file')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
