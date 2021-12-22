<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ContractExecution */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contract-execution-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'contract_id')->dropDownList($contracts) ?>

    <?= $form->field($model, 'exe_user_id')->dropDownList($users) ?>

    <?= $form->field($model, 'info')->textarea(['rows' => 6]) ?>


    <?= $form->field($model, 'receive_user')->dropDownList($users) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
