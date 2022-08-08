<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\LoginAsset;
use app\models\User;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;

LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
<!--    <link rel="shortcut icon" href="img/favicon.png" type="image/png">-->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo Yii::$app->request->baseUrl; ?>/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo Yii::$app->request->baseUrl; ?>/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo Yii::$app->request->baseUrl; ?>/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo Yii::$app->request->baseUrl; ?>/site.webmanifest">
    <link rel="mask-icon" href="<?php echo Yii::$app->request->baseUrl; ?>/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
</head>
<body class="hold-transition login-page">
<?php $this->beginBody() ?>
<?php Yii::$app->name = 'ACDF' ?>
<div class="wrapper">
<!--    <div class="container-fluid">-->
    <?= $content ?>
<!--    </div>-->

</div>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="text-center">&copy; 2017 - <?= date('Y') ?> Фонд развития культуры и искусства при Кабинете Министров Республики Узбекистан.</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
