<?php

use app\models\SystemVariables;
use kartik\datetime\DateTimePicker;
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
            'prefix' => '| ',
            'thousands' => ' ',
            'decimal' => ',',
            'precision' => 0
        ],
    ]) ?>

    <?= $form->field($model, 'currency_id')->dropDownList($currencies) ?>

    <?php
        $interval = SystemVariables::findOne(['key' => 'contract_deadline'])->value;
        $deadline_changeable = SystemVariables::findOne(['key' => 'deadline_changeable'])->value;

        echo '<label class="control-label">Срок</label>';
        if ($deadline_changeable === '1') {
            echo DateTimePicker::widget([
                'name' => 'deadline',
                'value' => date('Y-m-d H:i:s', strtotime('+' . $interval . ' days')),
                'pluginOptions' => [
                    'calendarWeeks' => true,
                    'daysOfWeekDisabled' => [0, 6],
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd hh:ii:ss'
                ]
            ]);
        } else {
            echo DateTimePicker::widget([
                'name' => 'deadline',
                'value' => date('d/m/Y H:i:s', strtotime('+' . $interval . ' days')),
                'disabled' => true,
            ]);
        }
    ?>
    <br>
    <?= $form->field($conExeModel, 'exe_user_id')->dropDownList($users, ['prompt' => 'Выберите исполнитель']) ?>

    <div class="my-2 form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
