<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\Login */

$this->registerAssetBundle('app\assets\LoginAsset');
$this->title = Yii::t('rbac-admin', 'Login');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-page">
    <div class="login-box">


        <div class="card card-outline card-success">
            <div class="card-header text-center">
                <img src="<?= Yii::getAlias('@web') . '/img/logo_ru.png'?>" alt="Logo" style="width: 100%">
            </div>
            <div class="card-body login-card-body">
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'username', [
                    'options' => [
                        'tag' => 'div',
                        'class' => 'input-group mb-3 has-feedback'
                    ],
                    'template' => '{input}<div class="input-group-append">
                                    <div class="input-group-text">
                                      <span class="fas fa-user"></span>
                                    </div>
                                  </div>
                                  {error}{hint}'
                ])->input('text', [
                    'placeholder' => 'Username...',
//                    'class' => 'form-control custom-form',
                    'autofocus' => true,
                ])->label(false) ?>
                <?= $form->field($model, 'password', [
                    'options' => [
                        'tag' => 'div',
                        'class' => 'input-group mb-5 has-feedback'
                    ],
                    'template' => '{input}<div class="input-group-append">
                                    <div class="input-group-text">
                                      <span class="fas fa-lock"></span>
                                    </div>
                                  </div>
                                  {error}{hint}'
                ])->passwordInput()->input('password',
                    [
                        'placeholder' => 'Password...',
//                        'class' => 'form-control custom-form'
                    ])->label(false) ?>
                <div class="row">
                    <?= $form->field($model, 'rememberMe',[
                        'options' => [
                            'tag' => 'div',
                            'class' => 'col-6'
                        ]
                    ])->checkbox() ?>
                    <div class="col-6">
                        <?= Html::submitButton(Yii::t('rbac-admin', 'Login'), ['class' => 'btn btn-primary px-5', 'name' => 'login-button']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
</div>
