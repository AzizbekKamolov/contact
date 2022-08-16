<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\contact\models\Category */

$this->title = 'Категория';
$this->params['breadcrumbs'][] = ['label' => 'Категория', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="category-view">
    <div class="card card-outline card-success">

       <div class="card-header">

           <h1 class="card-title text-bold">
               <?= Html::encode($this->title) ?>
               <?= ($this->checkRoute('update')) ? Html::a('<i class="fas fa-pen"></i>', ['update', 'id' => $model->id], ['class' => 'text-primary mx-2']) : "" ?>
               <?= ($this->checkRoute('delete')) ? Html::a('<i class="fas fa-times"></i>', ['delete', 'id' => $model->id], [
                   'class' => 'text-danger',
                   'title' => 'Удалить Категория',
                   'data' => [
                       'confirm' => 'Вы уверены, что хотите удалить этот Категория?',
                       'method' => 'post',
                   ],
               ]) : "" ?>
           </h1>
           <div class="card-tools">
               <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
               </button>
           </div>
       </div>
        <div class="card-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'title',
                    'info:ntext',
                ],
            ]) ?>
        </div>

    </div>
</div>
