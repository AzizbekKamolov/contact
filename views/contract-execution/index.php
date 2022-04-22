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
if($myRole === "superAdmin"){
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
                    return Contract::getContrctById($data['contract_id'])->title;
                }
            ],
            'user_id' => [
                'attribute' => 'user_id',
                'filter' => $users,
                'value' =>  function($data) {
                    return User::getUserById($data['user_id'])->fullname;
                }
            ],
            'exe_user_id' => [
                'attribute' => 'exe_user_id',
                'filter' => $users,
                'value' =>  function($data) {
                    return User::getUserById($data['exe_user_id'])->fullname;
                }
            ],
//            'receive_user' => [
//                'attribute' => 'receive_user',
//                'filter' => $users,
//                'value' =>  function($data) {
//                    return User::getUserById($data->receive_user)->fullname;
//                }
//            ],
            'status_id' => [
                'attribute' => 'status_id',
                'filter' => $statuses,
                'value' =>  function($data) {
                    return Status::getStatusById($data['status_id'])->title;
                },
                'contentOptions' => function($data) {
                    return ['class' => Status::getStatusColor($data['status_id'])];
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
//

            [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => $template,
                    'buttons' => [
                        'view' => function($url, $model, $key) {
                            $i = '<svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:1.125em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M573 241C518 136 411 64 288 64S58 136 3 241a32 32 0 000 30c55 105 162 177 285 177s230-72 285-177a32 32 0 000-30zM288 400a144 144 0 11144-144 144 144 0 01-144 144zm0-240a95 95 0 00-25 4 48 48 0 01-67 67 96 96 0 1092-71z"></path></svg>';
                            return Html::a($i, ['contract-execution/view', 'id' => $model['id']],[]);
                        },
                        'update' => function($url, $model, $key) {
                            $i = '<svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:1em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M498 142l-46 46c-5 5-13 5-17 0L324 77c-5-5-5-12 0-17l46-46c19-19 49-19 68 0l60 60c19 19 19 49 0 68zm-214-42L22 362 0 484c-3 16 12 30 28 28l122-22 262-262c5-5 5-13 0-17L301 100c-4-5-12-5-17 0zM124 340c-5-6-5-14 0-20l154-154c6-5 14-5 20 0s5 14 0 20L144 340c-6 5-14 5-20 0zm-36 84h48v36l-64 12-32-31 12-65h36v48z"></path></svg>';
                            return Html::a($i, ['contract-execution/update', 'id' => $model['id']],[]);
                        },
                        'delete' => function($url, $model, $key) {
                            $i = '<svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:.875em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M32 464a48 48 0 0048 48h288a48 48 0 0048-48V128H32zm272-256a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zM432 32H312l-9-19a24 24 0 00-22-13H167a24 24 0 00-22 13l-9 19H16A16 16 0 000 48v32a16 16 0 0016 16h416a16 16 0 0016-16V48a16 16 0 00-16-16z"></path></svg>';
                            return Html::a($i, ['contract-execution/delete', 'id' => $model['id']],[]);
                        },
                    ],
            ],
        ],
    ]); ?>


</div>
