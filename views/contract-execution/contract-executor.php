<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contract-executor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'info')->textarea(['rows' => 6]) ?>

    <div class="row">
        <div class="col-6">
            <?= $form->field($fileUpload, 'file')->fileInput() ?>
        </div>
        <div class="col-6">
            <label for="new_receive_user">If you want to sent contract to another user </label>
            <?=Html::dropDownList('new_receive_user','',$users, ['prompt' => "Select a User", 'class' => 'form-control'])?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
