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
            'con_exe_id',
            'exe_user_id',
            'info:ntext',
            'created_at',
        ],
    ]) ?>

    <?=
        \lesha724\documentviewer\ViewerJsDocumentViewer::widget([
                'url' => \Yii::getAlias('@web') . 'uploads/' . $contractExchange->file,
//            'url' => 'http://p-control.loc/uploads/1b60729a45ee8c6403c27d179036f688.docx',
            'width'=>'724',
            'height'=>'1024',
//            'embedded'=>true,
//            'a'=>\lesha724\documentviewer\GoogleDocumentViewer::A_BI //A_V = 'v', A_GT= 'gt', A_BI = 'bi'
        ])
    ?>

    <iframe src = <?= \Yii::getAlias('@web') . 'uploads/' . $contractExchange->file ?> width='724' height='1024' allowfullscreen webkitallowfullscreen></iframe>

    <?= \yii2assets\pdfjs\PdfJs::widget([
        'url'=> 'http://p-control.loc/uploads/1664b6090a870e6dcc796925650a17da.pdf'
    ]); ?>

    <?= Html::a('Одобрить', ['contract-approve', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Отказать', ['contract-deny', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>

</div>
