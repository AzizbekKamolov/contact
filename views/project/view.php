<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
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
            'title',
            'description:ntext',
            'budget_sum',
            'project_year',
            'user_id',
            'status_id',
            'deadline',
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <h1>Contracts</h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'project_id',
            'title',
            'description:ntext',
            'price',
            //'user_id',
            //'file_url:url',
            //'status_id',
            //'deadline',
            //'created_at',
            //'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',

            ],
        ],
    ]); ?>

    <h1>Tasks</h1>

    <?= GridView::widget([
        'dataProvider' => $dataProviderTask,
        'filterModel' => $searchModelTask,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'project_id',
            'title:ntext',
            'price',
            'deadline',
            //'user_id',
            //'status_id',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
