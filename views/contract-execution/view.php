<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ContractExecution */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Contract Executions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="contract-execution-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if (Yii::$app->user->id === $model->receive_user):?>
            <?= Html::a('Check Contract', ['contract-check', 'id' => $model->id], ['class' => ($model->status_id !== 2) ? 'btn btn-success disabled' : 'btn btn-success']) ?>
        <?php else: ?>
            <?= Html::a('Execute Contract', ['contract-exe', 'id' => $model->id], ['class' => (($model->status_id === 2) || ($model->status_id === 4)) ? 'btn btn-success disabled' : 'btn btn-success']) ?>
        <?php endif; ?>
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
            'contract_id',
            'user_id',
            'exe_user_id',
//            'status_id',
            [
                'label' => 'status',
                'value' => function($data){
                    return \app\models\Status::findOne(['id' => $data->status_id])->title;
                },
            ],
            'info:ntext',
            'done_date',
            'mark',
            'receive_date',
            'receive_user',
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <h1>Contract Exchanges</h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'task_exe_id',
//            'exe_user_id',
//            'rec_user_id',
            'info:ntext',
            'file',
//            'created_at',
            'updated_at',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
