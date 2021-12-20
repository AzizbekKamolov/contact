<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContractExecutionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contract Executions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-execution-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Contract Execution', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'contract_id',
            'user_id',
            'exe_user_id',
            'status_id',
            //'info:ntext',
            //'done_date',
            //'mark',
            //'receive_date',
            //'receive_user',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
