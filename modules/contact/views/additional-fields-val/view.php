<?php

use app\models\User;
use app\modules\contact\models\AdditionalFieldsValue;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\contact\models\AdditionalFieldsValue */

$this->title = $model->getMainById($model->contact_id);
$this->params['breadcrumbs'][] = ['label' => 'Значения дополнительных полей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="additional-fields-value-view">
    <div class="card card-outline card-success">

        <div class="card-header">
            <h1 class="card-title text-bold">
                <?= Html::encode($this->title) ?>
               <?php
                 if (!(\Yii::$app->user->identity->id != $model['created_by'] && User::getMyRole() != 'superAdmin')){
                echo ($this->checkRoute('update')) ? Html::a('<i class="fas fa-pen"></i>', ['update', 'id' => $model->id], ['class' => 'text-primary mx-2']) : "";
                echo ($this->checkRoute('delete')) ? Html::a('<i class="fas fa-times"></i>', ['delete', 'id' => $model->id], [
                    'class' => 'text-danger',
                    'title' => 'Удалить Значения дополнительных полей',
                    'data' => [
                        'confirm' => 'Вы уверены, что хотите удалить этот Значения дополнительных полей?',
                        'method' => 'post',
                    ],
                ]) : "";
                }
                ?>

            </h1>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>

        </div>

        <div class="card-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'contact_id',
                        'value' => function($data){
                            return $data->main->title;
                        }

                    ],
                    [
                        'attribute' => 'additional_id',
                        'value' => function($data){
                            return $data->additionalField->title;
                        }
                    ],
                    [
                        'attribute' => 'value',
                        'format' => 'html',
                        'value' =>   function($model){
                            if (file_exists(Url::to('@webroot/uploads/files/'.$model->value)) && !empty($model->value)){

                                return Html::a('просмотр', Url::to('@web/uploads/files/'.$model->value, ['target' => '_blank']), ['target' => '_blank']);
                            }
                            else{
                                return $model->value;
                            }
                        }

                    ],
                    'created_at',
                    [
                        'attribute' => 'created_by',
                        'value' => 'user.email'
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>
