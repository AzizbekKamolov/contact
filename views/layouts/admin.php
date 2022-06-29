<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use mdm\admin\components\Helper;

AppAsset::register($this);
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
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo Yii::$app->request->baseUrl; ?>/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo Yii::$app->request->baseUrl; ?>/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo Yii::$app->request->baseUrl; ?>/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo Yii::$app->request->baseUrl; ?>/site.webmanifest">
    <link rel="mask-icon" href="<?php echo Yii::$app->request->baseUrl; ?>/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    $menuItems = [
//        ['label' => 'Главная', 'url' => ['/admin/default/index']],
        ['label' => 'Проекты', 'url' => ['/admin/project/index']],
        ['label' => 'Контракты', 'url' => ['/admin/contract/index']],
        ['label' => 'Кон на Исп', 'url' => ['/admin/contract-execution/index']],
        ['label' => 'Кон на Exch', 'url' => ['/admin/contract-exchange/index']],
        ['label' => 'Задачи', 'url' => ['/admin/task/index']],
        ['label' => 'Зад на Исп', 'url' => ['/admin/task-execution/index']],
        ['label' => 'Зад на Exch', 'url' => ['/admin/task-exchange/index']],
        ['label' => 'Валюта', 'url' => ['/admin/currency/index']],
        ['label' => 'Статусы', 'url' => ['/admin/status/index']],
        ['label' => 'RBAC', 'url' => ['/rbac/default/index']],
        ['label' => 'Users', 'url' => ['/admin/user/index']],
        Yii::$app->user->isGuest ? (
        ['label' => 'Войти', 'url' => ['/site/login']]
        ) : (
            '<li>'
            . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
            . Html::submitButton(
                'Выйти (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>'
        )
    ];
    NavBar::begin([
        'brandLabel' => 'ACDF',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => Helper::filter($menuItems),
    ]);
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="text-center">&copy; 2017 - <?= date('Y') ?> Фонд развития культуры и искусства при Кабинете Министров Республики Узбекистан.</p>
<!--        <p class="float-left">&copy; My Company --><?//= date('Y') ?><!--</p>-->
<!--        <p class="float-right">--><?//= Yii::powered() ?><!--</p>-->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
