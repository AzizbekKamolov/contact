<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContractSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Контракты';
$this->params['breadcrumbs'][] = $this->title;
$myRole = \app\models\User::getMyRole();
if($myRole=="admin" || $myRole === "superAdmin"){
    $template = '{view}{update}{delete}';
}
else{
    $template = '{view}';
}
?>
<div class="contract-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= ($myRole !== "simpleUser") ? Html::a('Создать Контракт', ['create'], ['class' => 'btn btn-success']) : "" ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel, 'users' => $users, 'statuses' =>  $statuses]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'project_id',
            'title',
//            'description:ntext',
            'price' => [
                'attribute' => 'price',
                'value' =>  function($data) {
                    return number_format($data->price, 2) . ' ' . \app\models\Currency::find()->where(['id' => $data->currency_id])->one()->short_name;
                }
            ],
            'user_id' => [
                'attribute' => 'user_id',
                'filter' => $users,
                'value' =>  function($data) {
                    return \app\models\User::find()->where(['id' => $data->user_id])->one()->username;
                }
            ],
            //'file_url:url',
            'status_id' => [
                'attribute' => 'status_id',
                'filter'    => $statuses,
                'value' =>  function($data) {
                    return \app\models\Status::find(['id' => $data->status_id])->one()->title;
                }
            ],
            'deadline' => [
                'attribute' => 'deadline',
                'value' =>  function($data) {
                    return date('d-m-Y', strtotime($data->deadline));
//                    return $data->deadline;
                }
            ],
            //'created_at',
            //'updated_at',
//            [
//                'label' => 'Название',
//                'value' =>  function($data) {
//                    return $data->title;
//                }
//            ],
//            [
//                'label' => 'Цена',
//                'value' =>  function($data) {
//                    return $data->price;
//                }
//            ],
//            [
//                'label' => 'Создатель',
//                'value' =>  function($data) {
//                    return \app\models\User::find()->where(['id' => $data->user_id])->one()->username;
//                }
//            ],
//            [
//                'label' => 'Статус',
//                'value' =>  function($data) {
//                    return \app\models\Status::find(['id' => $data->status_id])->one()->title;
//                }
//            ],
//            [
//                'label' => 'Срок',
//                'value' =>  function($data) {
//                    return $data->deadline;
//                }
//            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => $template,
            ],
        ],
    ]); ?>


</div>
