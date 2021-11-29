<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\Login */

$this->registerAssetBundle('app\assets\CustomAsset');
$this->title = Yii::t('rbac-admin', 'Login');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">

    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto" style="background: white;border-radius: 13px;">
            <div class="fond-logo">
                <img src="<?= Yii::getAlias('@web') . '/img/logo.png'?>" alt="Logo">
            </div>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <?= $form->field($model, 'username')->input('text', ['placeholder' => 'Username...', 'class' => 'form-control custom-form'])->label(false) ?>
            <?= $form->field($model, 'password')->passwordInput()->input('password', ['placeholder' => 'Password...', 'class' => 'form-control custom-form'])->label(false) ?>
            <?= $form->field($model, 'rememberMe')->checkbox() ?>
<!--            <div style="color:#999;margin:1em 0">-->
<!--                If you forgot your password you can --><?//= Html::a('reset it', ['user/request-password-reset']) ?><!--.-->
<!--                For new user you can --><?//= Html::a('signup', ['site/signup']) ?><!--.-->
<!--            </div>-->
            <div class="form-group form-submit">
                <?= Html::submitButton(Yii::t('rbac-admin', 'Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
