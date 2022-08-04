<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StatusChangesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Status Changes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-changes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Status Changes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'object_type',
            'object_id',
            'status_id',
            'comment:ntext',
            //'user_id',
            //'created_at',
            //'updated_at',
            ['class' => 'yii\grid\ActionColumn']
        ],
    ]); ?>


</div>
