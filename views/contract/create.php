<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Contract */

$this->title = 'Создать Контракт';
$this->params['breadcrumbs'][] = ['label' => 'Контракты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'         => $model,
        'projects'      => $projects,
        'project_id'    => $project_id,
        'currencies'    => $currencies,
        'conExeModel'   => $conExeModel,
        'users'         => $users
    ]) ?>

</div>
