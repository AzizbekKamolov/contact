<?php

use app\models\User;
use kartik\money\MaskMoney;
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
        <?php if ($contractExecution->exe_user_id === Yii::$app->user->id):?>
            <div class="col-6">
                <label for="new_receive_user">Если вы хотите отправить контракт другому сотруднику</label>
                <?=Html::dropDownList('new_receive_user','',$users, ['prompt' => "Выберите сотрудник", 'class' => 'form-control'])?>
            </div>
        <?php endif;?>

        <?php if (User::getMyRole() === "accountant"):?>
            <div class="col-6">
                <input type="checkbox" id="pay" value="">
                <label for="pay">Вы хотите оплатить по этому контракту</label>
                <div class="info_area">
                    <?=
                        $form->field($expenseModel, 'sum')->widget(MaskMoney::classname(), [
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
                    <?php if ($currency_id !== 1): ?>
                        <?=
                            $form->field($expenseModel, 'rate')->widget(MaskMoney::classname(), [
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
                    <?php endif;?>
                </div>

            </div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<style>

    .info_area {
        display:none;
    }

    input[type="checkbox"]:checked ~ .info_area {
        display: block;
    }

</style>
