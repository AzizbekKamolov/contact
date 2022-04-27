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

    <div class="card card-outline card-success">
        <div class="card-header">
            <h1 class="card-title text-bold">
                <?= Html::encode($this->title) ?>
                <?= ($myRole !== "simpleUser") ? Html::a('+', ['create'], ['class' => 'btn btn-info ml-2', 'title' => 'Создать Исп контракто']) : "" ?>
            </h1>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
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
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => $template,
                        'buttons' => [
                            'view' => function($url, $model, $key) {
                                $i = '<i class="fas fa-eye"></i>';
                                return Html::a($i, ['contract-execution/view', 'id' => $model['id']],[]);
                            },
                            'update' => function($url, $model, $key) {
                                $i = '<i class="fas fa-pen"></i>';
                                return Html::a($i, ['contract-execution/update', 'id' => $model['id']],[]);
                            },
                            'delete' => function($url, $model, $key) {
                                $i = '<i class="fas fa-trash"></i>';
                                return Html::a($i, ['contract-execution/delete', 'id' => $model['id']],[]);
                            },
                        ],
                    ],
                ],
            ]); ?>
        </div>
        <!-- /.card-body -->
    </div>

</div>
