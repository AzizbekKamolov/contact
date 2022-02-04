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

    <?= $form->field($model, 'contract_id')->dropDownList($contracts, ['prompt'=>'Выберите контракт', 'options'=> [$contract_id => ["Selected"=>true]]]) ?>

    <?= $form->field($model, 'exe_user_id')->dropDownList($users, ['prompt' => 'Выберите исполнитель']) ?>

    <?= $form->field($model, 'info')->textarea(['rows' => 6]) ?>


    <?= $form->field($model, 'receive_user')->dropDownList($users, ['prompt' => 'Выберите получатель']) ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
