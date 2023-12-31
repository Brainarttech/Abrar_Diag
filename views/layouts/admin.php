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
use yii\web\View;
$url = Url::base(true);
$this->registerJs(
    "const url = '$url';",
    View::POS_HEAD,
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
        <script src="https://cdn.tiny.cloud/1/t8dblobhkcxvbbhrazojj9b04ieji4j69cycmor6ms2050nq/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        <?php $this->head() ?>
        
    </head>
    <body ng-app="myApp" class="m--skin- m-page--loading-enabled  m-content--skin-light m-header--fixed m-header--fixed-mobile m-aside-left--offcanvas-default m-aside-left--enabled m-aside-left--fixed m-aside-left--skin-dark m-aside--offcanvas-default"  >
        <?php $this->beginBody() ?>
        <!-- begin::Page loader -->
        <div class="m-page-loader m-page-loader--base">
            <div class="m-blockui">
                <span>Please wait...</span>
                <span>
                    <div class="m-loader m-loader--brand"></div>
                </span>
            </div>
        </div>
        <!-- end::Page Loader -->

        <!-- begin:: Page -->
        <div class="m-grid m-grid--hor m-grid--root m-page" style="min-height: calc(100% - 1em);">
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
                                    <a href="<?php echo $baseUrl . 'site/pos'; ?>" class="m-menu__link">
                                        <i class="m-menu__link-icon flaticon-browser"></i>
                                        <span class="m-menu__link-text">
                                            POS
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
                                                            Diagnostic Test
                                                        </span>
                                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                    </h3>
                                                    <ul class="m-menu__inner">
                                                        <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a  href="<?php echo $baseUrl . 'item-name/index'; ?>" class="m-menu__link ">
                                                                <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                    <span></span>
                                                                </i>
                                                                <span class="m-menu__link-text">
                                                                    List Diagnostic Test
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a  href="<?php echo $baseUrl . 'item-name/index'; ?>" class="m-menu__link ">
                                                                <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                    <span></span>
                                                                </i>
                                                                <span class="m-menu__link-text">
                                                                    Add Diagnostic Test
                                                                </span>
                                                            </a>
                                                        </li>
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
                                                            <a  href="<?php echo $baseUrl . 'patient/index'; ?>" class="m-menu__link ">
                                                                <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                    <span></span>
                                                                </i>
                                                                <span class="m-menu__link-text">
                                                                    List Patient
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a  href="<?php echo $baseUrl . 'patient/index'; ?>" class="m-menu__link ">
                                                                <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                    <span></span>
                                                                </i>
                                                                <span class="m-menu__link-text">
                                                                    Add Patient
                                                                </span>
                                                            </a>
                                                        </li>
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
                                                            <a  href="<?php echo $baseUrl . 'sales/index'; ?>" class="m-menu__link ">
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
                                                    </ul>
                                                </li>
                                                <li class="m-menu__item">
                                                    <h3 class="m-menu__heading m-menu__toggle">
                                                        <span class="m-menu__link-text">
                                                            Referred Doctor
                                                        </span>
                                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                    </h3>
                                                    <ul class="m-menu__inner">
                                                        <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a  href="<?php echo $baseUrl . 'referred-doctor/index'; ?>" class="m-menu__link ">
                                                                <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                    <span></span>
                                                                </i>
                                                                <span class="m-menu__link-text">
                                                                    List Referred Doctor
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a  href="<?php echo $baseUrl . 'referred-doctor/index'; ?>" class="m-menu__link ">
                                                                <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                    <span></span>
                                                                </i>
                                                                <span class="m-menu__link-text">
                                                                    Add Referred Doctor
                                                                </span>
                                                            </a>
                                                        </li>
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

                                                    </ul>
                                                </li>
                                                <li class="m-menu__item">
                                                    <h3 class="m-menu__heading m-menu__toggle">
                                                        <span class="m-menu__link-text">
                                                            Reports
                                                        </span>
                                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                    </h3>
                                                    <ul class="m-menu__inner">
                                                        <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a  href="<?php echo $baseUrl . 'report/detail-sale-report'; ?>" class="m-menu__link ">
                                                                <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                    <span></span>
                                                                </i>
                                                                <span class="m-menu__link-text">
                                                                    Daily Detail Sale Report
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a  href="<?php echo $baseUrl . 'report/summary-sale-report'; ?>" class="m-menu__link ">
                                                                <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                    <span></span>
                                                                </i>
                                                                <span class="m-menu__link-text">
                                                                    Summary of Sale Report
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a  href="<?php echo $baseUrl . 'sales/dailydetailsalereport'; ?>" class="m-menu__link ">
                                                                <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                    <span></span>
                                                                </i>
                                                                <span class="m-menu__link-text">
                                                                    Advance Detail Sale Report
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a  href="<?php echo $baseUrl . 'sales/department-sale-report'; ?>" class="m-menu__link ">
                                                                <i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i>
                                                                <span class="m-menu__link-text">
                                                                    Department Wise Sale Report
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a  href="<?php echo $baseUrl . 'sales/tests-sale-report'; ?>" class="m-menu__link ">
                                                                <i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i>
                                                                <span class="m-menu__link-text">
                                                                    Tests Wise Sale Report
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a  href="<?php echo $baseUrl . 'report/test-sale-report'; ?>" class="m-menu__link ">
                                                                <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                    <span></span>
                                                                </i>
                                                                <span class="m-menu__link-text">
                                                                    Test Wise Report
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a  href="<?php echo $baseUrl . 'report/sale-summary'; ?>" class="m-menu__link ">
                                                                <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                    <span></span>
                                                                </i>
                                                                <span class="m-menu__link-text">
                                                                    Sale Summary Report
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a  href="<?php echo $baseUrl . 'report/expense'; ?>" class="m-menu__link ">
                                                                <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                    <span></span>
                                                                </i>
                                                                <span class="m-menu__link-text">
                                                                    Expense Report
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
                                        <i class="m-menu__link-icon flaticon-add"></i>
                                        <span class="m-menu__link-text">
                                            Department
                                        </span>
                                        <i class="m-menu__hor-arrow la la-angle-down"></i>
                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                    </a>
                                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                        <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                        <ul class="m-menu__subnav">
                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                <a href="<?= $baseUrl ?>site/pending-test" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-graphic-2"></i>
                                                    <span class="m-menu__link-title">
                                                        <span class="m-menu__link-wrap">
                                                            <span class="m-menu__link-text">
                                                                Pending Tests
                                                            </span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                <a href="<?= $baseUrl ?>site/complete-test" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-graphic-2"></i>
                                                    <span class="m-menu__link-title">
                                                        <span class="m-menu__link-wrap">
                                                            <span class="m-menu__link-text">
                                                                Complete Tests
                                                            </span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                <a href="<?= $baseUrl ?>lab-form" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-graphic-2"></i>
                                                    <span class="m-menu__link-title">
                                                        <span class="m-menu__link-wrap">
                                                            <span class="m-menu__link-text">
                                                                Lab Forms
                                                            </span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                                <a  href="<?php echo $baseUrl . 'optional-item'; ?>" class="m-menu__link m-menu__toggle">
                                                    <span class="m-menu__item-here"></span>
                                                    <i class="m-menu__link-icon flaticon-notes"></i>
                                                    <span class="m-menu__link-text">
                                                        Optional Product
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-menu__item  m-menu__item--submenu"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                                <a  href="<?php echo $baseUrl . 'additional-cost-item'; ?>" class="m-menu__link m-menu__toggle">
                                                    <span class="m-menu__item-here"></span>
                                                    <i class="m-menu__link-icon flaticon-add"></i>
                                                    <span class="m-menu__link-text">
                                                        Additional Product
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                <a href="<?= Url::toRoute(['sales/custom-sale-report']) ?>" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-graphic-2"></i>
                                                    <span class="m-menu__link-title">
                                                        <span class="m-menu__link-wrap">
                                                            <span class="m-menu__link-text">
                                                                Reports
                                                            </span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                    <a  href="javascript:;" class="m-menu__link m-menu__toggle">
                                        <i class="m-menu__link-icon flaticon-add"></i>
                                        <span class="m-menu__link-text">
                                            Sales
                                        </span>
                                        <i class="m-menu__hor-arrow la la-angle-down"></i>
                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                    </a>
                                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                        <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                        <ul class="m-menu__subnav">
                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                <a href="<?= $baseUrl ?>sales/index" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-graphic-2"></i>
                                                    <span class="m-menu__link-title">
                                                        <span class="m-menu__link-wrap">
                                                            <span class="m-menu__link-text">
                                                                All Sales
                                                            </span>
                                                            <span class="m-menu__link-badge">
                                                                <span class="m-badge m-badge--success">
                                                                    <?= number_format(\app\models\Sales::find()->where(['status' => '1'])->count()); ?>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                <a href="<?= $baseUrl ?>sales/complete" class="m-menu__link ">

                                                    <i class="m-menu__link-icon flaticon-graphic-2"></i>
                                                    <span class="m-menu__link-title">
                                                        <span class="m-menu__link-wrap">
                                                            <span class="m-menu__link-text">
                                                                Complete
                                                            </span>
                                                            <span class="m-menu__link-badge">
                                                                <span class="m-badge m-badge--success">
                                                                    <?= number_format(\app\models\Sales::find()->where(['sale_status' => '1'])->andWhere(['status' => '1'])->count()); ?>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                <a href="<?= $baseUrl ?>sales/partial-refund" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-graphic-2"></i>
                                                    <span class="m-menu__link-title">
                                                        <span class="m-menu__link-wrap">
                                                            <span class="m-menu__link-text">
                                                                Partial Refund
                                                            </span>
                                                            <span class="m-menu__link-badge">
                                                                <span class="m-badge m-badge--success">
                                                                    <?= number_format(\app\models\Sales::find()->where(['sale_status' => '3'])->andWhere(['status' => '1'])->count()); ?>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                <a href="<?= $baseUrl ?>sales/fully-refund" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-graphic-2"></i>
                                                    <span class="m-menu__link-title">
                                                        <span class="m-menu__link-wrap">
                                                            <span class="m-menu__link-text">
                                                                Fully Refund
                                                            </span>
                                                            <span class="m-menu__link-badge">
                                                                <span class="m-badge m-badge--success">
                                                                    <?= number_format(\app\models\Sales::find()->where(['sale_status' => '2'])->andWhere(['status' => '1'])->count()); ?>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>

                                            <hr>

                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                <a href="<?= $baseUrl ?>sales/all-paid" class="m-menu__link ">

                                                    <i class="m-menu__link-icon flaticon-graphic-2"></i>
                                                    <span class="m-menu__link-title">
                                                        <span class="m-menu__link-wrap">
                                                            <span class="m-menu__link-text">
                                                                All Paid
                                                            </span>
                                                            <span class="m-menu__link-badge">
                                                                <span class="m-badge m-badge--success">
                                                                    <?= number_format(\app\models\Sales::find()->where(['payment_status' => '1'])->andWhere(['status' => '1'])->count()); ?>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                <a href="<?= $baseUrl ?>sales/partial-payment" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-graphic-2"></i>
                                                    <span class="m-menu__link-title">
                                                        <span class="m-menu__link-wrap">
                                                            <span class="m-menu__link-text">
                                                                Partial Payment
                                                            </span>
                                                            <span class="m-menu__link-badge">
                                                                <span class="m-badge m-badge--success">
                                                                    <?= number_format(\app\models\Sales::find()->where(['payment_status' => '2'])->count()); ?>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                <a href="<?= $baseUrl ?>sales/due-payment" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-graphic-2"></i>
                                                    <span class="m-menu__link-title">
                                                        <span class="m-menu__link-wrap">
                                                            <span class="m-menu__link-text">
                                                                Due Payment
                                                            </span>
                                                            <span class="m-menu__link-badge">
                                                                <span class="m-badge m-badge--success">
                                                                    <?= number_format(\app\models\Sales::find()->where(['payment_status' => '0'])->andWhere(['status' => '1'])->count()); ?>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                <a href="<?= $baseUrl ?>sales/department-push" class="m-menu__link ">

                                                    <i class="m-menu__link-icon flaticon-graphic-2"></i>
                                                    <span class="m-menu__link-title">
                                                        <span class="m-menu__link-wrap">
                                                            <span class="m-menu__link-text">
                                                                Department Push
                                                            </span>
                                                            <span class="m-menu__link-badge">
                                                                <span class="m-badge m-badge--success">
                                                                    <?= number_format(\app\models\Sales::find()->where(['depart_push_status' => '1'])->andWhere(['status' => '1'])->count()); ?>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>


                                        </ul>
                                    </div>
                                </li>

                                <li class="m-menu__item  m-menu__item--submenu"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                    <a  href="#" class="m-menu__link m-menu__toggle">
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
                                                        <span class="m-menu__link-text">Dashboard</span>
                                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                    </h3>
                                                    <ul class="m-menu__inner">
                                                        <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a  href="<?php echo $baseUrl . 'transactions/'; ?>" class="m-menu__link ">
                                                                <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                    <span></span>
                                                                </i>
                                                                <span class="m-menu__link-text">
                                                                    Transactions
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a  href="<?php echo $baseUrl . 'transactions/ledger'; ?>" class="m-menu__link ">
                                                                <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                    <span></span>
                                                                </i>
                                                                <span class="m-menu__link-text">
                                                                    Ledger
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="m-menu__item">
                                                    <h3 class="m-menu__heading m-menu__toggle">
                                                        <span class="m-menu__link-text">
                                                            Finance Reports
                                                        </span>
                                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                    </h3>
                                                    <ul class="m-menu__inner">
                                                        <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a  href="<?php echo $baseUrl . 'accounts/'; ?>" class="m-menu__link ">
                                                                <i class="m-menu__link-icon flaticon-map"></i>
                                                                <span class="m-menu__link-text">
                                                                    Chart of Accounts
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a  href="inner.html" class="m-menu__link ">
                                                                <i class="m-menu__link-icon flaticon-graphic-2"></i>
                                                                <span class="m-menu__link-text">
                                                                    Reports
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="m-menu__item">
                                                    <h3 class="m-menu__heading m-menu__toggle">
                                                        <span class="m-menu__link-text">Purchases</span>
                                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                    </h3>
                                                    <ul class="m-menu__inner">
                                                        <li class="m-menu__item" m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a href="<?php echo $baseUrl . 'receipts/'; ?>" class="m-menu__link ">
                                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                    <span></span>
                                                                </i>
                                                                <span class="m-menu__link-text">Receipts</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="m-menu__item">
                                                    <h3 class="m-menu__heading m-menu__toggle">
                                                        <span class="m-menu__link-text">Accounting</span>
                                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                    </h3>
                                                    <ul class="m-menu__inner">
                                                        <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a  href="inner.html" class="m-menu__link ">
                                                                <span class="m-menu__link-text">Transactions</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>

                                <li class="m-menu__item  m-menu__item--submenu"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                    <a  href="#" class="m-menu__link m-menu__toggle">
                                        <span class="m-menu__item-here"></span>
                                        <i class="m-menu__link-icon flaticon-stopwatch"></i>
                                        <span class="m-menu__link-text">
                                            Human Resource
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
                                                        <span class="m-menu__link-text">Users</span>
                                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                    </h3>
                                                    <ul class="m-menu__inner">
                                                        <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a  href="<?php echo $baseUrl . 'user/'; ?>" class="m-menu__link ">
                                                                <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                    <span></span>
                                                                </i>
                                                                <span class="m-menu__link-text">
                                                                    View Users
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a  href="<?php echo $baseUrl . 'transactions/ledger'; ?>" class="m-menu__link ">
                                                                <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                    <span></span>
                                                                </i>
                                                                <span class="m-menu__link-text">
                                                                    Ledger
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="m-menu__item">
                                                    <h3 class="m-menu__heading m-menu__toggle">
                                                        <span class="m-menu__link-text">
                                                            Finance Reports
                                                        </span>
                                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                    </h3>
                                                    <ul class="m-menu__inner">
                                                        <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a  href="<?php echo $baseUrl . 'accounts/'; ?>" class="m-menu__link ">
                                                                <i class="m-menu__link-icon flaticon-map"></i>
                                                                <span class="m-menu__link-text">
                                                                    Chart of Accounts
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a  href="inner.html" class="m-menu__link ">
                                                                <i class="m-menu__link-icon flaticon-graphic-2"></i>
                                                                <span class="m-menu__link-text">
                                                                    Reports
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="m-menu__item">
                                                    <h3 class="m-menu__heading m-menu__toggle">
                                                        <span class="m-menu__link-text">Purchases</span>
                                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                    </h3>
                                                    <ul class="m-menu__inner">
                                                        <li class="m-menu__item" m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a href="<?php echo $baseUrl . 'receipts/'; ?>" class="m-menu__link ">
                                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                    <span></span>
                                                                </i>
                                                                <span class="m-menu__link-text">Receipts</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="m-menu__item">
                                                    <h3 class="m-menu__heading m-menu__toggle">
                                                        <span class="m-menu__link-text">Accounting</span>
                                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                    </h3>
                                                    <ul class="m-menu__inner">
                                                        <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a  href="inner.html" class="m-menu__link ">
                                                                <span class="m-menu__link-text">Transactions</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <!--                                <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                                                    <a href="<?php echo $baseUrl . 'inventory/'; ?>" class="m-menu__link m-menu__toggle">
                                                                        <span class="m-menu__item-here"></span>
                                                                        <i class="m-menu__link-icon flaticon-notes"></i>
                                                                        <span class="m-menu__link-text">
                                                                            Inventory
                                                                        </span>
                                                                    </a>
                                                                </li>-->
                                <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" aria-haspopup="true">
                                    <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                        <span class="m-menu__item-here"></span>
                                        <i class="m-menu__link-icon flaticon-analytics"></i>
                                        <span class="m-menu__link-text">
                                            Inventory
                                        </span>
                                        <i class="m-menu__hor-arrow la la-angle-down"></i>
                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                    </a>
                                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                        <span class="m-menu__arrow m-menu__arrow--adjust" style="left: 78.5px;"></span>
                                        <ul class="m-menu__subnav">
                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                <a href="<?php echo $baseUrl . 'product/'; ?>" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-users"></i>
                                                    <span class="m-menu__link-text">
                                                        Products
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                <a href="<?php echo $baseUrl . 'purchase/'; ?>" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-users"></i>
                                                    <span class="m-menu__link-text">
                                                        Purchase
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                <a href="#" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-users"></i>
                                                    <span class="m-menu__link-text">
                                                        Payment
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                <a href="#" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-users"></i>
                                                    <span class="m-menu__link-text">
                                                        Transfer
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-menu__item m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                                    <i class="m-menu__link-icon flaticon-business"></i>
                                                    <span class="m-menu__link-text">
                                                        Users
                                                    </span>
                                                    <i class="m-menu__hor-arrow la la-angle-right"></i>
                                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                </a>
                                                <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                    <span class="m-menu__arrow "></span>
                                                    <ul class="m-menu__subnav">
                                                        <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a href="<?php echo $baseUrl . '#'; ?>" class="m-menu__link ">
                                                                <span class="m-menu__link-text">
                                                                    Customers
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a href="<?php echo $baseUrl . 'supplier/'; ?>" class="m-menu__link ">
                                                                <span class="m-menu__link-text">
                                                                    Suppliers
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                            <a href="#" class="m-menu__link ">
                                                                <span class="m-menu__link-text">
                                                                    Vendors
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <!--
                                                                                        <li class="m-menu__item m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                                                            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                                                                                <i class="m-menu__link-icon flaticon-business"></i>
                                                                                                <span class="m-menu__link-text">
                                                                                                    Settings
                                                                                                </span>
                                                                                                <i class="m-menu__hor-arrow la la-angle-right"></i>
                                                                                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                                                            </a>
                                                                                            <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                                                                <span class="m-menu__arrow "></span>
                                                                                                <ul class="m-menu__subnav">
                                                                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                                        <a href="<?php echo $baseUrl . 'si-unit'; ?>" class="m-menu__link ">
                                                                                                            <span class="m-menu__link-text">
                                                                                                                Si Units
                                                                                                            </span>
                                                                                                        </a>
                                                                                                    </li>
                                                                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                                        <a href="<?php echo $baseUrl . 'category/'; ?>" class="m-menu__link ">
                                                                                                            <span class="m-menu__link-text">
                                                                                                                Categories
                                                                                                            </span>
                                                                                                        </a>
                                                                                                    </li>
                                                                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                                        <a href="<?php echo $baseUrl . 'brand/'; ?>" class="m-menu__link ">
                                                                                                            <span class="m-menu__link-text">
                                                                                                                Brands
                                                                                                            </span>
                                                                                                        </a>
                                                                                                    </li>
                                                                                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                                        <a href="<?php echo $baseUrl . 'variant/'; ?>" class="m-menu__link ">
                                                                                                            <span class="m-menu__link-text">
                                                                                                                Variants
                                                                                                            </span>
                                                                                                        </a>
                                                                                                    </li>
                                                                                                </ul>
                                                                                            </div>
                                                                                        </li>-->


                                        </ul>
                                    </div>
                                </li>
                                <!--                                <li class="m-menu__item  m-menu__item--submenu"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                                                    <a href="#" class="m-menu__link m-menu__toggle">
                                                                        <span class="m-menu__item-here"></span>
                                                                        <i class="m-menu__link-icon flaticon-stopwatch"></i>
                                                                        <span class="m-menu__link-text">Configuration</span>
                                                                    </a>
                                                                </li>-->
                                <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                    <a  href="javascript:;" class="m-menu__link m-menu__toggle">
                                        <i class="m-menu__link-icon flaticon-statistics"></i>
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
                                                <a  href="<?php echo $baseUrl . 'brand'; ?>" class="m-menu__link ">
                                                    <i class="m-menu__link-icon flaticon-interface-9"></i>
                                                    <span class="m-menu__link-text">
                                                        Brands
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                                                <a  href="<?php echo $baseUrl . 'variant'; ?>" class="m-menu__link ">
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
                                        <li class="m-nav__item m-nav__item--accent m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width" m-dropdown-toggle="click" m-dropdown-persistent="1">
                                            <a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
                                                <span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span>
                                                <span class="m-nav__link-icon">
                                                    <span class="m-nav__link-icon-wrapper">
                                                        <i class="flaticon-music-2"></i>
                                                    </span>
                                                </span>
                                            </a>
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
            <!-- begin::Body -->
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body" style="background: #f2f3f8">
                <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-container m-container--responsive m-container--xxl m-container--full-height">
                    <div class="m-grid__item m-grid__item--fluid m-wrapper">
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
                                <?= date('Y') ?> &copy; Powered by
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
