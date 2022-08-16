<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\contact\models\AdditionalField */

$this->title = 'Создать дополнительное поле';
$this->params['breadcrumbs'][] = ['label' => 'Дополнительные поля', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="additional-field-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
