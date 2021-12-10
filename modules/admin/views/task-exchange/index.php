<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaskExchangeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Task Exchanges';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-exchange-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Task Exchange', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'task_exe_id',
            'exe_user_id',
            'rec_user_id',
            'status_id',
            //'info_executor:ntext',
            //'info_receiver:ntext',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
