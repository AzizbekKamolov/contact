<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\contact\models\SubCategory */

$this->title = 'Подкатегория';
$this->params['breadcrumbs'][] = ['label' => 'Подкатегория', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sub-category-view">
    <div class="card card-outline card-success">

       <div class="card-header">
           <h1 class="card-title text-bold">
               <?= Html::encode($this->title) ?>
               <?= ($this->checkRoute('update')) ? Html::a('<i class="fas fa-pen"></i>', ['update', 'id' => $model->id], ['class' => 'text-primary mx-2']) : "" ?>
               <?= ($this->checkRoute('delete')) ? Html::a('<i class="fas fa-times"></i>', ['delete', 'id' => $model->id], [
                   'class' => 'text-danger',
                   'title' => 'Удалить Подкатегория',
                   'data' => [
                       'confirm' => 'Вы уверены, что хотите удалить этот Подкатегория   ?',
                       'method' => 'post',
                   ],
               ]) : "" ?>
           </h1>
       </div>

        <div class="card-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'title',
                    [
                        'attribute' => 'category_id',
                        'value' => function($data){
                            return $data->category->title;
                        }
                    ],
                    'info:ntext',
                ],
            ]) ?>
        </div>
    </div>
</div>
