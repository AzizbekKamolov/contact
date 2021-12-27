<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

?>

<div class="article-form">

    <?= DetailView::widget([
        'model' => $taskExchange,
        'attributes' => [
//            'task_exe_id',
//            'exe_user_id',
//            'info:ntext',
//            'created_at',
            [
                'label' => 'Контракт',
                'value' =>  function($data) {
                    return \app\models\Task::find()->where(['id' => $data->task_exe_id])->one()->title;
                }
            ],
            [
                'label' => 'Исполнитель',
                'value' =>  function($data) {
                    return \app\models\User::find()->where(['id' => $data->exe_user_id])->one()->username;
                }
            ],
            [
                'label' => 'Описание',
                'value' =>  function($data) {
                    return $data->info;
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

    <?= Html::a('Одобрить', ['task-approve', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Отказать', ['task-deny', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>

</div>
