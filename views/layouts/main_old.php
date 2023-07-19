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
    <script src=" <?php echo  Yii::$app->homeUrl?>js/jquery.min.js"></script>

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
<div class="m-grid m-grid--hor m-grid--root m-page">

    <!-- BEGIN: Header -->
    <header id="m_header" class="m-grid__item    m-header "  m-minimize="minimize" m-minimize-mobile="minimize" m-minimize-offset="200" m-minimize-mobile-offset="200" >
        <div class="m-container m-container--fluid m-container--full-height">
            <div class="m-stack m-stack--ver m-stack--desktop  m-header__wrapper">
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
                            <a href="javascript:;" id="m_aside_left_toggle_mobile" class="m-brand__icon m-brand__toggler m-brand__toggler--left">
                                <span></span>
                            </a>
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
                <!-- END: Brand -->
                <div class="m-stack__item m-stack__item--middle m-stack__item--left m-header-head" id="m_header_nav">
                    <div class="m-stack m-stack--ver m-stack--desktop">

                        <div class="m-stack__item m-stack__item--fluid">
                            <!-- BEGIN: Horizontal Menu -->
                            <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn">
                                <i class="la la-close"></i>
                            </button>
                            <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark "  >
                                <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">

                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                        <a  href="<?php echo $baseUrl.'site/index';?>" class="m-menu__link">
                                            <span class="m-menu__item-here"></span>
                                            <i class="m-menu__link-icon flaticon-analytics"></i>
													<span class="m-menu__link-text">
														Home
													</span>

                                        </a>

                                    </li>
                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                        <a  href="<?php echo $baseUrl.'site/pos';?>" class="m-menu__link">
                                            <span class="m-menu__item-here"></span>
                                            <i class="m-menu__link-icon flaticon-stopwatch"></i>
													<span class="m-menu__link-text">
														Front
													</span>

                                        </a>
                                    </li>
                                    <li class="m-menu__item  m-menu__item--submenu"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                        <a  href="javascript:;" class="m-menu__link m-menu__toggle">
                                            <span class="m-menu__item-here"></span>
                                            <i class="m-menu__link-icon flaticon-stopwatch"></i>
													<span class="m-menu__link-text">
														Reception
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
																		Diagnostic
																	</span>
                                                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                        </h3>
                                                        <ul class="m-menu__inner">
                                                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                <a  href="<?php echo $baseUrl.'item-name/index';?>" class="m-menu__link ">
                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                        <span></span>
                                                                    </i>
																			<span class="m-menu__link-text">
																				List Diagnostic
																			</span>
                                                                </a>
                                                            </li>
                                                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                <a  href="<?php echo $baseUrl.'item-name/index';?>" class="m-menu__link ">
                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                        <span></span>
                                                                    </i>
																			<span class="m-menu__link-text">
																				Add Diagnostic
																			</span>
                                                                </a>
                                                            </li>
                                                            <!--<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
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
                                                            </li>-->
                                                        </ul>
                                                    </li>
                                                    <li class="m-menu__item">
                                                        <h3 class="m-menu__heading m-menu__toggle">
																	<span class="m-menu__link-text">
																		Patient
																	</span>
                                                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                        </h3>
                                                        <ul class="m-menu__inner">
                                                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                <a  href="<?php echo $baseUrl.'patient/index';?>" class="m-menu__link ">
                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                        <span></span>
                                                                    </i>
																			<span class="m-menu__link-text">
																				List Patient
																			</span>
                                                                </a>
                                                            </li>
                                                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                <a  href="<?php echo $baseUrl.'patient/index';?>" class="m-menu__link ">
                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                        <span></span>
                                                                    </i>
																			<span class="m-menu__link-text">
																				Add Patient
																			</span>
                                                                </a>
                                                            </li>
                                                            <!--<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
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
                                                            </li>-->
                                                        </ul>
                                                    </li>
                                                    <li class="m-menu__item">
                                                        <h3 class="m-menu__heading m-menu__toggle">
																	<span class="m-menu__link-text">
																		Sale
																	</span>
                                                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                        </h3>
                                                        <ul class="m-menu__inner">
                                                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                <a  href="<?php echo $baseUrl.'sales/index';?>" class="m-menu__link ">
                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                        <span></span>
                                                                    </i>
																			<span class="m-menu__link-text">
																				List Sale
																			</span>
                                                                </a>
                                                            </li>
                                                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                <a  href="#" class="m-menu__link ">
                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                        <span></span>
                                                                    </i>
																			<span class="m-menu__link-text">
																				Add Sale
																			</span>
                                                                </a>
                                                            </li>
                                                            <!--<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                <a  href="inner.html" class="m-menu__link ">
                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                        <span></span>
                                                                    </i>
																			<span class="m-menu__link-text">
																				Return Sales
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
                                                            </li>-->
                                                        </ul>
                                                    </li>
                                                    <li class="m-menu__item">
                                                        <h3 class="m-menu__heading m-menu__toggle">
																	<span class="m-menu__link-text">
																		Return Sale
																	</span>
                                                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                        </h3>
                                                        <ul class="m-menu__inner">
                                                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                <a  href="#" class="m-menu__link ">
                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                        <span></span>
                                                                    </i>
																			<span class="m-menu__link-text">
																				List Return Sale
																			</span>
                                                                </a>
                                                            </li>
                                                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                <a  href="#" class="m-menu__link ">
                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                        <span></span>
                                                                    </i>
																			<span class="m-menu__link-text">
																				Add Return Sale
																			</span>
                                                                </a>
                                                            </li>
                                                            <!--<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
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
                                                            </li>-->
                                                        </ul>
                                                    </li>
                                                    <li class="m-menu__item">
                                                        <h3 class="m-menu__heading m-menu__toggle">
																	<span class="m-menu__link-text">
																		Doctor
																	</span>
                                                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                        </h3>
                                                        <ul class="m-menu__inner">
                                                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                <a  href="<?php echo $baseUrl.'referred-doctor/index';?>" class="m-menu__link ">
                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                        <span></span>
                                                                    </i>
																			<span class="m-menu__link-text">
																				List Doctor
																			</span>
                                                                </a>
                                                            </li>
                                                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                <a  href="<?php echo $baseUrl.'referred-doctor/index';?>" class="m-menu__link ">
                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                        <span></span>
                                                                    </i>
																			<span class="m-menu__link-text">
																				Add Doctor
																			</span>
                                                                </a>
                                                            </li>
                                                            <!--<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
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
                                                            </li>-->
                                                        </ul>
                                                    </li>
                                                    <li class="m-menu__item">
                                                        <h3 class="m-menu__heading m-menu__toggle">
																	<span class="m-menu__link-text">
																		Expense
																	</span>
                                                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                        </h3>
                                                        <ul class="m-menu__inner">
                                                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                <a  href="#" class="m-menu__link ">
                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                        <span></span>
                                                                    </i>
																			<span class="m-menu__link-text">
																				List Expense
																			</span>
                                                                </a>
                                                            </li>
                                                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                                <a  href="#" class="m-menu__link ">
                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                        <span></span>
                                                                    </i>
																			<span class="m-menu__link-text">
																				Add Expense
																			</span>
                                                                </a>
                                                            </li>
                                                            <!--<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
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
                                                            </li>-->
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                        <a  href="#" class="m-menu__link m-menu__toggle">
                                            <span class="m-menu__item-here"></span>
                                            <i class="m-menu__link-icon flaticon-notes"></i>
													<span class="m-menu__link-text">
														Inventory
													</span>
                                            <!--<i class="m-menu__hor-arrow la la-angle-down"></i>
                                            <i class="m-menu__ver-arrow la la-angle-right"></i>-->
                                        </a>
                                        <!--<div class="m-menu__submenu  m-menu__submenu--fixed m-menu__submenu--left" style="width:600px">
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
                                        </div>-->
                                    </li>
                                    <li class="m-menu__item  m-menu__item--submenu"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                        <a  href="#" class="m-menu__link m-menu__toggle">
                                            <span class="m-menu__item-here"></span>
                                            <i class="m-menu__link-icon flaticon-stopwatch"></i>
													<span class="m-menu__link-text">
														Accounts
													</span>
                                            <!--<i class="m-menu__hor-arrow la la-angle-down"></i>
                                            <i class="m-menu__ver-arrow la la-angle-right"></i>-->
                                        </a>
                                        <!--<div class="m-menu__submenu  m-menu__submenu--fixed-xl m-menu__submenu--center" >
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
                                        </div>-->
                                    </li>
                                    <li class="m-menu__item  m-menu__item--submenu"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                        <a  href="#" class="m-menu__link m-menu__toggle">
                                            <span class="m-menu__item-here"></span>
                                            <i class="m-menu__link-icon flaticon-stopwatch"></i>
													<span class="m-menu__link-text">
														HR
													</span>
                                            <!--<i class="m-menu__hor-arrow la la-angle-down"></i>
                                            <i class="m-menu__ver-arrow la la-angle-right"></i>-->
                                        </a>
                                        <!--<div class="m-menu__submenu  m-menu__submenu--fixed-xl m-menu__submenu--center" >
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
                                        </div>-->
                                    </li>

                                    <li class="m-menu__item  m-menu__item--submenu"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                        <a  href="#" class="m-menu__link m-menu__toggle">
                                            <span class="m-menu__item-here"></span>
                                            <i class="m-menu__link-icon flaticon-stopwatch"></i>
													<span class="m-menu__link-text">
														Reports
													</span>
                                            <!--<i class="m-menu__hor-arrow la la-angle-down"></i>
                                            <i class="m-menu__ver-arrow la la-angle-right"></i>-->
                                        </a>
                                        <!--<div class="m-menu__submenu  m-menu__submenu--fixed-xl m-menu__submenu--center" >
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
                                        </div>-->
                                    </li>
                                    <li class="m-menu__item  m-menu__item--submenu"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                        <a  href="#" class="m-menu__link m-menu__toggle">
                                            <span class="m-menu__item-here"></span>
                                            <i class="m-menu__link-icon flaticon-stopwatch"></i>
													<span class="m-menu__link-text">
														Setting
													</span>
                                            <!--<i class="m-menu__hor-arrow la la-angle-down"></i>
                                            <i class="m-menu__ver-arrow la la-angle-right"></i>-->
                                        </a>
                                        <!--<div class="m-menu__submenu  m-menu__submenu--fixed-xl m-menu__submenu--center" >
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
                                        </div>-->
                                    </li>
                                </ul>
                            </div>
                            <!-- END: Horizontal Menu -->
                        </div>
                    </div>
                </div>

                <div class="m-stack__item m-stack__item--right">
                    <!-- BEGIN: Topbar -->
                    <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                        <div class="m-stack__item m-topbar__nav-wrapper">
                            <ul class="m-topbar__nav m-nav m-nav--inline">
                                <li class="
	m-nav__item m-nav__item--focus m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width m-dropdown--skin-light	m-list-search m-list-search--skin-light"
                                    m-dropdown-toggle="click" m-dropdown-persistent="1" id="m_quicksearch" m-quicksearch-mode="dropdown">
                                    <!--<a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-nav__link-icon">
													<span class="m-nav__link-icon-wrapper">
														<i class="flaticon-search-1"></i>
													</span>
												</span>
                                    </a>-->
                                    <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                                        <div class="m-dropdown__inner ">
                                            <div class="m-dropdown__header">
                                                <form  class="m-list-search__form">
                                                    <div class="m-list-search__form-wrapper">
																<span class="m-list-search__form-input-wrapper">
																	<input id="m_quicksearch_input" autocomplete="off" type="text" name="q" class="m-list-search__form-input" value="" placeholder="Search...">
																</span>
																<span class="m-list-search__form-icon-close" id="m_quicksearch_close">
																	<i class="la la-remove"></i>
																</span>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__scrollable m-scrollable" data-scrollable="true" data-max-height="300" data-mobile-max-height="200">
                                                    <div class="m-dropdown__content"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="m-nav__item m-nav__item--accent m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width" m-dropdown-toggle="click" m-dropdown-persistent="1">
                                    <a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
                                        <span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span>
												<span class="m-nav__link-icon">
													<span class="m-nav__link-icon-wrapper">
														<i class="flaticon-music-2"></i>
													</span>
												</span>
                                    </a>
                                    <!-- <div class="m-dropdown__wrapper">
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
                                     </div>-->
                                </li>
                                <li class="m-nav__item m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
                                    <a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-topbar__username m--hidden-mobile">
													<?= Yii::$app->user->identity->username?>
												</span>
												<span class="m-topbar__userpic">
													<img src="assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless m--img-centered" alt=""/>
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
                                                        <img src="assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless" alt=""/>
                                                    </div>
                                                    <div class="m-card-user__details">
																<span class="m-card-user__name m--font-weight-500">
																	<?= Yii::$app->user->identity->username?>
																</span>
                                                        <a href="" class="m-card-user__email m--font-weight-300 m-link">
                                                            <?= Yii::$app->user->identity->email?>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="m-nav m-nav--skin-light">
                                                        <!-- <li class="m-nav__section m--hide">
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
                                                         </li>-->
                                                        <!--<li class="m-nav__separator m-nav__separator--fit"></li>
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
                                                        </li>-->
                                                        <li class="m-nav__separator m-nav__separator--fit"></li>
                                                        <li class="m-nav__item">
                                                            <a href="<?php echo Yii::$app->homeUrl?>site/logout" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">
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

    <!-- begin::Body -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body" style="background: #f2f3f8">
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-container m-container--responsive m-container--xxl m-container--full-height">
            <div class="m-grid__item m-grid__item--fluid m-wrapper">
                <!-- BEGIN: Subheader -->
                <div class="m-subheader ">
                    <div class="d-flex align-items-center">
                        <div class="mr-auto">
                            <h1 class="m-subheader__title m-subheader__title--separator">
                                <?= Html::encode($this->title) ?>

                            </h1>

                            <?=
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
                            ?>

                        </div>

                    </div>
                </div>
                <!-- END: Subheader -->
                <div class="m-content">

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
                                <a href="https://keenthemes.com" class="m-link">
                                    Graystork (PVT) LTD
                                </a>
                            </span>
                </div>
                <!--<div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
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
                </div>-->
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
