<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\contact\models\AdditionalFieldsValue */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="additional-fields-value-form">

    <?php $form = ActiveForm::begin([
            'id' => 'upload-form'
    ]); ?>

    <?= $form->field($model, 'contact_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\modules\contact\models\Main::find()->all(), 'id', 'title'), ['prompt' => 'Select Main value ..']) ?>

    <?= $form->field($model, 'additional_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\modules\contact\models\AdditionalField::find()->all(), 'id', 'title' ), ['id' => 'additional', 'prompt' => 'Select Additional value ..']) ?>

    <?= $form->field($model, "value")->textInput(['maxlength' => true, 'id' => 'type', 'multiple' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput(['value' => date('Y-m-d H:i:s'), 'readonly' => true]) ?>

    <?php $form->field($model, 'created_by')->textInput(['value' => Yii::$app->user->id, 'type' => 'hidden']) ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
$script = <<<JS

        $(document).ready(function() {
          $('#additional').click(function (){
          let category = this.value;
          $.ajax({
          url: '/contact/additional-fields-val/choose',
          type: 'POST',
          data: {category: category},
          success: function (data){
              if (data === 'file'){
                      // console.log(data)
                  document.getElementById('type').type = data
                  document.getElementById('type').name = "AdditionalFieldsValue[value][]"
                  document.getElementById('upload-form').enctype = 'multipart/form-data';
              }else {
                  document.getElementById('type').type = 'text'
                  document.getElementById('type').name = "AdditionalFieldsValue[value]"
                  document.getElementById('upload-form').enctype = '';

              }
          },
          error: function(data) {
            console.log(data);
          }
          });
          });

        })
JS;
$this->registerJs($script);

?>


