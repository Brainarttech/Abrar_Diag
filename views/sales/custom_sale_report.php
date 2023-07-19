<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\dropdown\DropdownX;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sales';
$this->params['breadcrumbs'][] = $this->title;



?>
<style>
    .add-new{
        margin-top: 0px !important;
    }
</style>





<div class="sales-index">

    <!-- <h1><?/*= Html::encode($this->title) */?></h1>-->
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php


    ?>

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">
            <div class="table-responsive">
                <div class="m-section">
                    <div class="m-section__content">
                        <div class="row">
                            <div class="col-sm-6 text-left">

                            </div>
                            <div class="col-sm-6 text-right">
                                <div class="dt-buttons btn-group">
                                    <a href="<?= Yii::$app->homeUrl?>sales/custom-sale-report-print?<?= $_SERVER['QUERY_STRING'];  ?>" class="btn btn-success buttons-print" tabindex="0" aria-controls="m_table_1"><span>Print</span></a>
                                </div>
                            </div>
                        </div>
                        <br>
                        <table class="table table-bordered m-table">
                            <thead>
                            <tr>
                                <th>
                                    Sno
                                </th>
                                <th>
                                    Date/Time
                                </th>
                                <th>
                                    Receipt
                                </th>
                                <th>
                                    Patient
                                </th>
                                <th>
                                    Referred
                                </th>
                                <th style="width: 40%">
                                    Tests
                                </th>
                                <th>Consultant</th>
                                <th>
                                    Discount
                                </th>
                                <th>
                                    Total
                                </th>
                                <th>
                                    Paid
                                </th>
                                <th>
                                    Remaining
                                </th>
                                <th>
                                   Sale By
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php

                            $patient = 0;
                            $tests_total = 0;
                            $sum_discount = 0;
                            $sum_grand_total = 0;
                            $sum_paid_amount = 0;
                            $sum_remaining = 0;
                            $consultant_amount = 0;

                            foreach ($dataProvider->models as $key=>$provider)
                            {
                                $total_extra = 0;
                                $total_items = 0;
                                $total_consultant = 0;
                                $total_discount= 0;
                                $sum_total = 0;
                                $paid_amount = 0;
                                //$sum_discount = $sum_discount +  $provider->discount;
                                // $sum_grand_total = $sum_grand_total +  $provider->grand_total;
                                //$sum_paid_amount = $sum_paid_amount +  $provider->paid_amount;
                                //$sum_remaining = $sum_remaining +  ($provider->grand_total - $provider->paid_amount);
                                $patient++
                                ?>
                                <tr>

                                    <th scope="row">
                                        <?= $key + 1?>

                                    </th>

                                    <td>
                                        <?= \app\helpers\datetime::saleDateTime($provider->created_on);?>
                                    </td>

                                    <td>
                                        <?= $provider->invoice_no?>
                                    </td>
                                    <td>
                                        <?= $provider->patient->name?><br>
                                        <?= $provider->patient->reg_no?>
                                    </td>
                                    <td>
                                        <?= $provider->referred->name?>
                                    </td>
                                    <td>
                                        <table style="width:100%;">
                                            <thead style="visibility: collapse">
                                            <tr>

                                            <th style="width: 250px"></th>
                                            <th></th>
                                             <th></th>
                                            <th></th>
                                            </tr>
                                            </thead>

                                            <?php foreach($provider->saleitems as $item){

                                                $consultant_amount = $consultant_amount + $item->consultant_amount;
                                                $total_consultant =  $total_consultant + $item->consultant_amount;
                                                $total_discount = $total_discount + $item->item_discount;
                                                $sum_discount = $sum_discount + $item->item_discount;
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?= $item->item_name?>

                                                    <?php foreach ($item['extra'] as $extra){?>

                                                        <li><?= $extra->item_name?> - <?= $extra->item_rate?>[<?= number_format($extra->item_quantity)?>]</li>

                                                        <?php
                                                        $total_extra = $total_extra + ($extra->item_quantity * $extra->item_rate);

                                                    } ?>

                                                    </td>

                                                    <td>
                                                        <?= $item['item']['category']->name?>

                                                    </td>

                                                    <td>
                                                        <?= $item->item_price + $total_extra?>
                                                        <?php $total_items = $total_items + ($item->item_price + $total_extra);?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if($item->test_status==1){ ?>
                                                            Pending
                                                        <?php } else { ?>
                                                            Complete

                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php
                                            } ?>
                                            <tr>

                                                <td colspan="1"><strong>Total</strong></td>
                                                <td colspan="3" class="text-center"><strong><?= $total_items ?></strong></td>
                                                <?php

                                                $tests_total = $tests_total + $total_items;
                                                $sum_total=  $total_items - $total_discount;
                                                $sum_grand_total =  $sum_grand_total +  $sum_total;
                                                ?>
                                            </tr>

                                        </table>
                                    </td>
                                    <td class="text-center">

                                        <?php if($total_consultant>0){

                                            echo $total_consultant;

                                        }else {

                                            echo '';

                                        }?>
                                    </td>
                                    <td>
                                        <?php

                                        if($total_discount==0)
                                        {
                                            echo "";
                                        }else{
                                            echo $total_discount;
                                        }

                                        ?>
                                    </td>
                                    <td>
                                        <?= $sum_total?>
                                    </td>
                                    <td>
                                        <?php 
                                        if($provider->paid_amount > $sum_total)
                                        {
                                            $paid_amount = $sum_total;
                                        }
                                        else
                                        {
                                            $paid_amount = $provider->paid_amount;
                                        }
                                        $sum_paid_amount = $sum_paid_amount +  $paid_amount;
                                        ?>
                                        <?= $paid_amount?>
                                    </td>
                                    <td>
                                        <?php
                                        $result = $sum_total - $paid_amount;
                                        if($result==0)
                                        {
                                            echo "";
                                        }else{
                                            echo $result;
                                        }
                                        $sum_remaining = $sum_remaining +  $result;
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $provider->user->username ?>
                                    </td>


                                </tr>


                            <?php }
                            ?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-xl-4"></div>
            <div class="col-xl-3"></div>
            <div class="col-xl-4">
                <!--begin:: Widgets/Stats2-1 -->
                <div class="m-widget1">
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">
                                    No of Patients
                                </h3>
                            </div>
                            <div class="col m--align-right">
														<span class="m-widget1__number m--font-brand">
															<?=  $patient?>
														</span>
                            </div>
                        </div>
                    </div>
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">
                                    Total Test Amounts
                                </h3>
                            </div>
                            <div class="col m--align-right">
														<span class="m-widget1__number m--font-brand">
															<?= number_format($tests_total) ?>
														</span>
                            </div>
                        </div>
                    </div>
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">
                                    Consultant Amount
                                </h3>

                            </div>
                            <div class="col m--align-right">
														<span class="m-widget1__number m--font-danger">
															<?= number_format($consultant_amount)?>
														</span>
                            </div>
                        </div>
                    </div>
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">
                                    Discounts
                                </h3>

                            </div>
                            <div class="col m--align-right">
														<span class="m-widget1__number m--font-danger">
															<?= number_format($sum_discount)?>
														</span>
                            </div>
                        </div>
                    </div>
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">
                                    Grand Total
                                </h3>
                            </div>
                            <div class="col m--align-right">
														<span class="m-widget1__number m--font-success">
															<?= number_format($sum_grand_total)?>
														</span>
                            </div>
                        </div>
                    </div>
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">
                                    Paid Amount
                                </h3>

                            </div>
                            <div class="col m--align-right">
														<span class="m-widget1__number m--font-success">
															<?= number_format($sum_paid_amount)?>
														</span>
                            </div>
                        </div>
                    </div>
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">
                                    Remaining Amount
                                </h3>

                            </div>
                            <div class="col m--align-right">
														<span class="m-widget1__number m--font-danger">
															<?= number_format($sum_remaining)?>
														</span>
                            </div>
                        </div>
                    </div>

                </div>
                <!--end:: Widgets/Stats2-1 -->
            </div>
            <div class="col-xl-1"></div>
        </div>

        <?php
/*
        echo "<pre>";
        print_r($dataProvider->models);
        echo "</pre>";



        */?>

    </div>





</div>

