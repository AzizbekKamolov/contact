<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

$this->registerAssetBundle('app\assets\ViewerJsAssets');
?>

<div class="contract-receiver-form">

    <?= DetailView::widget([
        'model' => $contractExchange,
        'attributes' => [
//            'con_exe_id',
//            'exe_user_id',
//            'info:ntext',
//            'file',
//            'created_at',
            [
                'label' => 'Контракт',
                'value' =>  function($data) {
                    return \app\models\Contract::find()->where(['id' => $data->con_exe_id])->one()->title;
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
                'label' => 'Документ',
                'value' => function($data)
                {
                    return Html::a('Загрузить',  '../uploads/' . $data->file, [ ($data->file) ? '' : 'class' => 'btn  disabled']);
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
        ],
    ]) ?>

    <?php
//        \lesha724\documentviewer\ViewerJsDocumentViewer::widget([
//                'url' => \Yii::getAlias('@web') . 'uploads/' . $contractExchange->file,
//            'url' => 'http://10.p-control.loc/uploads/4cd0c72540c28ec8e038a9745b49c465.pdf',
//            'width'=>'724',
//            'height'=>'1024',
//            'embedded'=>true,
//            'a'=>\lesha724\documentviewer\GoogleDocumentViewer::A_BI //A_V = 'v', A_GT= 'gt', A_BI = 'bi'
//        ])
    ?>

<!--    <iframe src = --><?//= \Yii::getAlias('@web') . 'uploads/' . $contractExchange->file ?><!-- width='724' height='1024' allowfullscreen webkitallowfullscreen></iframe>-->

    <?php // \yii2assets\pdfjs\PdfJs::widget([ 'url'=> \Yii::getAlias('@web') . 'uploads/' . $contractExchange->file ]); ?>

    <?= Html::a('Одобрить', ['contract-approve', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Отказать', ['contract-deny', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>

</div>
