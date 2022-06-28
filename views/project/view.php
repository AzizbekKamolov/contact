<?php

use app\models\Contract;
use app\models\Currency;
use app\models\Project;
use app\models\Status;
use co0lc0der\Lte3Widgets\CardToolsHelper;
use co0lc0der\Lte3Widgets\CardWidget;
use hail812\adminlte\widgets\Alert;
use kartik\select2\Select2;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use \app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Проекты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$myRole = \app\models\User::getMyRole();

?>
<div class="project-view">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h1 class="card-title text-bold">
                <?= Html::encode($this->title) ?>
                <?= ($myRole === "superAdmin") ? Html::a('<i class="fas fa-pen"></i>', ['update', 'id' => $model->id], ['class' => 'text-primary mx-2', 'title' => 'Обнавить Проект']) : "" ?>
                <?= ($myRole === "superAdmin") ? Html::a('<i class="fas fa-times"></i>', ['delete', 'id' => $model->id], [
                    'class' => 'text-danger',
                    'title' => 'Удалить Проект',
                    'data' => [
                        'confirm' => 'Вы уверены, что хотите удалить этот проект?',
                        'method' => 'post',
                    ],
                ]) : "" ?>
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
                        ],
                    ]) ?>
                </div>
                <div class="col-6">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            [
                                'label' => 'Бюджет',
                                'value' =>  function($data) {
                                    return number_format($data->budget_sum, 2). ' ' . Currency::getCurrencyById($data->currency_id)->short_name;
                                }
                            ],
                            [
                                'label' => 'Валюта',
                                'value' =>  function($data) {
                                    return Currency::getCurrencyById($data->currency_id)->name;
                                }
                            ],
                            [
                                'label' => 'Дата проекта',
                                'value' =>  function($data) {
                                    return $data->project_year;
                                }
                            ],
                            [
                                'label' => 'Ответственный',
                                'value' =>  function($data) {
                                    return User::getUserById($data->user_id)->fullname;
                                }
                            ],
                            [
                                'label' => 'Статус',
                                'value' =>  function($data) {
                                    return Status::getStatusById($data->status_id)->title;
                                },
                            ],

                            [
                                'label' => 'Создан',
                                'value' =>  function($data) {
                                    date_default_timezone_set('Asia/Tashkent');
                                    return date('d M Y H:i:s',$data->created_at);
                                }
                            ],
                            [
                                'label' => 'Срок',
                                'value' =>  function($data) {
                                    return date('d M Y H:i:s', strtotime($data->deadline));
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
                Контракты по <span class="mr-1 text-bold" style="color: black;"><?= $model->title?></span>
                <?= (Yii::$app->user->id === $model->user_id || $myRole == "admin" || $myRole == "superAdmin") ? Html::a('+', ['contract/create', 'project_id' => $model->id], ['class' => 'btn btn-info', 'title' => 'Создать Kонтракт']) : "" ?>
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
                    'price' => [
                        'attribute' => 'price',
                        'value' => function($data) {
                            return $data->price;
                        }
                    ],
                    'status_id' => [
                        'attribute'=>'status_id',
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'status_id',
                            'name' => 'kv-type-01',
                            'data' => $statuses,
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
                            return Status::getStatusById($data->status_id)->title;
                        },
                        'contentOptions' => function($data) {
                            return ['class' => Status::getStatusColor($data->status_id)];
                        }
                    ],
                    [
                        'header' => 'Меню',
                        'format' => 'raw',
                        'value' => function($data){
                            return Html::a('Перейти', ['contract/view', 'id'=>$data['id']]);
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
                Задачи по <span class="mr-1 text-bold" style="color: black;"><?= $model->title?></span>
                <?= (Yii::$app->user->id === $model->user_id || $myRole == "admin" || $myRole == "superAdmin") ? Html::a('+', ['task/create', 'project_id' => $model->id], ['class' => 'btn btn-info', 'title' => 'Создать Задача']) : "" ?>
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
                'dataProvider' => $dataProviderTask,
                'filterModel' => $searchModelTask,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'title:ntext',
//                    'price' => [
//                        'attribute' => 'price',
//                        'value' => function($data) {
//                            return $data->price;
//                        }
//                    ],
                    'deadline' => [
                        'attribute' => 'deadline',
                        'value' =>  function($data) {
                            return $data->deadline;
                        }
                    ],
                    'status_id' => [
                        'attribute'=>'status_id',
                        'filter' => Select2::widget([
                            'model' => $searchModelTask,
                            'attribute' => 'status_id',
                            'name' => 'kv-type-01',
                            'data' => $statuses,
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
                            return Status::getStatusById($data->status_id)->title;
                        },
                        'contentOptions' => function($data) {
                            return ['class' => Status::getStatusColor($data->status_id)];
                        }
                    ],

                    [
                        'header' => 'Меню',
                        'format' => 'raw',
                        'value' => function($data){
                            return Html::a('Перейти', ['task/view', 'id'=>$data->id]);
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
