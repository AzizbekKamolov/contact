<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Contract */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Contracts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="contract-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('File Upload', ['set-file', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
//            'project_id',
//            'title',
//            'description:ntext',
//            'price',
//            'user_id',
//            'file_url:url',
//            'status_id',
//            'deadline',
//            'created_at',
//            'updated_at',
            [
                'label' => 'Проект',
                'value' =>  function($data) {
                    return \app\models\Project::find(['id' => $data->project_id])->one()->title;
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
                    return $data->price;
                }
            ],
            [
                'label' => 'Создатель',
                'value' =>  function($data) {
                    return \app\models\User::find(['id' => $data->user_id])->one()->username;
                }
            ],
            [
                    'label' => 'Документ',
                    'value' => function($data)
                    {
                        return Html::a('Загрузить',  '../uploads/' . $data->file_url);
                    },
                    'format' => 'raw',
            ],
            [
                'label' => 'Статус',
                'value' =>  function($data) {
                    return \app\models\Status::find(['id' => $data->status_id])->one()->title;
                }
            ],
            [
                'label' => 'Срок',
                'value' =>  function($data) {
                    return $data->deadline;
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
