<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Проекты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
//            'title',
//            'description:ntext',
//            'budget_sum',
//            'project_year',
//            'user_id',
//            'status_id',
//            'deadline',
//            'created_at',
//            'updated_at',
            [
                    'label' => 'Название',
                    'value' =>  function($data) {
                        return $data->title;
                    }
            ],
            [
                    'label' => 'Описание',
                    'value' =>  function($data) {
                        return $data->description;
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
                    return \app\models\User::find()->where(['id' => $data->user_id])->one()->username;
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
            [
                'label' => 'Создан',
                'value' =>  function($data) {
                    date_default_timezone_set('Asia/Tashkent');
                    return date('d M Y H:i:s',$data->created_at);
                }
            ],
        ],
    ]) ?>

    <br>
    <h1>Контракты <?= $model->title?></h1>
    <br>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'project_id',
//            'title',
//            'description:ntext',
//            'price',
            //'user_id',
            //'file_url:url',
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
                'label' => 'Описание',
                'value' =>  function($data) {
                    return $data->description;
                }
            ],
            [
                'label' => 'Цена',
                'value' =>  function($data) {
                    return $data->price;
                }
            ],
            [
                'label' => 'Статус',
                'value' =>  function($data) {
                    return \app\models\Status::find(['id' => $data->status_id])->one()->title;
                }
            ],
            [
                    'header' => 'Меню',
                    'format' => 'raw',
                    'value' => function($data){
                        return Html::a('Перейти', ['contract/view', 'id'=>$data->id]);
                    }
            ],
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <br>
    <h1>Задачи <?= $model->title?></h1>
    <br>

    <?= GridView::widget([
        'dataProvider' => $dataProviderTask,
//        'filterModel' => $searchModelTask,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//
//            'id',
//            'project_id',
//            'title:ntext',
//            'price',
//            'deadline',
            //'user_id',
            //'status_id',
            //'created_at',
            //'updated_at',

            [
                'label' => 'Название',
                'value' =>  function($data) {
                    return $data->title;
                }
            ],
            [
                'label' => 'Цена',
                'value' =>  function($data) {
                    return $data->price;
                }
            ],
            [
                'label' => 'Срок',
                'value' =>  function($data) {
                    return $data->deadline;
                }
            ],
            [
                'label' => 'Статус',
                'value' =>  function($data) {
                    return \app\models\Status::find(['id' => $data->status_id])->one()->title;
                }
            ],
            [
                'header' => 'Меню',
                'format' => 'raw',
                'value' => function($data){
                    return Html::a('Перейти', ['task/view', 'id'=>$data->id]);
                }
            ],

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
