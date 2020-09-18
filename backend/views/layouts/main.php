<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAssetBackendArchive;
use yii\helpers\Html;
use backend\components\Url;

AppAssetBackendArchive::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php
    $result = Yii::$app->request->get();
    if ($result == ''){
        $result = '';
    }else{
        $result = Yii::$app->request->get('FilesSearch')['title'];
    }
    ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-footer fixed-head">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="app-header__content">
                <div class="container">
                    <form action="<?= Url::toRoute(['files/search-result'])?>" class="app-header-left row">
                        <div class="col-10">
                            <input type="text" class="form-control" name="FilesSearch[title]" value="<?= $result ?>" placeholder="Izlash uchun matn kiriting...">
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-lg btn-success">
                                <i class="nav-link-icon fa fa-search"> </i>
                                ҚИДИРИШ
                            </button>
                        </div>
                    </form>
                </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <img width="42" class="rounded-circle" src="/template/assets/images/avatars/1.jpg" alt="">
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            <button type="button" tabindex="0" class="dropdown-item">User Account</button>
                                            <button type="button" tabindex="0" class="dropdown-item">Settings</button>
                                            <h6 tabindex="-1" class="dropdown-header">Header</h6>
                                            <button type="button" tabindex="0" class="dropdown-item">Actions</button>
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <button type="button" tabindex="0" class="dropdown-item">Dividers</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        Xurshid
                                    </div>
                                    <div class="widget-subheading">
                                        Admin
                                    </div>
                                </div>
<!--                                <div class="widget-content-right header-user-info ml-3">-->
<!--                                    <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example">-->
<!--                                        <i class="fa text-white fa-calendar pr-1 pl-1"></i>-->
<!--                                    </button>-->
<!--                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>    <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                            <li class="app-sidebar__heading">Панель приборов</li>
                            <li>
                                <a href="<?= \yii\helpers\Url::toRoute('/')?>" class="<?=Url::hasActive(['site'])?'mm-active':''?>">
                                    <i class="metismenu-icon pe-7s-rocket"></i>
                                    Главная
                                </a>
                            </li>
                            <li class="app-sidebar__heading">Меню</li>
                            <li>
                                <a href="<?= \yii\helpers\Url::to('/categories')?>" class="<?=Url::hasActive(['categories'])?'mm-active':''?> <?=Url::hasActive(['categories'])?'mm-active':''?>">
                                    <i class="metismenu-icon pe-7s-keypad"></i>
                                    Категории
                                </a>
                            </li>
                            <li>
                                <a href="<?= \yii\helpers\Url::toRoute('/folders')?>" class="<?=Url::hasActive(['folders'])?'active':''?> <?=Url::hasActive(['files'])?'active':''?>">
                                    <i class="metismenu-icon pe-7s-folder"></i>
                                    Файл
                                </a>
                            </li>
                    <!--        <li>
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-car"></i>
                                    Components
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="components-tabs.html">
                                            <i class="metismenu-icon">
                                            </i>Tabs
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components-accordions.html">
                                            <i class="metismenu-icon">
                                            </i>Accordions
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components-notifications.html">
                                            <i class="metismenu-icon">
                                            </i>Notifications
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components-modals.html">
                                            <i class="metismenu-icon">
                                            </i>Modals
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components-progress-bar.html">
                                            <i class="metismenu-icon">
                                            </i>Progress Bar
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components-tooltips-popovers.html">
                                            <i class="metismenu-icon">
                                            </i>Tooltips &amp; Popovers
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components-carousel.html">
                                            <i class="metismenu-icon">
                                            </i>Carousel
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components-calendar.html">
                                            <i class="metismenu-icon">
                                            </i>Calendar
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components-pagination.html">
                                            <i class="metismenu-icon">
                                            </i>Pagination
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components-scrollable-elements.html">
                                            <i class="metismenu-icon">
                                            </i>Scrollable
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components-maps.html">
                                            <i class="metismenu-icon">
                                            </i>Maps
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li  >
                                <a href="tables-regular.html">
                                    <i class="metismenu-icon pe-7s-display2"></i>
                                    Tables
                                </a>
                            </li>
                            <li class="app-sidebar__heading">Widgets</li>
                            <li>
                                <a href="dashboard-boxes.html">
                                    <i class="metismenu-icon pe-7s-display2"></i>
                                    Dashboard Boxes
                                </a>
                            </li>
                            <li class="app-sidebar__heading">Forms</li>
                            <li>
                                <a href="forms-controls.html">
                                    <i class="metismenu-icon pe-7s-mouse">
                                    </i>Forms Controls
                                </a>
                            </li>
                            <li>
                                <a href="forms-layouts.html">
                                    <i class="metismenu-icon pe-7s-eyedropper">
                                    </i>Forms Layouts
                                </a>
                            </li>
                            <li>
                                <a href="forms-validation.html">
                                    <i class="metismenu-icon pe-7s-pendrive">
                                    </i>Forms Validation
                                </a>
                            </li>
                            <li class="app-sidebar__heading">Charts</li>
                            <li>
                                <a href="charts-chartjs.html">
                                    <i class="metismenu-icon pe-7s-graph2">
                                    </i>ChartJS
                                </a>
                            </li>-->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="app-main__outer">
                <div class="container-fluid h-auto mt-4">
                    <?= \yii\bootstrap4\Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                    <?=$content?>
                </div>
                <div class="app-wrapper-footer">
                    <div class="app-footer">
                        <div class="app-footer__inner">
                            <div class="app-footer-left">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                            Footer Link 1
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                            Footer Link 2
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="app-footer-right">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                            Footer Link 3
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                            <div class="badge badge-success mr-1 ml-0">
                                                <small>NEW</small>
                                            </div>
                                            Footer Link 4
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
