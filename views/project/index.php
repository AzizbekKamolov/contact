<?php

use app\models\Currency;
use app\models\Status;
use app\models\User;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Проекты';
$this->params['breadcrumbs'][] = $this->title;
$myRole = \app\models\User::getMyRole();

if($myRole=="admin" || $myRole === "superAdmin"){
    $template = '{view}{update}{delete}';
}
else{
    $template = '{view}';
}
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= ($myRole === "admin" || $myRole === "superAdmin") ? Html::a('Создать Проект', ['create'], ['class' => 'btn btn-success']) : "" ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel, 'users' => $users, 'statuses' => $statuses]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'title',
//            'description:ntext',
            'budget_sum' => [
                'attribute' => 'budget_sum',
                'value' =>  function($data) {
                    return number_format($data->budget_sum, 2) . ' ' . Currency::getCurrencyById($data->currency_id)->short_name;
                }

            ],
//            'project_year',
            'user_id'=>[
                'attribute'=>'user_id',
                'filter'=>$users,
                'value' =>  function($data) {
                    return User::getUserById($data->user_id)->fullname;
                }
            ],
            'status_id'=>[
                'attribute'=>'status_id',
                'filter'=>$statuses,
                'value' =>  function($data) {
                    return Status::getStatusById($data->status_id)->title;
                },
                'contentOptions' => function($data) {
                    return ['class' => Status::getStatusColor($data->status_id)];
                }
            ],
            //'deadline',
            //'created_at',
            //'updated_at',
//            [
//                'label' => 'Название',
//                'value' =>  function($data) {
//                    return $data->title;
//                }
//            ],
//            [
//                'label' => 'Бюджет',
//                'value' =>  function($data) {
//                    return number_format($data->budget_sum, 2) . ' ' . \app\models\Currency::find()->where(['id' => $data->currency_id])->one()->short_name;
//                }
//            ],
//            [
//                'label' => 'Ответственный',
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
                'template' => $template
            ],
        ],
    ]); ?>


</div>
