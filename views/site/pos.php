<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\helpers\Helper;
use app\helpers\push_notification;
//echo $_GET['sale_id'];
if (isset($_GET['sale_id'])) {
    \app\assets\SaleAsset::register($this);
}
else{
    \app\assets\PosAsset::register($this);
}
$baseUrl = Yii::$app->homeUrl;
?>

<!-- begin::Page loader -->
<div class="m-page-loader m-page-loader--base">
    <div class="m-blockui">
        <span>
            Loading Data...
        </span>
        <span>
            <div class="m-loader m-loader--brand"></div>
        </span>
    </div>
</div>
<!-- end::Page Loader -->
<!-- begin::Body -->
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop" style="background: #f2f3f8">
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-container m-container--responsive m-container--xxl m-container--full-height">
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <div class="m-content" style="margin-top:15px;">
                <div class="ng-view">

                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: Body -->
