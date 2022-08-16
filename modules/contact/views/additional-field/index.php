<?php

use app\modules\contact\models\AdditionalField;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\contact\models\AdditionalFieldSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Дополнительные поля';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="additional-field-index">
    <div class="card card-outline card-success">

       <div class="card-header">
           <h1 class="card-title text-bold">
               <?= Html::encode($this->title) ?>
               <?= Html::a('+', ['create'], ['class' => 'btn btn-info ml-2']) ?>
           </h1>

           <div class="card-tools">
               <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
               </button>
           </div>

       </div>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

       <div class="card-body">
           <?= GridView::widget([
               'dataProvider' => $dataProvider,
               'filterModel' => $searchModel,
               'columns' => [
                   ['class' => 'yii\grid\SerialColumn'],

                   'id',
                   'title',
                   'type',
                   'multiple',
                   [
                       'class' => ActionColumn::className(),
                       'urlCreator' => function ($action, AdditionalField $model, $key, $index, $column) {
                           return Url::toRoute([$action, 'id' => $model->id]);
                       }
                   ],
               ],
           ]); ?>

       </div>

    </div>
</div>
