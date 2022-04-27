<?php

use app\models\Currency;
use app\models\Status;
use app\models\User;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContractSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Контракты';
$this->params['breadcrumbs'][] = $this->title;
$myRole = \app\models\User::getMyRole();
if($myRole === "superAdmin"){
    $template = '{view}{update}{delete}';
}
else{
    $template = '{view}';
}
?>
<div class="contract-index">

    <div class="card card-outline card-success">
        <div class="card-header">
            <h1 class="card-title text-bold">
                <?= Html::encode($this->title) ?>
                <?= ($myRole !== "simpleUser") ? Html::a('+', ['create'], ['class' => 'btn btn-info ml-2', 'title' => 'Создать Контракт']) : "" ?>
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
                    'price' => [
                        'attribute' => 'price',
                        'value' =>  function($data) {
                            return number_format($data->price, 2) . ' ' . Currency::getCurrencyById($data->currency_id)->short_name;
                        }
                    ],
                    'user_id' => [
                        'attribute' => 'user_id',
                        'filter' => $users,
                        'value' =>  function($data) {
                            return User::getUserById($data->user_id)->fullname;
                        },
//                        'contentOptions' => function() {
//                            return ['class' => 'select2bs4 select2-hidden-accessible'];
//                        },
                    ],
                    'status_id' => [
                        'attribute' => 'status_id',
                        'filter'    => $statuses,
                        'value' =>  function($data) {
                            return Status::getStatusById($data->status_id)->title;
                        },
                        'contentOptions' => function($data) {
                            return ['class' => Status::getStatusColor($data->status_id)];
                        }
                    ],
                    'deadline' => [
                        'attribute' => 'deadline',
                        'value' =>  function($data) {
                            return date('d M Y H:i:s', strtotime($data->deadline));
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => $template,
                    ],
                ],
            ]); ?>
        </div>
        <!-- /.card-body -->
    </div>

</div>
