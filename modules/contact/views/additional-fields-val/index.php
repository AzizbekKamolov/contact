<?php

use app\models\User;
use app\modules\contact\models\AdditionalFieldsValue;
use yii\bootstrap4\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\contact\models\AdditionalFieldValSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Дополнительные значения полей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="additional-fields-value-index">
    <div class="card card-outline card-success">

        <div class="card-header">
            <h1 class="card-title text-bold">
                <?= Html::encode($this->title) ?>
                <?= Html::a('+', ['create'], ['class' => 'btn btn-info ml-2']) ?>
            </h1>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>

        </div>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <div class="card-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

//            'id',
                    [
                        'attribute' => 'contact_id',
                        'value' => function ($data) {
                            return $data->main->title;
                        }
                    ],
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
                    'created_at',
//                   [
//                       'attribute' => 'created_by',
//                       'value' => 'user.email'
//                   ],
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, AdditionalFieldsValue $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        },
                        'template' => '{view} {update} {delete}',
                        'visibleButtons' => [
                            'delete' => function ($data) {
                                return ($data->created_by == Yii::$app->user->identity->id || User::getMyRole() == 'superAdmin');
                            },
                            'update' => function ($data) {
                                return ($data->created_by == Yii::$app->user->identity->id || User::getMyRole() == 'superAdmin');
                            },
                        ]
                    ],
                ],
            ]); ?>
        </div>

    </div>
</div>
