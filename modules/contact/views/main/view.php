<?php

use app\models\User;
use app\modules\contact\models\AdditionalFieldsValue;
use app\modules\contact\models\Main;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\contact\models\Main */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Контакт', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div>
    <div class="main-view">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h1 class="card-title text-bold">
                    <?= Html::encode($this->title) ?>
                    <?php
                    if (!(\Yii::$app->user->identity->id != $model['owner_id'] && User::getMyRole() != 'superAdmin')) {
                        echo ($this->checkRoute('update')) ? Html::a('<i class="fas fa-pen"></i>', ['update', 'id' => $model->id], ['class' => 'text-primary mx-2']) : "";
                        echo ($this->checkRoute('delete')) ? Html::a('<i class="fas fa-times"></i>', ['delete', 'id' => $model->id], [
                            'class' => 'text-danger',
                            'title' => 'Удалить Контакт',
                            'data' => [
                                'confirm' => 'Вы уверены, что хотите удалить этот Контакт?',
                                'method' => 'post',
                            ],
                        ]) : "";
                    }
                    ?>


                    <!--                    --><? //= Html::encode($this->title) ?>
                    <!---->
                    <!--                    --><? //= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <!--                    --><? //= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    //                        'class' => 'btn btn-danger',
                    //                        'data' => [
                    //                            'confirm' => 'Are you sure you want to delete this item?',
                    //                            'method' => 'post',
                    //                        ],
                    //                    ]) ?>
                </h1>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>

            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-6">


                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
//                    'id',
                                'prefix',
                                'firstname',
                                'lastname',
                                'title',
                                'company',
                                'phone',
                                'cellphone',
                                'phone2',
                                'address1:ntext'
                            ],
                        ]) ?>

                    </div>

                    <div class="col-6">
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'address2:ntext',
                                'po_box',
                                'zip_code',
                                'country',
                                'city',
                                'language',
                                [
                                    'attribute' => 'owner_id',
                                    'value' => function ($data) {
                                        return $data->user->email;
                                    },
                                ],
                                [
                                    'attribute' => 'category',
                                    'value' => function ($data) {
                                        return $data->subCategory->category->title;
                                    },
                                ],
                                [
                                    'attribute' => 'subcategory',
                                    'value' => function ($data) {
                                        return $data->subCategory->title;
                                    },
                                ],
                            ]
                        ])
                        ?>
                    </div>
                    <div class="col-12">
                        <div class="additional-fields-value-view">

                            <h1>Дополнительные поля</h1>

                            <?php

                            use yii\grid\GridView;
                            use yii\data\ActiveDataProvider;

                            $dataProvider = new ActiveDataProvider([
                                'query' => AdditionalFieldsValue::find()->where(['contact_id' => $model->id]),
                            ]);
                            echo GridView::widget([
                                'dataProvider' => $dataProvider,
                                'showHeader' => false,
                                'columns' => [
//                        'id',
                                    ['class' => 'yii\grid\SerialColumn'],
                                    [
                                        'attribute' => 'additional_id',
                                        'value' => function ($data) {
                                            return $data->additionalField->title;
                                        }
                                    ],
                                    [
                                        'attribute' => 'value',
                                        'format' => 'html',
                                        'value' => function ($model) {
                                            if (file_exists(Url::to('@webroot/uploads/files/' . $model->value)) && !empty($model->value)) {

                                                return Html::a('Просмотр', Url::to('@web/uploads/files/' . $model->value), ['target' => '_blank']);
                                            } else {
                                                return $model->value;
                                            }
                                        }

                                    ],
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => '{update}',
                                        'visibleButtons' => [
                                            'update' => function ($data) {
                                                return ($data->created_by == Yii::$app->user->identity->id || User::getMyRole() == 'superAdmin');
                                            },
                                        ],
                                        'buttons' => [
                                            'update' => function ($url, $model, $key) {
                                                return Html::a('Редактировать', Url::to('/contact/additional-fields-val/update?id=' . $model->id));

                                            },
                                        ],
                                    ],
                                ]
                            ]);
                            ?>


                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

</div>