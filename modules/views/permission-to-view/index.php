<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'View To Permissions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="view-to-permission-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create View To Permission', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'main_name',
            'role_name',
            'main_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ViewToPermission $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
