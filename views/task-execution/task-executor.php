<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-executor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'info')->textarea(['rows' => 6]) ?>

    <div class="row">
        <div class="col-6">
            <?= $form->field($fileUpload, 'file')->fileInput() ?>
        </div>
        <?php if ($taskExecution->exe_user_id === Yii::$app->user->id):?>
            <div class="col-6">
                <label for="new_receive_user">Если вы хотите отправить задачу другому сотруднику</label>
                <?=Html::dropDownList('new_receive_user','',$users, ['prompt' => "Выберите сотрудник", 'class' => 'form-control'])?>
            </div>
        <?php endif;?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
