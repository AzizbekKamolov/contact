<?php

use app\modules\contact\models\Subcategory;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\contact\models\Main */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="main-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-4">
            <?= $form->field($model, 'prefix')->textInput(['maxlength' => true, 'class' => 'form-control ']) ?>
        </div>
        <div class="col-4">
            <?= $form->field($model, 'firstname')->textInput(['maxlength' => true, 'class' => 'form-control ']) ?>
        </div>
        <div class="col-4">
            <?= $form->field($model, 'lastname')->textInput(['maxlength' => true, 'class' => 'form-control col-12']) ?>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="col-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'class' => 'form-control ']) ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'company')->textInput(['maxlength' => true, 'class' => 'form-control ']) ?>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-4">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'class' => 'form-control ']) ?>
        </div>
        <div class="col-4">
            <?= $form->field($model, 'cellphone')->textInput(['maxlength' => true, 'class' => 'form-control ']) ?>
        </div>
        <div class="col-4">
            <?= $form->field($model, 'phone2')->textInput(['maxlength' => true, 'class' => 'form-control ']) ?>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-6">
            <?= $form->field($model, 'address1')->textarea(['rows' => 3, 'class' => 'form-control ']) ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'address2')->textarea(['rows' => 3, 'class' => 'form-control ']) ?>
        </div>
    </div>


    <div class="row">
        <div class="col-6">
            <?= $form->field($model, 'po_box')->textInput(['maxlength' => true, 'class' => 'form-control ']) ?>
        </div>

        <div class="col-6">
            <?= $form->field($model, 'zip_code')->textInput(['maxlength' => true, 'class' => 'form-control ']) ?>
        </div>


    </div>

    <br>

    <div class="row">
        <div class="col-6">
            <?= $form->field($model, 'country')->textInput(['maxlength' => true, 'class' => 'form-control ']) ?>
        </div>

        <div class="col-6">
            <?= $form->field($model, 'city')->textInput(['maxlength' => true, 'class' => 'form-control ']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-6">

        <?= $form->field($model, 'language')->textInput(['maxlength' => true, 'class' => 'form-control ']) ?>
        </div>
        <div class="col-6">

            <?= $form->field($model, 'owner_id')->textInput(['value' => Yii::$app->user->identity->id, 'readonly' => true]) ?>
        </div>

    </div>
    <br>

    <br>

    <div class="row">
        <div class="col-6">
            <?= $form->field($model, 'category')->dropDownList(\yii\helpers\ArrayHelper::map(app\modules\contact\models\Category::find()->all(), 'id', 'title'), [
                'class' => 'form-control ', 'id' => 'category', 'prompt' => 'Выберите категорию..']) ?>

        </div>
        <div class="col-6">
            <?php
            echo $form->field($model, 'subcategory')->dropDownList(\yii\helpers\ArrayHelper::map([$model->getSubCategoryById($model->subcategory)], 'id', 'title'), [
                'class' => 'form-control ', 'id' => 'subcategory', 'prompt' => 'Выберите подкатегорию..'])
            ?>
        </div>


    </div>

    <br>


    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>

    <?php ActiveForm::end(); ?>

</div>


<?php
$script = <<<JS
        
        $(document).ready(function() {
          $('#category').on('change',function (){
          let category = this.value;
          $.ajax({
          url: '/contact/main/choose',
          type: 'POST',
          data: {category: category},
          success: function (data){
              // var data1 = JSON.parse(data);
              // console.log(data);
             
              $("select#subcategory").html(data);
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















