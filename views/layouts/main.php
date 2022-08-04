<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\models\User;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

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
<!--    <link rel="shortcut icon" href="img/favicon.png" type="image/png">-->
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
<?php Yii::$app->name = 'ACDF' ?>

<header>
    <?php
    $myRole = User::getMyRole();
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
        'containerOptions' => [
                'class' => 'justify-content-end'
        ]
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
//            ['label' => 'Главная сайт', 'url' => ['/site/index']],
            ['label' => 'Проекты', 'url' => ['/project/index']],
            ['label' => 'Контракты', 'url' => ['/contract/index']],
            ($myRole !== 'simpleUser') ? (
                ['label' => 'Контракт на исп', 'url' => ['/contract-execution/index']]
            ):(
                ['label' => 'Мои Контракты', 'url' => ['/contract-execution/index']]
            ),
//            ['label' => 'Част Контракты', 'url' => ['/contract-exchange/index']],
            ['label' => 'Задачи', 'url' => ['/task/index']],
            ($myRole !== 'simpleUser') ? (
                    ['label' => 'Задачи на исп', 'url' => ['/task-execution/index']]
            ): (
                    ['label' => 'Мои Задачи', 'url' => ['/task-execution/index']]
            ),
            ($myRole === 'superAdmin') ? (
                    ['label' => 'Админка', 'url' => ['/admin/']]
            ):(''),
            Yii::$app->user->isGuest ? (
                ['label' => 'Войти', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                . Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->fullname . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
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
<!--        <p class="float-right">--><?//= Yii::powered() ?><!--</p>-->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
