<?php

use kartik\money\MaskMoney;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Contract */
/* @var $form yii\widgets\ActiveForm */


if ($model->deadline) {
    $model->deadline = date('Y-m-d', strtotime($model->deadline));
}

?>

<div class="contract-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'project_id')->dropDownList($projects, ['prompt'=>'Выберите проект', 'options'=> [$project_id => ["Selected"=>true]]]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->widget(MaskMoney::classname(), [
        'name' => 'amount_german',
        'value' => 0,
        'pluginOptions' => [
            'prefix' => '¢ ',
            'thousands' => ' ',
            'decimal' => ',',
            'precision' => 0
        ],
    ]) ?>

    <?= $form->field($model, 'currency_id')->dropDownList($currencies) ?>

    <?= $form->field($model, 'deadline')->textInput(['type' => 'date']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
