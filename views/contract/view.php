<?php

use app\models\Contract;
use app\models\Currency;
use app\models\Project;
use app\models\Status;
use app\models\User;
use kartik\select2\Select2;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this app\components\View */
/* @var $model app\models\Contract */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Контракты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$myRole = \app\models\User::getMyRole();
?>
<div class="contract-view">

    <div class="card card-outline card-success">
        <div class="card-header">
            <h1 class="card-title text-bold">
                <?= Html::encode($this->title) ?>
                <?= ($this->checkRoute('update')) ? Html::a('<i class="fas fa-pen"></i>', ['update', 'id' => $model->id], ['class' => 'text-primary mx-2', 'title' => 'Обнавить Контракт']) : "" ?>
                <?= ($this->checkRoute('delete')) ? Html::a('<i class="fas fa-times"></i>', ['delete', 'id' => $model->id], [
                    'class' => 'text-danger',
                    'title' => 'Удалить Контракт',
                    'data' => [
                        'confirm' => 'Вы уверены, что хотите удалить этот Контракт?',
                        'method' => 'post',
                    ],
                ]) : "" ?>
                <?= ($this->checkRoute('set-file')) ? Html::a('<i class="fas fa-plus"></i>', ['set-file', 'id' => $model->id], ['class' => 'text-success ml-2', 'title' => 'Загрузить файл']) : "" ?>
            </h1>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body" >
            <div class="row">
                <div class="col-6">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            [
                                'label' => 'Проект',
                                'value' =>  function($data) {
                                    return Project::getProjectById($data->project_id)->title;
                                }
                            ],
                            [
                                'label' => 'Название',
                                'value' =>  function($data) {
                                    return $data->title;
                                }
                            ],
                            [
                                'label' => 'Описание',
                                'value' =>  function($data) {
                                    return $data->description;
                                }
                            ],
                            [
                                'label' => 'Цена',
                                'value' =>  function($data) {
                                    return number_format($data->price, 2) . ' ' . Currency::getCurrencyById($data->currency_id)->short_name;
                                }
                            ],
                        ],
                    ]) ?>
                </div>
                <div class="col-6">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            [
                                'label' => 'Валюта',
                                'value' =>  function($data) {
                                    return Currency::getCurrencyById($data->currency_id)->name;
                                }
                            ],
                            [
                                'label' => 'Создатель',
                                'value' =>  function($data) {
                                    return User::getUserById($data->user_id)->fullname;
                                }
                            ],
                            [
                                'label' => 'Документ',
                                'value' => function($data)
                                {
                                    return Html::a('Загрузить',  '../uploads/' . $data->file_url, [ ($data->file_url) ? '' : 'class' => 'btn  disabled']);
                                },
                                'format' => 'raw',
                            ],
                            [
                                'label' => 'Статус',
                                'value' =>  function($data) {
                                    return Status::getStatusById($data->status_id)->title;
                                }
                            ],
                            [
                                'label' => 'Срок',
                                'value' =>  function($data) {
                                    return date('d M Y H:i:s', strtotime($data->deadline));
                                }
                            ],
                            [
                                'label' => 'Создан',
                                'value' =>  function($data) {
                                    date_default_timezone_set('Asia/Tashkent');
                                    return date('d M Y H:i:s',$data->created_at);
                                }
                            ],

                        ],
                    ]) ?>
                </div>
            </div>

        </div>
        <!-- /.card-body -->
    </div>

    <div class="card card-outline card-success collapsed-card">
        <div class="card-header">
            <h1 class="card-title">
                Исполнение по <span class="mr-1 text-bold" style="color: black;"><?= $model->title?></span>
                <?= (Yii::$app->user->id === $model->user_id || $myRole == "admin" || $myRole == "superAdmin") ? Html::a('+', ['contract-execution/create', 'contract_id' => $model->id], ['class' => 'btn btn-info', 'title' => 'Создать Исп по Kонтракт']) : "" ?>
            </h1>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
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
                    'receive_user' => [
                        'attribute' => 'receive_user',
                        'filter' => $users,
                        'value' =>  function($data) {
                            return User::getUserById($data['receive_user'])->fullname;
                        }
                    ],
                    [
                        'header' => 'Меню',
                        'format' => 'raw',
                        'value' => function($data){
                            return Html::a('Перейти', ['contract-execution/view', 'id'=>$data['id']]);
                        }
                    ],
                ],
            ]); ?>
        </div>
        <!-- /.card-body -->
    </div>

    <div class="card card-outline card-success collapsed-card">
        <div class="card-header">
            <h1 class="card-title">
                Расходы по <span class="mr-1 text-bold" style="color: black;"><?= $model->title?></span>
            </h1>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?= GridView::widget([
                'dataProvider' => $dataProviderExpense,
                'filterModel' => $searchModelExpense,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'contract_id' => [
                        'attribute'=>'contract_id',
                        'filter' => Select2::widget([
                            'model' => $searchModelExpense,
                            'attribute' => 'contract_id',
                            'name' => 'kv-type-01',
                            'data' => $contracts,
                            'options' => [
                                'class' => 'form-control',
                                'placeholder' => 'Контракт',

                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'selectOnClose' => true,
                            ]
                        ]),
                        'value' =>  function($data) {
                            return Contract::getContrctById($data->contract_id)->title;
                        },
                    ],
                    'currency_id' => [
                        'attribute'=>'currency_id',
                        'filter' => Select2::widget([
                            'model' => $searchModelExpense,
                            'attribute' => 'currency_id',
                            'name' => 'kv-type-01',
                            'data' => $currencies,
                            'options' => [
                                'class' => 'form-control',
                                'placeholder' => 'Статус',

                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'selectOnClose' => true,
                            ]
                        ]),
                        'value' =>  function($data) {
                            return Currency::getCurrencyById($data->currency_id)->name;
                        },
                    ],
                    'sum' => [
                        'attribute' => 'sum',
                        'value' =>  function($data) {
                            return number_format($data->sum, 2) . ' ' . Currency::getCurrencyById($data->currency_id)->short_name;;
                        }
                    ],
                    'rate' => [
                        'attribute' => 'rate',
                        'value' =>  function($data) {
                            return number_format($data->rate, 2);
                        }
                    ],
                    'desc' => [
                        'attribute' => 'desc',
                        'value' =>  function($data) {
                            return $data->desc;
                        }
                    ],
                    'created_at' => [
                        'attribute' => 'created_at',
                        'value' =>  function($data) {
                            date_default_timezone_set('Asia/Tashkent');
                            return date('d M Y H:i:s',$data->created_at);
                        }
                    ]
                ],
            ]); ?>
        </div>
        <!-- /.card-body -->
    </div>

</div>
