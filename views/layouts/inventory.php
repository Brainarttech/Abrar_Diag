<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
$url = Url::base(true);
$this->registerJs(
    "const url = '$url';",
    \yii\web\View::POS_HEAD,
    'url'
);

AppAsset::register($this);


$baseUrl = Yii::$app->homeUrl;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--begin::Web font -->
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>

        <script>
            WebFont.load({
                google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
                active: function () {
                    sessionStorage.fonts = true;
                }
            });
        </script>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <script src=" <?php echo Yii::$app->homeUrl ?>js/jquery.min.js"></script>

        <?php $this->head() ?>
    </head>
    <body  class="m--skin- m-page--loading-enabled  m-content--skin-light m-header--fixed m-header--fixed-mobile m-aside-left--offcanvas-default m-aside-left--enabled m-aside-left--fixed m-aside-left--skin-dark m-aside--offcanvas-default"  >
        <?php $this->beginBody() ?>
        <!-- begin::Page loader -->
        <div class="m-page-loader m-page-loader--base">
            <div class="m-blockui">
                <span>
                    Please wait...
                </span>
                <span>
                    <div class="m-loader m-loader--brand"></div>
                </span>
            </div>
        </div>
        <!-- end::Page Loader -->

        <!-- begin:: Page -->
        <div class="m-grid m-grid--hor m-grid--root m-page" style="min-height: calc(100% - 1em);">

            <!-- if login user is admin-->

            <!-- if login user is receptionist -->
            <!-- BEGIN: Header -->
            <header id="m_header" class="m-grid__item m-header" m-minimize-offset="200" m-minimize-mobile-offset="200">
                <div class="m-container m-container--fluid m-container--full-height">
                    <div class="m-stack m-stack--ver m-stack--desktop m-header__wrapper">


                        <!-- BEGIN: Brand -->
                        <div class="m-stack__item m-brand m-brand--mobile">
                            <div class="m-stack m-stack--ver m-stack--general">
                                <div class="m-stack__item m-stack__item--middle m-brand__logo">
                                    <a href="index.html" class="m-brand__logo-wrapper">
                                        <img alt="" src="#"/>
                                    </a>
                                </div>
                                <div class="m-stack__item m-stack__item--middle m-brand__tools">
                                    <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                                    <!-- <a href="javascript:;" id="m_aside_left_toggle_mobile" class="m-brand__icon m-brand__toggler m-brand__toggler--left">
                                        <span></span>
                                    </a> -->
                                    <!-- END -->
                                    <!-- BEGIN: Responsive Header Menu Toggler -->
                                    <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler">
                                        <span></span>
                                    </a>
                                    <!-- END -->
                                    <!-- BEGIN: Topbar Toggler -->
                                    <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon">
                                        <i class="flaticon-more"></i>
                                    </a>
                                    <!-- BEGIN: Topbar Toggler -->
                                </div>
                            </div>
                        </div>


                        <!-- BEGIN: Horizontal Menu -->
                        <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark "  >
                            <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
                                <li class="m-menu__item m-menu__item--submenu m-menu__item--rel">
                                    <a href="#" class="m-menu__link">
                                        <i class="m-menu__link-icon flaticon-dashboard"></i>
                                        <span class="m-menu__link-text">
                                            Dashboard
                                        </span>
                                    </a>
                                </li>
                                <li class="m-menu__item m-menu__item--submenu m-menu__item--rel">
                                    <a href="<?php echo $baseUrl . 'product/'; ?>" class="m-menu__link">
                                        <i class="m-menu__link-icon flaticon-squares"></i>
                                        <span class="m-menu__link-text">
                                            Products
                                        </span>
                                    </a>
                                </li>
                                <li class="m-menu__item m-menu__item--submenu m-menu__item--rel">
                                    <a href="<?php echo $baseUrl . 'purchase/'; ?>" class="m-menu__link">
                                        <i class="m-menu__link-icon flaticon-squares"></i>
                                        <span class="m-menu__link-text">
                                            Purchase
                                        </span>
                                    </a>
                                </li>
                                <li class="m-menu__item m-menu__item--submenu m-menu__item--rel">
                                    <a href="<?php echo $baseUrl . 'purchase/'; ?>" class="m-menu__link">
                                        <i class="m-menu__link-icon flaticon-squares"></i>
                                        <span class="m-menu__link-text">
                                            Payment
                                        </span>
                                    </a>
                                </li>
                                <li class="m-menu__item m-menu__item--submenu m-menu__item--rel">
                                    <a href="<?php echo $baseUrl . 'purchase/'; ?>" class="m-menu__link">
                                        <i class="m-menu__link-icon flaticon-squares"></i>
                                        <span class="m-menu__link-text">
                                            Transfer
                                        </span>
                                    </a>
                                </li>
                                <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                    <a  href="javascript:;" class="m-menu__link m-menu__toggle">
                                        <i class="m-menu__link-icon flaticon-coins"></i>
                                        <span class="m-menu__link-title">
                                            <span class="m-menu__link-wrap">
                                                <span class="m-menu__link-text">
                                                    Users
                                                </span>
                                            </span>
                                        </span>
                                        <i class="m-menu__hor-arrow la la-angle-down"></i>
                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                    </a>
                                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                        <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                        <ul class="m-menu__subnav">

                                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                <a  href="<?php echo $baseUrl . 'si-unit/'; ?>" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-interface-9"></i>
                                                    <span class="m-menu__link-text">
                                                        Customer
                                                    </span>
                                                </a>
                                            </li>

                                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                <a href="<?php echo $baseUrl . 'supplier/'; ?>" class="m-menu__link">
                                                    <i class="m-menu__link-icon flaticon-squares"></i>
                                                    <span class="m-menu__link-text">
                                                        Suppliers
                                                    </span>
                                                </a>
                                            </li>

                                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                <a  href="<?php echo $baseUrl . 'brand/'; ?>" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-interface-9"></i>
                                                    <span class="m-menu__link-text">
                                                        Vendor
                                                    </span>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </li>
                             <li class="m-menu__item m-menu__item--submenu m-menu__item--rel">
                                    <a href="<?php echo $baseUrl . 'purchase/'; ?>" class="m-menu__link">
                                        <i class="m-menu__link-icon flaticon-squares"></i>
                                        <span class="m-menu__link-text">
                                            Reports
                                        </span>
                                    </a>
                                </li>
                                <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                    <a  href="javascript:;" class="m-menu__link m-menu__toggle">
                                        <i class="m-menu__link-icon flaticon-coins"></i>
                                        <span class="m-menu__link-title">
                                            <span class="m-menu__link-wrap">
                                                <span class="m-menu__link-text">
                                                    Settings
                                                </span>
                                            </span>
                                        </span>
                                        <i class="m-menu__hor-arrow la la-angle-down"></i>
                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                    </a>
                                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                        <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                        <ul class="m-menu__subnav">

                                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                <a  href="<?php echo $baseUrl . 'si-unit/'; ?>" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-interface-9"></i>
                                                    <span class="m-menu__link-text">
                                                        Si Units
                                                    </span>
                                                </a>
                                            </li>

                                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                <a  href="<?php echo $baseUrl . 'category/'; ?>" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-interface-9"></i>
                                                    <span class="m-menu__link-text">
                                                        Categories
                                                    </span>
                                                </a>
                                            </li>

                                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                <a  href="<?php echo $baseUrl . 'brand/'; ?>" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-interface-9"></i>
                                                    <span class="m-menu__link-text">
                                                        Brands
                                                    </span>
                                                </a>
                                            </li>

                                            <!--                                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                                            <a  href="<?php echo $baseUrl . 'warehouse/'; ?>" class="m-menu__link ">
                                                                                                <i class="m-menu__link-icon flaticon-interface-9"></i>
                                                                                                <span class="m-menu__link-text">
                                                                                                    Warehouses
                                                                                                </span>
                                                                                            </a>
                                                                                        </li>-->

                                            <!--                                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                                            <a  href="<?php echo $baseUrl . 'request/'; ?>" class="m-menu__link ">
                                                                                                <i class="m-menu__link-icon flaticon-interface-9"></i>
                                                                                                <span class="m-menu__link-text">
                                                                                                    Transfer Request
                                                                                                </span>
                                                                                            </a>
                                                                                        </li>-->
                                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                <a  href="<?php echo $baseUrl . 'variant/'; ?>" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-interface-9"></i>
                                                    <span class="m-menu__link-text">
                                                        Variants
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- END: Horizontal Menu -->								<!-- BEGIN: Topbar -->
                        <div class="m-stack__item m-stack__item--right">
                            <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                                <div class="m-stack__item m-topbar__nav-wrapper">
                                    <ul class="m-topbar__nav m-nav m-nav--inline">
                                        <li class="
                                            m-nav__item m-nav__item--focus m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width m-dropdown--skin-light	m-list-search m-list-search--skin-light"
                                            m-dropdown-toggle="click" m-dropdown-persistent="1" id="m_quicksearch" m-quicksearch-mode="dropdown">

                                            <div class="m-dropdown__wrapper">
                                                <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                                                <div class="m-dropdown__inner ">
                                                    <div class="m-dropdown__header">
                                                        <!-- <form  class="m-list-search__form">
                                                                <div class="m-list-search__form-wrapper">
                                                                                        <span class="m-list-search__form-input-wrapper">
                                                                                                <input id="m_quicksearch_input" autocomplete="off" type="text" name="q" class="m-list-search__form-input" value="" placeholder="Search...">
                                                                                        </span>
                                                                                        <span class="m-list-search__form-icon-close" id="m_quicksearch_close">
                                                                                                <i class="la la-remove"></i>
                                                                                        </span>
                                                                </div>
                                                        </form> -->
                                                    </div>
                                                    <div class="m-dropdown__body">
                                                        <div class="m-dropdown__scrollable m-scrollable" data-scrollable="true" data-max-height="300" data-mobile-max-height="200">
                                                            <div class="m-dropdown__content"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
                                            <a href="#" class="m-nav__link m-dropdown__toggle">
                                                <span class="m-topbar__userpic">
                                                    <img src="<?= app\helpers\Helper::getBaseUrl() ?>profile_image/<?= Yii::$app->user->identity->image ?>"  class="m--img-rounded m--marginless m--img-centered" alt="">
                                                </span>
                                                <span class="m-topbar__username m--hide">
                                                    <?= Yii::$app->user->identity->username ?>
                                                </span>

                                                <div class="m-dropdown__wrapper">
                                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                                    <div class="m-dropdown__inner">
                                                        <div class="m-dropdown__header m--align-center" style="background: url(<?= Yii::$app->homeUrl ?>src/assets/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">
                                                            <div class="m-card-user m-card-user--skin-dark">
                                                                <div class="m-card-user__pic">
                                                                    <img src="<?= app\helpers\Helper::getBaseUrl() ?>profile_image/<?= Yii::$app->user->identity->image ?>" class="m--img-rounded m--marginless" alt=""/>
                                                                </div>
                                                                <div class="m-card-user__details">
                                                                    <span class="m-card-user__name m--font-weight-500">
                                                                        <?= Yii::$app->user->identity->username ?>
                                                                    </span>
                                                                    <a href="" class="m-card-user__email m--font-weight-300 m-link">
                                                                        <?= Yii::$app->user->identity->email ?>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="m-dropdown__body">
                                                            <div class="m-dropdown__content">
                                                                <ul class="m-nav m-nav--skin-light">
                                                                    <li class="m-nav__section m--hide">
                                                                        <span class="m-nav__section-text">
                                                                            Section
                                                                        </span>
                                                                    </li>
                                                                    <li class="m-nav__item">
                                                                        <a href="<?= $baseUrl ?>user/profile" class="m-nav__link">
                                                                            <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                                            <span class="m-nav__link-title">
                                                                                <span class="m-nav__link-wrap">
                                                                                    <span class="m-nav__link-text">
                                                                                        Profile
                                                                                    </span>
                                                                                </span>
                                                                            </span>
                                                                        </a>
                                                                    </li>

                                                                    <li class="m-nav__separator m-nav__separator--fit"></li>


                                                                    <li class="m-nav__separator m-nav__separator--fit"></li>
                                                                    <li class="m-nav__item">
                                                                        <a href="<?= Yii::$app->homeUrl ?>site/logout" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">
                                                                            Logout
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- END: Topbar -->
                    </div>
                </div>
            </header>
            <!-- END: Header -->

            <!-- if login user is Department staff -->

            <!-- begin::Body -->
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body" style="background: #f2f3f8;">
                <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-container m-container--responsive m-container--xxl m-container--full-height">
                    <div class="m-grid__item m-grid__item--fluid m-wrapper">
                        <!-- BEGIN: Subheader -->
                        <!--<div class="m-subheader ">
                            <div class="d-flex align-items-center">
                                <div class="mr-auto">
                                    <h1 class="m-subheader__title m-subheader__title--separator">
                                        <?/*= Html::encode($this->title) */?>

                                    </h1>

                                        <?/*=
                                        Breadcrumbs::widget([
                                            'options' => ['class' => 'm-subheader__breadcrumbs m-nav m-nav--inline'],
                                            'activeItemTemplate' => '<li class="m-nav__item active">{link}</li>',
                                            'itemTemplate' => "<li class='m-nav__item'>{link}</li><li class=\"m-nav__separator\">/</li>\n",
                                            'homeLink' => [
                                                'label' => Yii::t('yii', 'Home'),
                                                'url' => Yii::$app->homeUrl,
                                            ],
                                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                        ])
                                        */?>

                                </div>

                            </div>
                        </div>-->
                        <!-- END: Subheader -->
                        <div class="m-content" style="margin-top:10px">

                            <div class="m-portlet__body">
                                <?= $content ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- end:: Body -->
            <!-- begin::Footer -->
            <footer class="m-grid__item  m-footer ">
                <div class="m-container m-container--responsive m-container--xxl m-container--full-height">
                    <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
                        <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
                            <span class="m-footer__copyright">
                                2018 &copy; Powered by
                                <a href="https://graystork.com" class="m-link">
                                    Graystork (PVT) LTD
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end::Footer -->
        </div>
        <!-- end:: Page -->
        <!-- begin::Scroll Top -->
        <div id="m_scroll_top" class="m-scroll-top">
            <i class="la la-arrow-up"></i>
        </div>
        <!-- end::Scroll Top -->            <!-- begin::Quick Nav -->


        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
