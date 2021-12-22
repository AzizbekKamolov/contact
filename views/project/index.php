<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Проекты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать Проект', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'title',
//            'description:ntext',
//            'budget_sum',
//            'project_year',
            //'user_id',
            //'status_id',
            //'deadline',
            //'created_at',
            //'updated_at',
            [
                'label' => 'Название',
                'value' =>  function($data) {
                    return $data->title;
                }
            ],
            [
                'label' => 'Бюджет',
                'value' =>  function($data) {
                    return $data->budget_sum;
                }
            ],
            [
                'label' => 'Дата проекта',
                'value' =>  function($data) {
                    return $data->project_year;
                }
            ],
            [
                'label' => 'Создатель',
                'value' =>  function($data) {
//                    var_dump(\app\models\User::find()->where(['id' => $data->user_id])->one()->username);die();
                    return \app\models\User::find()->where(['id' => $data->user_id])->one()->username;
//                    return $data->user_id;
                }
            ],
            [
                'label' => 'Статус',
                'value' =>  function($data) {
                    return \app\models\Status::find(['id' => $data->status_id])->one()->title;
                }
            ],
            [
                'label' => 'Срок',
                'value' =>  function($data) {
                    return $data->deadline;
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
