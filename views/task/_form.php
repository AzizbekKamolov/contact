<?php

use kartik\money\MaskMoney;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Task */
/* @var $form yii\widgets\ActiveForm */
if ($model->deadline) {
    $model->deadline = date('Y-m-d', strtotime($model->deadline));
}
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_id')->dropDownList($projects, ['prompt'=>'Выберите проект', 'options'=> [$project_id => ["Selected"=>true]] ]) ?>

    <?= $form->field($model, 'title')->textarea(['rows' => 6]) ?>

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

    <?= $form->field($model, 'deadline')->textInput(['type' => 'datetime-local']) ?>

    <?php // $form->field($model, 'user_id')->textInput() ?>

    <?php // $form->field($model, 'status_id')->textInput() ?>

    <?php // $form->field($model, 'created_at')->textInput() ?>

    <?php // $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
