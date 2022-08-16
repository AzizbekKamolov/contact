<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\contact\models\ViewToPermission */

$this->title = 'Update View To Permission: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'View To Permissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="view-to-permission-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
