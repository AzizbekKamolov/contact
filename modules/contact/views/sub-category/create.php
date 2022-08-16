<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\contact\models\SubCategory */

$this->title = 'Создать подкатегорию';
$this->params['breadcrumbs'][] = ['label' => 'Подкатегории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
