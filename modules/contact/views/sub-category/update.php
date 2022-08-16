<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\contact\models\SubCategory */

$this->title = 'Обновить подкатегорию: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Подкатегория', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновлять';
?>
<div class="sub-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
