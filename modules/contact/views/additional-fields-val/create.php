<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\contact\models\AdditionalFieldsValue */

$this->title = 'Создать дополнительные поля Значение';
$this->params['breadcrumbs'][] = ['label' => 'Дополнительные значения полей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="additional-fields-value-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
