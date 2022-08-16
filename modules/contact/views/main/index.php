<?php

use app\models\User;
use app\modules\contact\models\Main;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\contact\models\MainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="main-index">
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
       <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   </div>
   <div class="card-body">
       <?= GridView::widget([
           'dataProvider' => $dataProvider,
           'filterModel' => $searchModel,
           'columns' => [
               ['class' => 'yii\grid\SerialColumn'],
//            'id',
//            'prefix',
               'firstname',
               'lastname',
//            'title',
               'company',
               'phone',
//            'cellphone',
//            'phone2',
//            'address1:ntext',
//            'address2:ntext',
//            'po_box',
//            'zip_code',
               'country',
//            'language',
//            'owner_id',
               [
                   'attribute' => 'category',
                   'value' => function ($data) {
                       return $data->subCategory->category->title;
                   },
               ],
               [
                   'attribute' => 'subcategory',
                   'content' => function ($data) {
                       return $data->subCategory->title;
                   },
               ],
               [
                   'class' => ActionColumn::className(),
                   'urlCreator' => function ($action, Main $model, $key, $index, $column) {
                       return Url::toRoute([$action, 'id' => $model->id]);
                   },
                   'template'=>'{view} {update} {delete}',
                   'visibleButtons' => [
                       'delete' => function($data) { return ($data->owner_id == Yii::$app->user->identity->id || User::getMyRole() == 'superAdmin'); },
                       'update' => function($data) { return ($data->owner_id == Yii::$app->user->identity->id || User::getMyRole() == 'superAdmin'); },
                   ]
               ],
           ],
       ]);
       ?>
   </div>

</div>
</div>