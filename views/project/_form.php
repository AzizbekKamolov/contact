<?php

use kartik\money\MaskMoney;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?=
        $form->field($model, 'budget_sum')->widget(MaskMoney::classname(), [
            'name' => 'amount_german',
            'value' => 0,
            'pluginOptions' => [
                'prefix' => '| ',
                'thousands' => ' ',
                'decimal' => ',',
                'precision' => 0,
            ],
        ]);
    ?>

    <?php // $form->field($model, 'currency_id')->dropDownList($currencies, ['prompt'=>'Выберите валюту']) ?>

    <?= $form->field($model, 'project_year')->textInput(['type'=>'date']) ?>

    <?= $form->field($model, 'user_id')->dropDownList($users, ['prompt' => 'Выберите ответственный']) ?>

    <?php // $form->field($model, 'status_id')->textInput() ?>

    <?= $form->field($model, 'deadline')->textInput(['type' => 'datetime-local']) ?>

   <?php // $form->field($model, 'created_at')->textInput() ?>

    <?php // $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
