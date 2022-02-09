<?php

use app\models\Contract;
use app\models\Status;
use app\models\User;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContractExecutionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Исполнение контрактов';
$this->params['breadcrumbs'][] = $this->title;
$myRole = \app\models\User::getMyRole();
if($myRole === "admin" || $myRole === "superAdmin"){
    $template = '{view}{update}{delete}';
}
else {
    $template = '{view}';
}
?>
<div class="contract-execution-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= ($myRole !== "simpleUser") ? Html::a('Создать Исп контрактов', ['create'], ['class' => 'btn btn-success']) : "" ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel, 'users' => $users, 'statuses' =>  $statuses, 'contracts'     => $contracts]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'title',
            'contract_id' => [
                'attribute' => 'contract_id',
                'filter'    => $contracts,
                'value' =>  function($data) {
                    return Contract::getContrctById($data->contract_id)->title;
                }
            ],
            'user_id' => [
                'attribute' => 'user_id',
                'filter' => $users,
                'value' =>  function($data) {
                    return User::getUserById($data->user_id)->fullname;
                }
            ],
            'exe_user_id' => [
                'attribute' => 'exe_user_id',
                'filter' => $users,
                'value' =>  function($data) {
                    return User::getUserById($data->exe_user_id)->fullname;
                }
            ],
            'receive_user' => [
                'attribute' => 'receive_user',
                'filter' => $users,
                'value' =>  function($data) {
                    return User::getUserById($data->receive_user)->fullname;
                }
            ],
            'status_id' => [
                'attribute' => 'status_id',
                'filter' => $statuses,
                'value' =>  function($data) {
                    return Status::getStatusById($data->status_id)->title;
                },
                'contentOptions' => function($data) {
                    return ['class' => Status::getStatusColor($data->status_id)];
                }
            ],
            //'info:ntext',
            //'done_date',
            //'mark',
            //'receive_date',
            //'created_at',
            //'updated_at',
//            [
//                'label' => 'Название',
//                'value' =>  function($data) {
//                    return $data->title;
//                }
//            ],
//            [
//                'label' => 'Контракт',
//                'value' =>  function($data) {
//                    return \app\models\Contract::find()->where(['id' => $data->contract_id])->one()->title;
//                }
//            ],
//            [
//                'label' => 'Создатель',
//                'value' =>  function($data) {
//                    return \app\models\User::find()->where(['id' => $data->user_id])->one()->username;
//                }
//            ],
//            [
//                'label' => 'Исполнитель',
//                'value' =>  function($data) {
//                    return \app\models\User::find()->where(['id' => $data->exe_user_id])->one()->username;
//                }
//            ],
//            [
//                'label' => 'Статус',
//                'value' =>  function($data) {
//                    return \app\models\Status::find()->where(['id' => $data->status_id])->one()->title;
//                }
//            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template'  => $template
            ],
        ],
    ]); ?>


</div>
