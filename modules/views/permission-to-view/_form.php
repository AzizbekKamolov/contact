<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\contact\models\ViewToPermission */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="view-to-permission-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'main_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'main_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
