<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\assets\DashboardAsset;
use app\models\User;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;

DashboardAsset::register($this);
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
    <link rel="apple-touch-icon" sizes="180x180"
          href="<?php echo Yii::$app->request->baseUrl; ?>/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32"
          href="<?php echo Yii::$app->request->baseUrl; ?>/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16"
          href="<?php echo Yii::$app->request->baseUrl; ?>/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo Yii::$app->request->baseUrl; ?>/site.webmanifest">
    <link rel="mask-icon" href="<?php echo Yii::$app->request->baseUrl; ?>/img/favicon/safari-pinned-tab.svg"
          color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<?php $this->beginBody() ?>
<?php Yii::$app->name = 'ACDF' ?>
<div class="wrapper">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="<?= Yii::getAlias('@web/adminlte/dist/img/') . "spinner.gif" ?>"
             alt="AdminLTELogo" height="100" width="100">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>

            <li class="nav-item">
                <?= Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline']); ?>
                <?= Html::submitButton('<i class="fa fa-sign-out"></i> Выйти ', ['class' => 'btn btn-link logout', 'title' => 'Выйти']) ?>
                <?= Html::endForm(); ?>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/" class="brand-link">
            <img src="<?= Yii::getAlias('@web/img/favicon/') . "android-chrome-384x384.png" ?>" alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">ACDF</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="<?= Yii::getAlias('@web/adminlte/dist/img/') . "user2-160x160.jpg" ?>"
                         class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?= \Yii::$app->user->identity->fullname ?></a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="/project/index" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Проекты</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/contract/index" class="nav-link">
                            <i class="nav-icon fas fa-file-contract"></i>
                            <p>Контракты</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/contract-execution/index" class="nav-link">
                            <i class="nav-icon fas fa-file-contract"></i>
                            <p>Контракт на исп</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/task/index" class="nav-link">
                            <i class="nav-icon fas fa-tasks"></i>
                            <p>Задачи</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/task-execution/index" class="nav-link">
                            <i class="nav-icon fas fa-tasks"></i>
                            <p>Задачи на исп</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/contact/main/index" class="nav-link">
                            <i class="nav-icon fas fa-address-card"></i>
                            <p>Контакты</p>
                            <i class="right fas fa-angle-left"></i>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/contact/main/index" class="nav-link">
                                    <i class="nav-icon fas fa-address-book"></i>
                                    <p>Контакты</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/contact/category/index" class="nav-link">
                                    <i class="nav-icon fas fa-bars"></i>
                                    <p>Категории</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/contact/sub-category/index" class="nav-link">
                                    <i class="nav-icon fas fa-align-left"></i>
                                    <p>Подкатегории</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/contact/additional-field/index" class="nav-link">
                                    <i class="nav-icon fas fa-folder-plus"></i>
                                    <p>Дополнительные поля</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/contact/additional-fields-val/index" class="nav-link">
                                    <i class="nav-icon fas fa-folder-plus"></i>
                                    <p>Дополнительные значе</p>
                                </a>
                            </li>
                        </ul>



                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
    <!--  /. Main Sidebar  -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </section>
    </div>
</div>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="text-center">&copy; 2017 - <?= date('Y') ?> Фонд развития культуры и искусства при Кабинете Министров
            Республики Узбекистан.</p>
        <!--        <p class="float-right">--><? //= Yii::powered() ?><!--</p>-->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script>
    var url = window.location;

    // for sidebar menu entirely but not cover treeview
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active');

    // for treeview
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>