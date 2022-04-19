<?php

use app\models\Contract;
use app\models\Status;
use app\models\User;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this app\components\View */
/* @var $model app\models\ContractExecution */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Исполнение контрактов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$myRole = \app\models\User::getMyRole();
?>
<div class="contract-execution-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
//            'title',
//            'contract_id',
//            'user_id',
//            'exe_user_id',
//            'status_id',
//            'info:ntext',
//            'done_date',
//            'mark',
//            'receive_date',
//            'receive_user',
//            'created_at',
//            'updated_at',
            [
                'label' => 'Название',
                'value' =>  function($data) {
                    return $data->title;
                }
            ],
            [
                'label' => 'Контракт',
                'value' =>  function($data) {
                    return Contract::getContrctById($data->contract_id)->title;
                }
            ],
            [
                'label' => 'Создатель',
                'value' =>  function($data) {
                    return User::getUserById($data->user_id)->fullname;
                }
            ],
            [
                'label' => 'Исполнитель',
                'value' =>  function($data) {
                    return User::getUserById($data->exe_user_id)->fullname;
                }
            ],
            [
                'label' => 'Статус',
                'value' =>  function($data) {
                    return Status::getStatusById($data->status_id)->title;
                }
            ],
//            [
//                'label' => 'Описание',
//                'value' =>  function($data) {
//                    return $data->info;
//                }
//            ],
            [
                'label' => 'Оценка',
                'value' =>  function($data) {
                    return ($data->mark) ? $data->mark . ' из 5. Описание: ' . $data->info : '';
                }
            ],
            [
                'label' => 'Получатель',
                'value' =>  function($data) {
                    return User::getUserById($data->receive_user)->fullname;
                }
            ],
            [
                'label' => 'Создан',
                'value' =>  function($data) {
                    date_default_timezone_set('Asia/Tashkent');
                    return date('d M Y H:i:s',$data->created_at);
                }
            ],
            [
                'label' => 'Дата получения',
                'value' =>  function($data) {
                    return date('d M Y H:i:s', strtotime($data->receive_date));
//                    return $data->receive_date;
                }
            ],
            [
                'label' => 'Дата завершения',
                'value' =>  function($data) {
//                    return $data->done_date;
                    return ($data->done_date) ? date('d M Y H:i:s', strtotime($data->done_date)) : '(не завершено)';
                }
            ],
        ],
    ]) ?>

    <br>
    <h1>Хронология</h1>
    <br>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'task_exe_id',
//            'exe_user_id',
//            'rec_user_id',
//            'info:ntext',
//            'file',
//            'created_at',
//            'updated_at',
            [
                'label' => 'Исполнитель',
                'value' =>  function($data) {
                    return User::getUserById($data->exe_user_id)->fullname;
                }
            ],
            [
                'label' => 'Получатель',
                'value' =>  function($data) {
                    return User::getUserById($data->rec_user_id)->fullname;
                }
            ],
            [
                'label' => 'Описание',
                'value' =>  function($data) {
                    return $data->info;
                }
            ],
            [
                'label' => 'Документ',
                'value' => function($data)
                {
                    return Html::a('Загрузить',  Url::to('/uploads/' . $data->file), [ ($data->file) ? '' : 'class' => 'btn  disabled']);
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Создан',
                'value' =>  function($data) {
                    date_default_timezone_set('Asia/Tashkent');
                    return date('d M Y H:i:s',$data->created_at);
                }
            ],

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <p>
        <?= $this->checkRoute("update") ? Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) : "" ?>
        <?php  if ($model->receive_user === Yii::$app->user->id):?>
            <?= Html::a('Проверить исп контракт', ['contract-check', 'id' => $model->id], ['class' => ($model->status_id !== 2) ? 'btn btn-success disabled' : 'btn btn-success']) ?>
        <?php elseif(Yii::$app->user->id === $model->exe_user_id || $lastItem->exe_user_id === Yii::$app->user->id): ?>
            <?= Html::a('Выполнить контракт', ['contract-exe', 'id' => $model->id], ['class' => (($model->status_id === 2) || ($model->status_id === 4)) ? 'btn btn-success disabled' : 'btn btn-success']) ?>
        <?php endif; ?>
        <?= $this->checkRoute("delete") ? Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) : "" ?>
    </p>

</div>
