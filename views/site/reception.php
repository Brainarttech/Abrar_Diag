<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

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
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body  class="m--skin- m-content--skin-light m-header--fixed m-header--fixed-mobile m-aside-left--offcanvas-default m-aside-left--enabled m-aside-left--fixed m-aside-left--skin-dark m-aside--offcanvas-default"  >
<?php $this->beginBody() ?>
<style>

</style>

        <!-- begin:: Page -->
        <div class="m-grid m-grid--hor m-grid--root m-page">
            <!-- BEGIN: Header -->
            <header id="m_header" class="m-grid__item custom_header_background    m-header "  m-minimize="minimize" m-minimize-mobile="minimize" m-minimize-offset="200" m-minimize-mobile-offset="200" >
                <div class="m-container m-container--fluid m-container--full-height">
                    <div class="m-stack m-stack--ver m-stack--desktop  m-header__wrapper">
                        <!-- BEGIN: Brand -->
                        <div class="m-stack__item m-brand m-brand--mobile">
                            <div class="m-stack m-stack--ver m-stack--general">
                                <div class="m-stack__item m-stack__item--middle m-brand__logo">
                                    <a href="index.html" class="m-brand__logo-wrapper">
                                        <img alt="" src="assets/demo/demo9/media/img/logo/logo.png"/>
                                    </a>
                                </div>
                                <div class="m-stack__item m-stack__item--middle m-brand__tools">
                                    
                                   
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
                        <!-- END: Brand -->
                        <div class="m-stack__item m-stack__item--middle m-stack__item--left m-header-head" id="m_header_nav">
                            <div class="m-stack m-stack--ver m-stack--desktop">
                                <div class="m-stack__item m-stack__item--middle m-stack__item--fit">
                                    
                                </div>
                                <div class="m-stack__item m-stack__item--fluid">
                                    <!-- BEGIN: Horizontal Menu -->
                                    <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn">
                                        <i class="la la-close"></i>
                                    </button>
                                    <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark "  >
                                        <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">

                                            <li class="m-menu__item  m-menu__item--active  m-menu__item--rel">
                                                <a  href="<?=$baseUrl?>site/index" class="m-menu__link">
                                                    <span class="m-menu__item-here"></span>
                                                    <i class="m-menu__link-icon fa fa-home"></i>
                                                    <span class="m-menu__link-text">
                                                        Home
                                                    </span>
                                                    
                                                </a>

                                            </li>

                                            
                                            <li class="m-menu__item  m-menu__item--active  m-menu__item--submenu m-menu__item--rel"  m-menu-submenu-toggle="click" aria-haspopup="true">
                                                <a  href="javascript:;" class="m-menu__link m-menu__toggle">
                                                    <span class="m-menu__item-here"></span>
                                                    <i class="m-menu__link-icon flaticon-analytics"></i>
                                                    <span class="m-menu__link-text">
                                                        Front
                                                    </span>
                                                    <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                </a>
                                                <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                                    <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                    <ul class="m-menu__subnav">
                                                        <li class="m-menu__item  m-menu__item--active "  aria-haspopup="true">
                                                            <a  href="inner.html" class="m-menu__link ">
                                                                <i class="m-menu__link-icon flaticon-diagram"></i>
                                                                <span class="m-menu__link-title">
                                                                    <span class="m-menu__link-wrap">
                                                                        <span class="m-menu__link-text">
                                                                            Generate Reports
                                                                        </span>
                                                                        <span class="m-menu__link-badge">
                                                                            <span class="m-badge m-badge--success">
                                                                                2
                                                                            </span>
                                                                        </span>
                                                                    </span>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-menu__item  m-menu__item--submenu"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a  href="javascript:;" class="m-menu__link m-menu__toggle">
                                                                <i class="m-menu__link-icon flaticon-business"></i>
                                                                <span class="m-menu__link-text">
                                                                    Manage Orders
                                                                </span>
                                                                <i class="m-menu__hor-arrow la la-angle-right"></i>
                                                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                            </a>
                                                            <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                                <span class="m-menu__arrow "></span>
                                                                <ul class="m-menu__subnav">
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Latest Orders
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Pending Orders
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Processed Orders
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item  m-menu__item--submenu"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="javascript:;" class="m-menu__link m-menu__toggle">
                                                                            <i class="m-menu__link-icon flaticon-business"></i>
                                                                            <span class="m-menu__link-text">
                                                                                Delivered Orders
                                                                            </span>
                                                                            <i class="m-menu__hor-arrow la la-angle-right"></i>
                                                                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                        </a>
                                                                        <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                                            <span class="m-menu__arrow "></span>
                                                                            <ul class="m-menu__subnav">
                                                                                <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                                    <a  href="inner.html" class="m-menu__link ">
                                                                                        <span class="m-menu__link-text">
                                                                                            Latest Orders
                                                                                        </span>
                                                                                    </a>
                                                                                </li>
                                                                                <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                                    <a  href="inner.html" class="m-menu__link ">
                                                                                        <span class="m-menu__link-text">
                                                                                            Pending Orders
                                                                                        </span>
                                                                                    </a>
                                                                                </li>
                                                                                <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                                    <a  href="inner.html" class="m-menu__link ">
                                                                                        <span class="m-menu__link-text">
                                                                                            Processed Orders
                                                                                        </span>
                                                                                    </a>
                                                                                </li>
                                                                                <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                                    <a  href="inner.html" class="m-menu__link ">
                                                                                        <span class="m-menu__link-text">
                                                                                            Delivery Reports
                                                                                        </span>
                                                                                    </a>
                                                                                </li>
                                                                                <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                                    <a  href="inner.html" class="m-menu__link ">
                                                                                        <span class="m-menu__link-text">
                                                                                            Payments
                                                                                        </span>
                                                                                    </a>
                                                                                </li>
                                                                                <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                                    <a  href="inner.html" class="m-menu__link ">
                                                                                        <span class="m-menu__link-text">
                                                                                            Customers
                                                                                        </span>
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Payments
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Customers
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        <li class="m-menu__item  m-menu__item--submenu"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a  href="javascript:;" class="m-menu__link m-menu__toggle">
                                                                <i class="m-menu__link-icon flaticon-chat-1"></i>
                                                                <span class="m-menu__link-text">
                                                                    Customer Feedbacks
                                                                </span>
                                                                <i class="m-menu__hor-arrow la la-angle-right"></i>
                                                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                            </a>
                                                            <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                                <span class="m-menu__arrow "></span>
                                                                <ul class="m-menu__subnav">
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Customer Feedbacks
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Supplier Feedbacks
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Reviewed Feedbacks
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Resolved Feedbacks
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Feedback Reports
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a  href="inner.html" class="m-menu__link ">
                                                                <i class="m-menu__link-icon flaticon-users"></i>
                                                                <span class="m-menu__link-text">
                                                                    Register Member
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>

                                            <li class="m-menu__item  m-menu__item--submenu"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                                <a  href="javascript:;" class="m-menu__link m-menu__toggle">
                                                    <span class="m-menu__item-here"></span>
                                                    <i class="m-menu__link-icon flaticon-book"></i>
                                                    <span class="m-menu__link-text">
                                                        Inventory
                                                    </span>
                                                    <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                </a>
                                                <div class="m-menu__submenu  m-menu__submenu--fixed-xl m-menu__submenu--center" >
                                                    <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                    <div class="m-menu__subnav">
                                                        <ul class="m-menu__content">
                                                           <li class="m-menu__item">
                                                                <h3 class="m-menu__heading m-menu__toggle">
                                                                    <span class="m-menu__link-text">
                                                                        Products
                                                                    </span>
                                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                </h3>
                                                                <ul class="m-menu__inner">
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Add New Products
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                All Products
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Product Categories
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Prodcut Pricing
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    
                                                                    
                                                                </ul>
                                                            </li>

                                                            <li class="m-menu__item">
                                                                <h3 class="m-menu__heading m-menu__toggle">
                                                                    <span class="m-menu__link-text">
                                                                        Purchasing
                                                                    </span>
                                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                </h3>
                                                                <ul class="m-menu__inner">
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Add New Purchase Order
                                                                            </span>
                                                                        </a>
                                                                    </li>



                                                                    <li class="m-menu__item  "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Purchase Order List
                                                                            </span>
                                                                        </a>


                                                                    </li>


                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Add New Supplier
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Supplier List
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    
                                                                    
                                                                </ul>
                                                            </li>
                                                            
                                                            <li class="m-menu__item">
                                                                <h3 class="m-menu__heading m-menu__toggle">
                                                                    <span class="m-menu__link-text">
                                                                        Sales
                                                                    </span>
                                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                </h3>
                                                                <ul class="m-menu__inner">

                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Add New Sales Quote
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Sale Quote List
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Add New Sales Order
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Sale Order List
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Add New Customer
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Customer List
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    
                                                                    
                                                                </ul>
                                                            </li>

                                                            <li class="m-menu__item">
                                                                <h3 class="m-menu__heading m-menu__toggle">
                                                                    <span class="m-menu__link-text">
                                                                        Stock
                                                                    </span>
                                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                </h3>
                                                                <ul class="m-menu__inner">
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Current Stock
                                                                            </span>
                                                                        </a>
                                                                    </li>



                                                                    <li class="m-menu__item  "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Adjust Stock
                                                                            </span>
                                                                        </a>


                                                                    </li>


                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Transfer Stock
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                ReOrder Stock
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    
                                                                    
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="m-menu__item  m-menu__item--submenu"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                                <a  href="javascript:;" class="m-menu__link m-menu__toggle">
                                                    <span class="m-menu__item-here"></span>
                                                    <i class="m-menu__link-icon flaticon-stopwatch"></i>
                                                    <span class="m-menu__link-text">
                                                        HR
                                                    </span>
                                                    <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                </a>
                                                <div class="m-menu__submenu  m-menu__submenu--fixed-xl m-menu__submenu--center" >
                                                    <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                    <div class="m-menu__subnav">
                                                        <ul class="m-menu__content">
                                                            <li class="m-menu__item">
                                                                <h3 class="m-menu__heading m-menu__toggle">
                                                                    <span class="m-menu__link-text">
                                                                        Finance Reports
                                                                    </span>
                                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                </h3>
                                                                <ul class="m-menu__inner">
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-map"></i>
                                                                            <span class="m-menu__link-text">
                                                                                Annual Reports
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-user"></i>
                                                                            <span class="m-menu__link-text">
                                                                                HR Reports
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-clipboard"></i>
                                                                            <span class="m-menu__link-text">
                                                                                IPO Reports
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-graphic-1"></i>
                                                                            <span class="m-menu__link-text">
                                                                                Finance Margins
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-graphic-2"></i>
                                                                            <span class="m-menu__link-text">
                                                                                Revenue Reports
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li class="m-menu__item">
                                                                <h3 class="m-menu__heading m-menu__toggle">
                                                                    <span class="m-menu__link-text">
                                                                        Project Reports
                                                                    </span>
                                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                </h3>
                                                                <ul class="m-menu__inner">
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Coca Cola CRM
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Delta Airlines Booking Site
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Malibu Accounting
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Vineseed Website Rewamp
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Zircon Mobile App
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Mercury CMS
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li class="m-menu__item">
                                                                <h3 class="m-menu__heading m-menu__toggle">
                                                                    <span class="m-menu__link-text">
                                                                        HR Reports
                                                                    </span>
                                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                </h3>
                                                                <ul class="m-menu__inner">
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Staff Directory
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Client Directory
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Salary Reports
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Staff Payslips
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Corporate Expenses
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Project Expenses
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li class="m-menu__item">
                                                                <h3 class="m-menu__heading m-menu__toggle">
                                                                    <span class="m-menu__link-text">
                                                                        Reporting Apps
                                                                    </span>
                                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                </h3>
                                                                <ul class="m-menu__inner">
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Report Adjusments
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Sources & Mediums
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Reporting Settings
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Conversions
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Report Flows
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Audit & Logs
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="m-menu__item  m-menu__item--submenu"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                                <a  href="javascript:;" class="m-menu__link m-menu__toggle">
                                                    <span class="m-menu__item-here"></span>
                                                    <i class="m-menu__link-icon flaticon-stopwatch"></i>
                                                    <span class="m-menu__link-text">
                                                        Accounts
                                                    </span>
                                                    <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                </a>
                                                <div class="m-menu__submenu  m-menu__submenu--fixed-xl m-menu__submenu--center" >
                                                    <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                    <div class="m-menu__subnav">
                                                        <ul class="m-menu__content">
                                                            <li class="m-menu__item">
                                                                <h3 class="m-menu__heading m-menu__toggle">
                                                                    <span class="m-menu__link-text">
                                                                        Finance Reports
                                                                    </span>
                                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                </h3>
                                                                <ul class="m-menu__inner">
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-map"></i>
                                                                            <span class="m-menu__link-text">
                                                                                Annual Reports
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-user"></i>
                                                                            <span class="m-menu__link-text">
                                                                                HR Reports
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-clipboard"></i>
                                                                            <span class="m-menu__link-text">
                                                                                IPO Reports
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-graphic-1"></i>
                                                                            <span class="m-menu__link-text">
                                                                                Finance Margins
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-graphic-2"></i>
                                                                            <span class="m-menu__link-text">
                                                                                Revenue Reports
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li class="m-menu__item">
                                                                <h3 class="m-menu__heading m-menu__toggle">
                                                                    <span class="m-menu__link-text">
                                                                        Project Reports
                                                                    </span>
                                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                </h3>
                                                                <ul class="m-menu__inner">
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Coca Cola CRM
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Delta Airlines Booking Site
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Malibu Accounting
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Vineseed Website Rewamp
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Zircon Mobile App
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Mercury CMS
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li class="m-menu__item">
                                                                <h3 class="m-menu__heading m-menu__toggle">
                                                                    <span class="m-menu__link-text">
                                                                        HR Reports
                                                                    </span>
                                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                </h3>
                                                                <ul class="m-menu__inner">
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Staff Directory
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Client Directory
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Salary Reports
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Staff Payslips
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Corporate Expenses
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Project Expenses
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li class="m-menu__item">
                                                                <h3 class="m-menu__heading m-menu__toggle">
                                                                    <span class="m-menu__link-text">
                                                                        Reporting Apps
                                                                    </span>
                                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                </h3>
                                                                <ul class="m-menu__inner">
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Report Adjusments
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Sources & Mediums
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Reporting Settings
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Conversions
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Report Flows
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Audit & Logs
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>


                                            <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                                <a  href="javascript:;" class="m-menu__link m-menu__toggle">
                                                    <span class="m-menu__item-here"></span>
                                                    <i class="m-menu__link-icon flaticon-notes"></i>
                                                    <span class="m-menu__link-text">
                                                        Reports
                                                    </span>
                                                    <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                </a>
                                                <div class="m-menu__submenu  m-menu__submenu--fixed m-menu__submenu--left" style="width:600px">
                                                    <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                    <div class="m-menu__subnav">
                                                        <ul class="m-menu__content">
                                                            <li class="m-menu__item">
                                                                <h3 class="m-menu__heading m-menu__toggle">
                                                                    <span class="m-menu__link-text">
                                                                        Finance Reports
                                                                    </span>
                                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                </h3>
                                                                <ul class="m-menu__inner">
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-map"></i>
                                                                            <span class="m-menu__link-text">
                                                                                Annual Reports
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-user"></i>
                                                                            <span class="m-menu__link-text">
                                                                                HR Reports
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-clipboard"></i>
                                                                            <span class="m-menu__link-text">
                                                                                IPO Reports
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-graphic-1"></i>
                                                                            <span class="m-menu__link-text">
                                                                                Finance Margins
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-graphic-2"></i>
                                                                            <span class="m-menu__link-text">
                                                                                Revenue Reports
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li class="m-menu__item">
                                                                <h3 class="m-menu__heading m-menu__toggle">
                                                                    <span class="m-menu__link-text">
                                                                        Project Reports
                                                                    </span>
                                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                </h3>
                                                                <ul class="m-menu__inner">
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Coca Cola CRM
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Delta Airlines Booking Site
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Malibu Accounting
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Vineseed Website Rewamp
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Zircon Mobile App
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Mercury CMS
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="m-menu__item  m-menu__item--submenu"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                                <a  href="javascript:;" class="m-menu__link m-menu__toggle">
                                                    <span class="m-menu__item-here"></span>
                                                    <i class="m-menu__link-icon flaticon-stopwatch"></i>
                                                    <span class="m-menu__link-text">
                                                        Setting
                                                    </span>
                                                    <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                </a>
                                                <div class="m-menu__submenu  m-menu__submenu--fixed-xl m-menu__submenu--center" >
                                                    <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                    <div class="m-menu__subnav">
                                                        <ul class="m-menu__content">
                                                            <li class="m-menu__item">
                                                                <h3 class="m-menu__heading m-menu__toggle">
                                                                    <span class="m-menu__link-text">
                                                                        Finance Reports
                                                                    </span>
                                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                </h3>
                                                                <ul class="m-menu__inner">
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-map"></i>
                                                                            <span class="m-menu__link-text">
                                                                                Annual Reports
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-user"></i>
                                                                            <span class="m-menu__link-text">
                                                                                HR Reports
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-clipboard"></i>
                                                                            <span class="m-menu__link-text">
                                                                                IPO Reports
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-graphic-1"></i>
                                                                            <span class="m-menu__link-text">
                                                                                Finance Margins
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-icon flaticon-graphic-2"></i>
                                                                            <span class="m-menu__link-text">
                                                                                Revenue Reports
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li class="m-menu__item">
                                                                <h3 class="m-menu__heading m-menu__toggle">
                                                                    <span class="m-menu__link-text">
                                                                        Project Reports
                                                                    </span>
                                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                </h3>
                                                                <ul class="m-menu__inner">
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Coca Cola CRM
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Delta Airlines Booking Site
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Malibu Accounting
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Vineseed Website Rewamp
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Zircon Mobile App
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Mercury CMS
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li class="m-menu__item">
                                                                <h3 class="m-menu__heading m-menu__toggle">
                                                                    <span class="m-menu__link-text">
                                                                        HR Reports
                                                                    </span>
                                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                </h3>
                                                                <ul class="m-menu__inner">
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Staff Directory
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Client Directory
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Salary Reports
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Staff Payslips
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Corporate Expenses
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                                <span></span>
                                                                            </i>
                                                                            <span class="m-menu__link-text">
                                                                                Project Expenses
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li class="m-menu__item">
                                                                <h3 class="m-menu__heading m-menu__toggle">
                                                                    <span class="m-menu__link-text">
                                                                        Reporting Apps
                                                                    </span>
                                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                </h3>
                                                                <ul class="m-menu__inner">
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Report Adjusments
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Sources & Mediums
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Reporting Settings
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Conversions
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Report Flows
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                        <a  href="inner.html" class="m-menu__link ">
                                                                            <span class="m-menu__link-text">
                                                                                Audit & Logs
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- END: Horizontal Menu -->
                                </div>
                            </div>
                        </div>
                        <!-- <div class="m-stack__item m-stack__item--middle m-stack__item--center">
                           
                            <a href="index.html" class="m-brand m-brand--desktop">
                                <h4>Abrar Diagnostic Centre</h4>
                            </a>
                        
                        </div> -->
                        <div class="m-stack__item m-stack__item--right">
                            <!-- BEGIN: Topbar -->
                            <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                                <div class="m-stack__item m-topbar__nav-wrapper">
                                    <ul class="m-topbar__nav m-nav m-nav--inline">
                                        
                                        <li class="m-nav__item m-nav__item--accent m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center  m-dropdown--mobile-full-width" m-dropdown-toggle="click" m-dropdown-persistent="1">
                                            <a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
                                                <span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span>
                                                <span class="m-nav__link-icon">
                                                    <span class="m-nav__link-icon-wrapper">
                                                        <i class="flaticon-music-2"></i>
                                                    </span>
                                                </span>
                                            </a>
                                            <div class="m-dropdown__wrapper">
                                                <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                                                <div class="m-dropdown__inner">
                                                    <div class="m-dropdown__header m--align-center">
                                                        <span class="m-dropdown__header-title">
                                                            9 New
                                                        </span>
                                                        <span class="m-dropdown__header-subtitle">
                                                            User Notifications
                                                        </span>
                                                    </div>
                                                    <div class="m-dropdown__body">
                                                        <div class="m-dropdown__content">
                                                            <ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
                                                                <li class="nav-item m-tabs__item">
                                                                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#topbar_notifications_notifications" role="tab">
                                                                        Alerts
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item m-tabs__item">
                                                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#topbar_notifications_events" role="tab">
                                                                        Events
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item m-tabs__item">
                                                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#topbar_notifications_logs" role="tab">
                                                                        Logs
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                            <div class="tab-content">
                                                                <div class="tab-pane active" id="topbar_notifications_notifications" role="tabpanel">
                                                                    <div class="m-scrollable" data-scrollable="true" data-max-height="250" data-mobile-max-height="200">
                                                                        <div class="m-list-timeline m-list-timeline--skin-light">
                                                                            <div class="m-list-timeline__items">
                                                                                <div class="m-list-timeline__item">
                                                                                    <span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
                                                                                    <span class="m-list-timeline__text">
                                                                                        12 new users registered
                                                                                    </span>
                                                                                    <span class="m-list-timeline__time">
                                                                                        Just now
                                                                                    </span>
                                                                                </div>
                                                                                <div class="m-list-timeline__item">
                                                                                    <span class="m-list-timeline__badge"></span>
                                                                                    <span class="m-list-timeline__text">
                                                                                        System shutdown
                                                                                        <span class="m-badge m-badge--success m-badge--wide">
                                                                                            pending
                                                                                        </span>
                                                                                    </span>
                                                                                    <span class="m-list-timeline__time">
                                                                                        14 mins
                                                                                    </span>
                                                                                </div>
                                                                                <div class="m-list-timeline__item">
                                                                                    <span class="m-list-timeline__badge"></span>
                                                                                    <span class="m-list-timeline__text">
                                                                                        New invoice received
                                                                                    </span>
                                                                                    <span class="m-list-timeline__time">
                                                                                        20 mins
                                                                                    </span>
                                                                                </div>
                                                                                <div class="m-list-timeline__item">
                                                                                    <span class="m-list-timeline__badge"></span>
                                                                                    <span class="m-list-timeline__text">
                                                                                        DB overloaded 80%
                                                                                        <span class="m-badge m-badge--info m-badge--wide">
                                                                                            settled
                                                                                        </span>
                                                                                    </span>
                                                                                    <span class="m-list-timeline__time">
                                                                                        1 hr
                                                                                    </span>
                                                                                </div>
                                                                                <div class="m-list-timeline__item">
                                                                                    <span class="m-list-timeline__badge"></span>
                                                                                    <span class="m-list-timeline__text">
                                                                                        System error -
                                                                                        <a href="#" class="m-link">
                                                                                            Check
                                                                                        </a>
                                                                                    </span>
                                                                                    <span class="m-list-timeline__time">
                                                                                        2 hrs
                                                                                    </span>
                                                                                </div>
                                                                                <div class="m-list-timeline__item m-list-timeline__item--read">
                                                                                    <span class="m-list-timeline__badge"></span>
                                                                                    <span href="" class="m-list-timeline__text">
                                                                                        New order received
                                                                                        <span class="m-badge m-badge--danger m-badge--wide">
                                                                                            urgent
                                                                                        </span>
                                                                                    </span>
                                                                                    <span class="m-list-timeline__time">
                                                                                        7 hrs
                                                                                    </span>
                                                                                </div>
                                                                                <div class="m-list-timeline__item m-list-timeline__item--read">
                                                                                    <span class="m-list-timeline__badge"></span>
                                                                                    <span class="m-list-timeline__text">
                                                                                        Production server down
                                                                                    </span>
                                                                                    <span class="m-list-timeline__time">
                                                                                        3 hrs
                                                                                    </span>
                                                                                </div>
                                                                                <div class="m-list-timeline__item">
                                                                                    <span class="m-list-timeline__badge"></span>
                                                                                    <span class="m-list-timeline__text">
                                                                                        Production server up
                                                                                    </span>
                                                                                    <span class="m-list-timeline__time">
                                                                                        5 hrs
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane" id="topbar_notifications_events" role="tabpanel">
                                                                    <div class="m-scrollable" data-scrollable="true" data-max-height="250" data-mobile-max-height="200">
                                                                        <div class="m-list-timeline m-list-timeline--skin-light">
                                                                            <div class="m-list-timeline__items">
                                                                                <div class="m-list-timeline__item">
                                                                                    <span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>
                                                                                    <a href="" class="m-list-timeline__text">
                                                                                        New order received
                                                                                    </a>
                                                                                    <span class="m-list-timeline__time">
                                                                                        Just now
                                                                                    </span>
                                                                                </div>
                                                                                <div class="m-list-timeline__item">
                                                                                    <span class="m-list-timeline__badge m-list-timeline__badge--state1-danger"></span>
                                                                                    <a href="" class="m-list-timeline__text">
                                                                                        New invoice received
                                                                                    </a>
                                                                                    <span class="m-list-timeline__time">
                                                                                        20 mins
                                                                                    </span>
                                                                                </div>
                                                                                <div class="m-list-timeline__item">
                                                                                    <span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>
                                                                                    <a href="" class="m-list-timeline__text">
                                                                                        Production server up
                                                                                    </a>
                                                                                    <span class="m-list-timeline__time">
                                                                                        5 hrs
                                                                                    </span>
                                                                                </div>
                                                                                <div class="m-list-timeline__item">
                                                                                    <span class="m-list-timeline__badge m-list-timeline__badge--state1-info"></span>
                                                                                    <a href="" class="m-list-timeline__text">
                                                                                        New order received
                                                                                    </a>
                                                                                    <span class="m-list-timeline__time">
                                                                                        7 hrs
                                                                                    </span>
                                                                                </div>
                                                                                <div class="m-list-timeline__item">
                                                                                    <span class="m-list-timeline__badge m-list-timeline__badge--state1-info"></span>
                                                                                    <a href="" class="m-list-timeline__text">
                                                                                        System shutdown
                                                                                    </a>
                                                                                    <span class="m-list-timeline__time">
                                                                                        11 mins
                                                                                    </span>
                                                                                </div>
                                                                                <div class="m-list-timeline__item">
                                                                                    <span class="m-list-timeline__badge m-list-timeline__badge--state1-info"></span>
                                                                                    <a href="" class="m-list-timeline__text">
                                                                                        Production server down
                                                                                    </a>
                                                                                    <span class="m-list-timeline__time">
                                                                                        3 hrs
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
                                                                    <div class="m-stack m-stack--ver m-stack--general" style="min-height: 180px;">
                                                                        <div class="m-stack__item m-stack__item--center m-stack__item--middle">
                                                                            <span class="">
                                                                                All caught up!
                                                                                <br>
                                                                                No new logs.
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                     
                                        <li class="m-nav__item m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
                                            <a href="#" class="m-nav__link m-dropdown__toggle">
                                                <span class="m-topbar__username m--hidden-mobile">
                                                    Mark
                                                </span>
                                                <span class="m-topbar__userpic">
                                                    <img src="http://localhost/metronic/metronic_v5.2/default/dist/demo11/assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless m--img-centered" alt=""/>
                                                </span>
                                                <span class="m-nav__link-icon m-topbar__usericon  m--hide">
                                                    <span class="m-nav__link-icon-wrapper">
                                                        <i class="flaticon-user-ok"></i>
                                                    </span>
                                                </span>
                                            </a>
                                            <div class="m-dropdown__wrapper">
                                                <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                                <div class="m-dropdown__inner">
                                                    <div class="m-dropdown__header m--align-center">
                                                        <div class="m-card-user m-card-user--skin-light">
                                                            <div class="m-card-user__pic">
                                                                <img src="http://localhost/metronic/metronic_v5.2/default/dist/demo11/assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless" alt=""/>
                                                            </div>
                                                            <div class="m-card-user__details">
                                                                <span class="m-card-user__name m--font-weight-500">
                                                                    Mark Andre
                                                                </span>
                                                                <a href="" class="m-card-user__email m--font-weight-300 m-link">
                                                                    mark.andre@gmail.com
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
                                                                    <a href="profile.html" class="m-nav__link">
                                                                        <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                                        <span class="m-nav__link-title">
                                                                            <span class="m-nav__link-wrap">
                                                                                <span class="m-nav__link-text">
                                                                                    My Profile
                                                                                </span>
                                                                                <span class="m-nav__link-badge">
                                                                                    <span class="m-badge m-badge--success">
                                                                                        2
                                                                                    </span>
                                                                                </span>
                                                                            </span>
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="m-nav__item">
                                                                    <a href="profile.html" class="m-nav__link">
                                                                        <i class="m-nav__link-icon flaticon-share"></i>
                                                                        <span class="m-nav__link-text">
                                                                            Activity
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="m-nav__item">
                                                                    <a href="profile.html" class="m-nav__link">
                                                                        <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                                        <span class="m-nav__link-text">
                                                                            Messages
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="m-nav__separator m-nav__separator--fit"></li>
                                                                <li class="m-nav__item">
                                                                    <a href="profile.html" class="m-nav__link">
                                                                        <i class="m-nav__link-icon flaticon-info"></i>
                                                                        <span class="m-nav__link-text">
                                                                            FAQ
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="m-nav__item">
                                                                    <a href="profile.html" class="m-nav__link">
                                                                        <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                                        <span class="m-nav__link-text">
                                                                            Support
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="m-nav__separator m-nav__separator--fit"></li>
                                                                <li class="m-nav__item">
                                                                    <a href="snippets/pages/user/login-1.html" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">
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
                            <!-- END: Topbar -->
                        </div>
                    </div>
                </div>
            </header>
            <!-- END: Header -->        
                                <!-- BEGIN: Left Aside -->
            <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
                <i class="la la-close"></i>
            </button>
            <div id="m_aside_left" class="m-aside-left  m-aside-left--skin-dark ">
                <!-- BEGIN: Aside Menu -->
    <div 
        id="m_ver_menu" 
        class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " 
        data-menu-vertical="true"
         m-menu-scrollable="1" m-menu-dropdown-timeout="500"  
        >
                    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
                        <li class="m-menu__section m-menu__section--first">
                            <h4 class="m-menu__section-text">
                                Departments
                            </h4>
                            <i class="m-menu__section-icon flaticon-more-v3"></i>
                        </li>
                        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  m-menu-submenu-toggle="hover">
                            <a  href="javascript:;" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-icon flaticon-layers"></i>
                                <span class="m-menu__link-text">
                                    Resources
                                </span>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="m-menu__submenu ">
                                <span class="m-menu__arrow"></span>
                                <ul class="m-menu__subnav">
                                    <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
                                        <span class="m-menu__link">
                                            <span class="m-menu__link-text">
                                                Resources
                                            </span>
                                        </span>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
                                        <a  href="inner.html" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">
                                                Timesheet
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
                                        <a  href="inner.html" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">
                                                Payroll
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
                                        <a  href="inner.html" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">
                                                Contacts
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
                            <a  href="inner.html" class="m-menu__link ">
                                <i class="m-menu__link-icon flaticon-suitcase"></i>
                                <span class="m-menu__link-text">
                                    Finance
                                </span>
                            </a>
                        </li>
                        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1">
                            <a  href="javascript:;" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-icon flaticon-graphic-1"></i>
                                <span class="m-menu__link-title">
                                    <span class="m-menu__link-wrap">
                                        <span class="m-menu__link-text">
                                            Support
                                        </span>
                                        <span class="m-menu__link-badge">
                                            <span class="m-badge m-badge--accent">
                                                3
                                            </span>
                                        </span>
                                    </span>
                                </span>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="m-menu__submenu ">
                                <span class="m-menu__arrow"></span>
                                <ul class="m-menu__subnav">
                                    <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"  m-menu-link-redirect="1">
                                        <span class="m-menu__link">
                                            <span class="m-menu__link-title">
                                                <span class="m-menu__link-wrap">
                                                    <span class="m-menu__link-text">
                                                        Support
                                                    </span>
                                                    <span class="m-menu__link-badge">
                                                        <span class="m-badge m-badge--accent">
                                                            3
                                                        </span>
                                                    </span>
                                                </span>
                                            </span>
                                        </span>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
                                        <a  href="inner.html" class="m-menu__link ">
                                            <span class="m-menu__link-text">
                                                Reports
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1">
                                        <a  href="javascript:;" class="m-menu__link m-menu__toggle">
                                            <span class="m-menu__link-text">
                                                Cases
                                            </span>
                                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                                        </a>
                                        <div class="m-menu__submenu ">
                                            <span class="m-menu__arrow"></span>
                                            <ul class="m-menu__subnav">
                                                <li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
                                                    <a  href="inner.html" class="m-menu__link ">
                                                        <span class="m-menu__link-text">
                                                            Pending
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
                                                    <a  href="inner.html" class="m-menu__link ">
                                                        <span class="m-menu__link-text">
                                                            Urgent
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
                                                    <a  href="inner.html" class="m-menu__link ">
                                                        <span class="m-menu__link-text">
                                                            Done
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
                                                    <a  href="inner.html" class="m-menu__link ">
                                                        <span class="m-menu__link-text">
                                                            Archive
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
                                        <a  href="inner.html" class="m-menu__link ">
                                            <span class="m-menu__link-text">
                                                Clients
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
                                        <a  href="inner.html" class="m-menu__link ">
                                            <span class="m-menu__link-text">
                                                Audit
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
                            <a  href="inner.html" class="m-menu__link ">
                                <i class="m-menu__link-icon flaticon-light"></i>
                                <span class="m-menu__link-text">
                                    Administration
                                </span>
                            </a>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
                            <a  href="inner.html" class="m-menu__link ">
                                <i class="m-menu__link-icon flaticon-share"></i>
                                <span class="m-menu__link-text">
                                    Management
                                </span>
                            </a>
                        </li>
                        <li class="m-menu__section ">
                            <h4 class="m-menu__section-text">
                                Reports
                            </h4>
                            <i class="m-menu__section-icon flaticon-more-v3"></i>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
                            <a  href="inner.html" class="m-menu__link ">
                                <i class="m-menu__link-icon flaticon-graphic"></i>
                                <span class="m-menu__link-text">
                                    Accounting
                                </span>
                            </a>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
                            <a  href="inner.html" class="m-menu__link ">
                                <i class="m-menu__link-icon flaticon-network"></i>
                                <span class="m-menu__link-text">
                                    Products
                                </span>
                            </a>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
                            <a  href="inner.html" class="m-menu__link ">
                                <i class="m-menu__link-icon flaticon-network"></i>
                                <span class="m-menu__link-text">
                                    Sales
                                </span>
                            </a>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
                            <a  href="inner.html" class="m-menu__link ">
                                <i class="m-menu__link-icon flaticon-alert"></i>
                                <span class="m-menu__link-title">
                                    <span class="m-menu__link-wrap">
                                        <span class="m-menu__link-text">
                                            Bills
                                        </span>
                                        <span class="m-menu__link-badge">
                                            <span class="m-badge m-badge--danger">
                                                12
                                            </span>
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
                            <a  href="inner.html" class="m-menu__link ">
                                <i class="m-menu__link-icon flaticon-technology"></i>
                                <span class="m-menu__link-text">
                                    IPO
                                </span>
                            </a>
                        </li>
                        <li class="m-menu__section ">
                            <h4 class="m-menu__section-text">
                                System
                            </h4>
                            <i class="m-menu__section-icon flaticon-more-v3"></i>
                        </li>
                        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  m-menu-submenu-toggle="hover">
                            <a  href="javascript:;" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-icon flaticon-clipboard"></i>
                                <span class="m-menu__link-text">
                                    Applications
                                </span>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="m-menu__submenu ">
                                <span class="m-menu__arrow"></span>
                                <ul class="m-menu__subnav">
                                    <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
                                        <span class="m-menu__link">
                                            <span class="m-menu__link-text">
                                                Applications
                                            </span>
                                        </span>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
                                        <a  href="inner.html" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">
                                                Audit
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
                                        <a  href="inner.html" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">
                                                Notifications
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
                                        <a  href="inner.html" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">
                                                Messages
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  m-menu-submenu-toggle="hover">
                            <a  href="javascript:;" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-icon flaticon-computer"></i>
                                <span class="m-menu__link-text">
                                    Modules
                                </span>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="m-menu__submenu ">
                                <span class="m-menu__arrow"></span>
                                <ul class="m-menu__subnav">
                                    <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
                                        <span class="m-menu__link">
                                            <span class="m-menu__link-text">
                                                Modules
                                            </span>
                                        </span>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
                                        <a  href="inner.html" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">
                                                Logs
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
                                        <a  href="inner.html" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">
                                                Errors
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
                                        <a  href="inner.html" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">
                                                Configuration
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
                            <a  href="inner.html" class="m-menu__link ">
                                <i class="m-menu__link-icon flaticon-cogwheel"></i>
                                <span class="m-menu__link-text">
                                    Files
                                </span>
                            </a>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
                            <a  href="inner.html" class="m-menu__link ">
                                <i class="m-menu__link-icon flaticon-lifebuoy"></i>
                                <span class="m-menu__link-text">
                                    Security
                                </span>
                            </a>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1">
                            <a  href="inner.html" class="m-menu__link ">
                                <i class="m-menu__link-icon flaticon-settings"></i>
                                <span class="m-menu__link-text">
                                    Options
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- END: Aside Menu -->
            </div>
            <!-- END: Left Aside -->                    
        <!-- begin::Body -->
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
                <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-container m-container--responsive m-container--xxl m-container--full-height">
                    <div class="m-grid__item m-grid__item--fluid m-wrapper">
                        <!-- BEGIN: Subheader -->
                        <div class="m-subheader ">
                            <div class="d-flex align-items-center">
                                <div class="mr-auto">
                                    <h3 class="m-subheader__title m-subheader__title--separator">
                                        Dashboard
                                    </h3>
                                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                                        <li class="m-nav__item m-nav__item--home">
                                            <a href="#" class="m-nav__link m-nav__link--icon">
                                                <i class="m-nav__link-icon la la-home"></i>
                                            </a>
                                        </li>
                                        <li class="m-nav__separator">
                                            -
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="" class="m-nav__link">
                                                <span class="m-nav__link-text">
                                                    Dashboard
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-nav__separator">
                                            -
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="" class="m-nav__link">
                                                <span class="m-nav__link-text">
                                                    Generate Reports
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                
                            </div>
                        </div>
                        <!-- END: Subheader -->
                        <div class="m-content">
                              <?= $content ?>
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
                                2017 &copy; Metronic theme by
                                <a href="https://keenthemes.com" class="m-link">
                                    Keenthemes
                                </a>
                            </span>
                        </div>
                        <div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
                            <ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
                                <li class="m-nav__item">
                                    <a href="#" class="m-nav__link">
                                        <span class="m-nav__link-text">
                                            About
                                        </span>
                                    </a>
                                </li>
                                <li class="m-nav__item">
                                    <a href="#"  class="m-nav__link">
                                        <span class="m-nav__link-text">
                                            Privacy
                                        </span>
                                    </a>
                                </li>
                                <li class="m-nav__item">
                                    <a href="#" class="m-nav__link">
                                        <span class="m-nav__link-text">
                                            T&C
                                        </span>
                                    </a>
                                </li>
                                <li class="m-nav__item">
                                    <a href="#" class="m-nav__link">
                                        <span class="m-nav__link-text">
                                            Purchase
                                        </span>
                                    </a>
                                </li>
                                <li class="m-nav__item m-nav__item--last">
                                    <a href="#" class="m-nav__link" data-toggle="m-tooltip" title="Support Center" data-placement="left">
                                        <i class="m-nav__link-icon flaticon-info m--icon-font-size-lg3"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end::Footer -->
        </div>
        <!-- end:: Page -->
                    <!-- begin::Quick Sidebar -->
        <div id="m_quick_sidebar" class="m-quick-sidebar m-quick-sidebar--tabbed m-quick-sidebar--skin-light">
            <div class="m-quick-sidebar__content m--hide">
                <span id="m_quick_sidebar_close" class="m-quick-sidebar__close">
                    <i class="la la-close"></i>
                </span>
                <ul id="m_quick_sidebar_tabs" class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_quick_sidebar_tabs_messenger" role="tab">
                            Messages
                        </a>
                    </li>
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link"        data-toggle="tab" href="#m_quick_sidebar_tabs_settings" role="tab">
                            Settings
                        </a>
                    </li>
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_quick_sidebar_tabs_logs" role="tab">
                            Logs
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active m-scrollable" id="m_quick_sidebar_tabs_messenger" role="tabpanel">
                        <div class="m-messenger m-messenger--message-arrow m-messenger--skin-light">
                            <div class="m-messenger__messages">
                                <div class="m-messenger__wrapper">
                                    <div class="m-messenger__message m-messenger__message--in">
                                        <div class="m-messenger__message-pic">
                                            <img src="http://localhost/metronic/metronic_v5.2/default/dist/demo11/assets/app/media/img/users/user4.jpg" alt=""/>
                                        </div>
                                        <div class="m-messenger__message-body">
                                            <div class="m-messenger__message-arrow"></div>
                                            <div class="m-messenger__message-content">
                                                <div class="m-messenger__message-username">
                                                    Megan wrote
                                                </div>
                                                <div class="m-messenger__message-text">
                                                    Hi Bob. What time will be the meeting ?
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-messenger__wrapper">
                                    <div class="m-messenger__message m-messenger__message--out">
                                        <div class="m-messenger__message-body">
                                            <div class="m-messenger__message-arrow"></div>
                                            <div class="m-messenger__message-content">
                                                <div class="m-messenger__message-text">
                                                    Hi Megan. It's at 2.30PM
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-messenger__wrapper">
                                    <div class="m-messenger__message m-messenger__message--in">
                                        <div class="m-messenger__message-pic">
                                            <!-- <img src="assets/app/media/img//users/user3.jpg" alt=""/> -->
                                        </div>
                                        <div class="m-messenger__message-body">
                                            <div class="m-messenger__message-arrow"></div>
                                            <div class="m-messenger__message-content">
                                                <div class="m-messenger__message-username">
                                                    Megan wrote
                                                </div>
                                                <div class="m-messenger__message-text">
                                                    Will the development team be joining ?
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-messenger__wrapper">
                                    <div class="m-messenger__message m-messenger__message--out">
                                        <div class="m-messenger__message-body">
                                            <div class="m-messenger__message-arrow"></div>
                                            <div class="m-messenger__message-content">
                                                <div class="m-messenger__message-text">
                                                    Yes sure. I invited them as well
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-messenger__datetime">
                                    2:30PM
                                </div>
                                <div class="m-messenger__wrapper">
                                    <div class="m-messenger__message m-messenger__message--in">
                                        <div class="m-messenger__message-pic">
                                            <!-- <img src="assets/app/media/img//users/user3.jpg"  alt=""/> -->
                                        </div>
                                        <div class="m-messenger__message-body">
                                            <div class="m-messenger__message-arrow"></div>
                                            <div class="m-messenger__message-content">
                                                <div class="m-messenger__message-username">
                                                    Megan wrote
                                                </div>
                                                <div class="m-messenger__message-text">
                                                    Noted. For the Coca-Cola Mobile App project as well ?
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-messenger__wrapper">
                                    <div class="m-messenger__message m-messenger__message--out">
                                        <div class="m-messenger__message-body">
                                            <div class="m-messenger__message-arrow"></div>
                                            <div class="m-messenger__message-content">
                                                <div class="m-messenger__message-text">
                                                    Yes, sure.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-messenger__wrapper">
                                    <div class="m-messenger__message m-messenger__message--out">
                                        <div class="m-messenger__message-body">
                                            <div class="m-messenger__message-arrow"></div>
                                            <div class="m-messenger__message-content">
                                                <div class="m-messenger__message-text">
                                                    Please also prepare the quotation for the Loop CRM project as well.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-messenger__datetime">
                                    3:15PM
                                </div>
                                <div class="m-messenger__wrapper">
                                    <div class="m-messenger__message m-messenger__message--in">
                                        <div class="m-messenger__message-no-pic m--bg-fill-danger">
                                            <span>
                                                M
                                            </span>
                                        </div>
                                        <div class="m-messenger__message-body">
                                            <div class="m-messenger__message-arrow"></div>
                                            <div class="m-messenger__message-content">
                                                <div class="m-messenger__message-username">
                                                    Megan wrote
                                                </div>
                                                <div class="m-messenger__message-text">
                                                    Noted. I will prepare it.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-messenger__wrapper">
                                    <div class="m-messenger__message m-messenger__message--out">
                                        <div class="m-messenger__message-body">
                                            <div class="m-messenger__message-arrow"></div>
                                            <div class="m-messenger__message-content">
                                                <div class="m-messenger__message-text">
                                                    Thanks Megan. I will see you later.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-messenger__wrapper">
                                    <div class="m-messenger__message m-messenger__message--in">
                                        <div class="m-messenger__message-pic">
                                            <!-- <img src="assets/app/media/img//users/user3.jpg"  alt=""/> -->
                                        </div>
                                        <div class="m-messenger__message-body">
                                            <div class="m-messenger__message-arrow"></div>
                                            <div class="m-messenger__message-content">
                                                <div class="m-messenger__message-username">
                                                    Megan wrote
                                                </div>
                                                <div class="m-messenger__message-text">
                                                    Sure. See you in the meeting soon.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-messenger__seperator"></div>
                            <div class="m-messenger__form">
                                <div class="m-messenger__form-controls">
                                    <input type="text" name="" placeholder="Type here..." class="m-messenger__form-input">
                                </div>
                                <div class="m-messenger__form-tools">
                                    <a href="" class="m-messenger__form-attachment">
                                        <i class="la la-paperclip"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane  m-scrollable" id="m_quick_sidebar_tabs_settings" role="tabpanel">
                        <div class="m-list-settings">
                            <div class="m-list-settings__group">
                                <div class="m-list-settings__heading">
                                    General Settings
                                </div>
                                <div class="m-list-settings__item">
                                    <span class="m-list-settings__item-label">
                                        Email Notifications
                                    </span>
                                    <span class="m-list-settings__item-control">
                                        <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                                            <label>
                                                <input type="checkbox" checked="checked" name="">
                                                <span></span>
                                            </label>
                                        </span>
                                    </span>
                                </div>
                                <div class="m-list-settings__item">
                                    <span class="m-list-settings__item-label">
                                        Site Tracking
                                    </span>
                                    <span class="m-list-settings__item-control">
                                        <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                                            <label>
                                                <input type="checkbox" name="">
                                                <span></span>
                                            </label>
                                        </span>
                                    </span>
                                </div>
                                <div class="m-list-settings__item">
                                    <span class="m-list-settings__item-label">
                                        SMS Alerts
                                    </span>
                                    <span class="m-list-settings__item-control">
                                        <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                                            <label>
                                                <input type="checkbox" name="">
                                                <span></span>
                                            </label>
                                        </span>
                                    </span>
                                </div>
                                <div class="m-list-settings__item">
                                    <span class="m-list-settings__item-label">
                                        Backup Storage
                                    </span>
                                    <span class="m-list-settings__item-control">
                                        <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                                            <label>
                                                <input type="checkbox" name="">
                                                <span></span>
                                            </label>
                                        </span>
                                    </span>
                                </div>
                                <div class="m-list-settings__item">
                                    <span class="m-list-settings__item-label">
                                        Audit Logs
                                    </span>
                                    <span class="m-list-settings__item-control">
                                        <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                                            <label>
                                                <input type="checkbox" checked="checked" name="">
                                                <span></span>
                                            </label>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="m-list-settings__group">
                                <div class="m-list-settings__heading">
                                    System Settings
                                </div>
                                <div class="m-list-settings__item">
                                    <span class="m-list-settings__item-label">
                                        System Logs
                                    </span>
                                    <span class="m-list-settings__item-control">
                                        <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                                            <label>
                                                <input type="checkbox" name="">
                                                <span></span>
                                            </label>
                                        </span>
                                    </span>
                                </div>
                                <div class="m-list-settings__item">
                                    <span class="m-list-settings__item-label">
                                        Error Reporting
                                    </span>
                                    <span class="m-list-settings__item-control">
                                        <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                                            <label>
                                                <input type="checkbox" name="">
                                                <span></span>
                                            </label>
                                        </span>
                                    </span>
                                </div>
                                <div class="m-list-settings__item">
                                    <span class="m-list-settings__item-label">
                                        Applications Logs
                                    </span>
                                    <span class="m-list-settings__item-control">
                                        <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                                            <label>
                                                <input type="checkbox" name="">
                                                <span></span>
                                            </label>
                                        </span>
                                    </span>
                                </div>
                                <div class="m-list-settings__item">
                                    <span class="m-list-settings__item-label">
                                        Backup Servers
                                    </span>
                                    <span class="m-list-settings__item-control">
                                        <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                                            <label>
                                                <input type="checkbox" checked="checked" name="">
                                                <span></span>
                                            </label>
                                        </span>
                                    </span>
                                </div>
                                <div class="m-list-settings__item">
                                    <span class="m-list-settings__item-label">
                                        Audit Logs
                                    </span>
                                    <span class="m-list-settings__item-control">
                                        <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                                            <label>
                                                <input type="checkbox" name="">
                                                <span></span>
                                            </label>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane  m-scrollable" id="m_quick_sidebar_tabs_logs" role="tabpanel">
                        <div class="m-list-timeline">
                            <div class="m-list-timeline__group">
                                <div class="m-list-timeline__heading">
                                    System Logs
                                </div>
                                <div class="m-list-timeline__items">
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                        <a href="" class="m-list-timeline__text">
                                            12 new users registered
                                            <span class="m-badge m-badge--warning m-badge--wide">
                                                important
                                            </span>
                                        </a>
                                        <span class="m-list-timeline__time">
                                            Just now
                                        </span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                        <a href="" class="m-list-timeline__text">
                                            System shutdown
                                        </a>
                                        <span class="m-list-timeline__time">
                                            11 mins
                                        </span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-danger"></span>
                                        <a href="" class="m-list-timeline__text">
                                            New invoice received
                                        </a>
                                        <span class="m-list-timeline__time">
                                            20 mins
                                        </span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-warning"></span>
                                        <a href="" class="m-list-timeline__text">
                                            Database overloaded 89%
                                            <span class="m-badge m-badge--success m-badge--wide">
                                                resolved
                                            </span>
                                        </a>
                                        <span class="m-list-timeline__time">
                                            1 hr
                                        </span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                        <a href="" class="m-list-timeline__text">
                                            System error
                                        </a>
                                        <span class="m-list-timeline__time">
                                            2 hrs
                                        </span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                        <a href="" class="m-list-timeline__text">
                                            Production server down
                                            <span class="m-badge m-badge--danger m-badge--wide">
                                                pending
                                            </span>
                                        </a>
                                        <span class="m-list-timeline__time">
                                            3 hrs
                                        </span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                        <a href="" class="m-list-timeline__text">
                                            Production server up
                                        </a>
                                        <span class="m-list-timeline__time">
                                            5 hrs
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-list-timeline__group">
                                <div class="m-list-timeline__heading">
                                    Applications Logs
                                </div>
                                <div class="m-list-timeline__items">
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                        <a href="" class="m-list-timeline__text">
                                            New order received
                                            <span class="m-badge m-badge--info m-badge--wide">
                                                urgent
                                            </span>
                                        </a>
                                        <span class="m-list-timeline__time">
                                            7 hrs
                                        </span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                        <a href="" class="m-list-timeline__text">
                                            12 new users registered
                                        </a>
                                        <span class="m-list-timeline__time">
                                            Just now
                                        </span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                        <a href="" class="m-list-timeline__text">
                                            System shutdown
                                        </a>
                                        <span class="m-list-timeline__time">
                                            11 mins
                                        </span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-danger"></span>
                                        <a href="" class="m-list-timeline__text">
                                            New invoices received
                                        </a>
                                        <span class="m-list-timeline__time">
                                            20 mins
                                        </span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-warning"></span>
                                        <a href="" class="m-list-timeline__text">
                                            Database overloaded 89%
                                        </a>
                                        <span class="m-list-timeline__time">
                                            1 hr
                                        </span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                        <a href="" class="m-list-timeline__text">
                                            System error
                                            <span class="m-badge m-badge--info m-badge--wide">
                                                pending
                                            </span>
                                        </a>
                                        <span class="m-list-timeline__time">
                                            2 hrs
                                        </span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                        <a href="" class="m-list-timeline__text">
                                            Production server down
                                        </a>
                                        <span class="m-list-timeline__time">
                                            3 hrs
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-list-timeline__group">
                                <div class="m-list-timeline__heading">
                                    Server Logs
                                </div>
                                <div class="m-list-timeline__items">
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                        <a href="" class="m-list-timeline__text">
                                            Production server up
                                        </a>
                                        <span class="m-list-timeline__time">
                                            5 hrs
                                        </span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                        <a href="" class="m-list-timeline__text">
                                            New order received
                                        </a>
                                        <span class="m-list-timeline__time">
                                            7 hrs
                                        </span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                        <a href="" class="m-list-timeline__text">
                                            12 new users registered
                                        </a>
                                        <span class="m-list-timeline__time">
                                            Just now
                                        </span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                        <a href="" class="m-list-timeline__text">
                                            System shutdown
                                        </a>
                                        <span class="m-list-timeline__time">
                                            11 mins
                                        </span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-danger"></span>
                                        <a href="" class="m-list-timeline__text">
                                            New invoice received
                                        </a>
                                        <span class="m-list-timeline__time">
                                            20 mins
                                        </span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-warning"></span>
                                        <a href="" class="m-list-timeline__text">
                                            Database overloaded 89%
                                        </a>
                                        <span class="m-list-timeline__time">
                                            1 hr
                                        </span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                        <a href="" class="m-list-timeline__text">
                                            System error
                                        </a>
                                        <span class="m-list-timeline__time">
                                            2 hrs
                                        </span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                        <a href="" class="m-list-timeline__text">
                                            Production server down
                                        </a>
                                        <span class="m-list-timeline__time">
                                            3 hrs
                                        </span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                        <a href="" class="m-list-timeline__text">
                                            Production server up
                                        </a>
                                        <span class="m-list-timeline__time">
                                            5 hrs
                                        </span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                        <a href="" class="m-list-timeline__text">
                                            New order received
                                        </a>
                                        <span class="m-list-timeline__time">
                                            1117 hrs
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end::Quick Sidebar -->         
        <!-- begin::Scroll Top -->
        <div id="m_scroll_top" class="m-scroll-top">
            <i class="la la-arrow-up"></i>
        </div>
        <!-- end::Scroll Top -->            <!-- begin::Quick Nav -->
        
    
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
