<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContractExecutionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Исполнение контрактов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-execution-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать Исп контрактов', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'title',
//            'contract_id',
//            'user_id',
//            'exe_user_id',
//            'status_id',
            //'info:ntext',
            //'done_date',
            //'mark',
            //'receive_date',
            //'receive_user',
            //'created_at',
            //'updated_at',
            [
                'label' => 'Название',
                'value' =>  function($data) {
                    return $data->title;
                }
            ],
            [
                'label' => 'Контракт',
                'value' =>  function($data) {
                    return \app\models\Contract::find()->where(['id' => $data->contract_id])->one()->title;
                }
            ],
            [
                'label' => 'Создатель',
                'value' =>  function($data) {
                    return \app\models\User::find()->where(['id' => $data->user_id])->one()->username;
                }
            ],
            [
                'label' => 'Исполнитель',
                'value' =>  function($data) {
                    return \app\models\User::find()->where(['id' => $data->exe_user_id])->one()->username;
                }
            ],
            [
                'label' => 'Статус',
                'value' =>  function($data) {
                    return \app\models\Status::find()->where(['id' => $data->status_id])->one()->title;
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
