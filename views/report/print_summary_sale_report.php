
<?php

use app\models\Sales;

 $sales = $dataProvider->models;
 $count=0;
$report_print = date("Y-m-d H:i:s");
$phpdate = strtotime($report_print);
//$date = date( 'd/m/Y', $phpdate );
$report_print = date('d/m/Y h:i A', $phpdate);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Summary Sale Report : <?= $_GET['SalesSearch']['created_on'] ?> </title>
        <link href="<?php echo Yii::$app->homeUrl ?>css/boot.min.css" rel="stylesheet" type='text/css' id="bootstrap-css">
        <link rel="stylesheet" type='text/css' href="<?php echo Yii::$app->homeUrl ?>css/print_bill.css">

    </head>

    <style>
        .table td, .table th{
            padding: 0.0rem !important;
        }

        .table-sm td, .table-sm th{
            padding: 0.2rem !important;
        }

        .font{
            font-size: 12px;
        }

        .container{
            background: white;
        }
    </style>
    <body class="font">
        <page size="A4" layout="portrait">
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <h4>Abrar Diagnostic Centre</h4>
                        <p style="margin-top: -7px;"><strong>312-E Charing Cross,<br>Peshawar Road, Rawalpindi Cantt</strong></p>
                    </div>
                    <div class="col-sm-5">
                        <p >Tel: 5470205, 5167015, 5473543<br>Fax: 051-8317450, Cell: 0331-5261588<br>
                            Email: mri_ct@hotmail.com<br>Web: www.abrardiagnostics.com.pk</p>
                    </div>

                </div>
                <div class="row ">
                    <div class="col-sm-12">
                        <!-- Cahs Sale Report Start -->
                        <div class="d-none">
                            <hr>
                            <hr>
                            <div class="text-center ">
                                <strong>Cash Sale Report : 
                                    <?php if (isset($_GET['SalesSearch']['created_on'])) {
                                        echo $_GET['SalesSearch']['created_on'];
                                    } else {
                                        echo $searchModel->created_on;
                                    } ?> 
                                </strong>
                            </div>
                            <hr>
                            <hr>
                            <br>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm m-table table-bordered font" id="table">
                                            <thead style="
                                                border-top: 2px solid black;
                                                border-bottom:  2px solid black;
                                                ">
                                                <tr>
                                                    <td class="text-center"><strong>Sno.</strong></td>
                                                    <td class="text-center" width="10%"><strong>Time</strong></td>
                                                    <td class="text-center"><strong>Receipt</strong></td>
                                                    <td class="text-center"><strong>Patient</strong></td>
                                                    <td class="text-center"><strong>Ref</strong></td>
                                                    <td class="text-center" style="width: 400px;"><strong>Tests</strong></td>
                                                    <td class="text-center"><strong>Consultant</strong></td>
                                                    <td class="text-center"><strong>Discount</strong></td>
                                                    <td class="text-center"><strong>Total</strong></td>
                                                    <td class="text-center"><strong>Paid</strong></td>
                                                    <td class="text-center"><strong>Refund</strong></td>
                                                    <td class="text-center"><strong>Rem</strong></td>
                                                    <td class="text-center"><strong>By</strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                $sum_total = 0;
                                                $cash_sale_sum_discount = 0;
                                                $cash_sale_sum_grand_total = 0;
                                                $cash_sale_sum_paid_amount = 0;
                                                $cash_sale_sum_remaining = 0;
                                                $cash_sale_tests_total = 0;
                                                $cash_sale_discount_issue = 0;
                                                $cash_sale_total_refund = 0;
                                                $cash_sale_total_consultant_amount = 0;
                                                $CashSaleCount=0;
                                                foreach ($sales as $sale) {
                                                    $paymentReference=false;
                                                    $paidAmount=0;
                                                    $payments= $sale->payments;
                                                    foreach($payments as $payment)
                                                    {
                                                        $mop=$payment->mop_id;
                                                        if((substr($payment->reference_no,0,7))=="ADC/PAY")
                                                        {
                                                            $paidAmount=$payment->amount;
                                                            $paymentReference=true;
                                                            break;
                                                        }


                                                    }
                                                    if ($sale->saleitems[0]->discount_reason != 10 && $sale->saleitems[0]->discount_reason != 11   && $mop==1 && $paymentReference) {
                                                        $CashSaleCount++;
                                                        $total_extra = 0;
                                                        $total_items = 0;
                                                        $cash_sale_consultant_amount = 0;
                                                        $i++;
                                                        $sum_total = $sum_total + $sale->total;
                                                        $cash_sale_sum_discount = $cash_sale_sum_discount + $sale->discount;
                                                        $cash_sale_sum_grand_total = $cash_sale_sum_grand_total + $sale->grand_total;
                                                        $cash_sale_sum_paid_amount = $cash_sale_sum_paid_amount + $paidAmount;
                                                        $cash_sale_sum_remaining = $cash_sale_sum_remaining + ($sale->grand_total - $sale->paid_amount - $sale->refund_amount);
                                                        ?>
                                                        <tr>
                                                            <th scope="row">
                                                                <?= $i ?>
                                                            </th>
                                                            <td class="text-center">
                                                                <?= \app\helpers\datetime::saleDateTime($sale->created_on); ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?= $sale->invoice_no ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?= $sale->patient->name ?><br>
                                                                <?= $sale->patient->reg_no ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?= $sale->referred->name ?>
                                                            </td>
                                                            <td>
                                                                <table>
                                                                    <thead style="visibility: collapse">
                                                                        <tr>
                                                                            <th style="width: 300px"></th>
                                                                            <th></th>
                                                                            <th></th>
                                                                            <th></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <?php foreach ($sale->saleitems as $item) { 
                                                                        $cash_sale_consultant_amount = $cash_sale_consultant_amount + $item->consultant_amount;
                                                                        ?>
                                                                        <tr>
                                                                            <td width="50%">
                                                                                <?= $item->item_name ?> ( <strong> <?= $item['item']['category']->name ?></strong>)

                                                                                <?php foreach ($item['extra'] as $extra) { ?>


                                                                                <li><?= $extra->item_name ?> - <?= $extra->item_rate ?>[<?= number_format($extra->item_quantity) ?>]</li>

                                                                                    <?php
                                                                                    $total_extra = $total_extra + ($extra->item_quantity * $extra->item_rate);
                                                                                }
                                                                                ?>

                                                                            </td>
                                                                            <td width="10%">
                                                                                <?= $item->item_price + $total_extra ?>
                                                                                <?php $total_items = $total_items + ($item->item_price + $total_extra); ?>
                                                                            </td>
                                                                            <td width="10%">
                                                                                <?php if ($item->test_status == 1) { ?>
                                                                                    Pending
                                                                                    <?php } else { ?>
                                                                                    Complete

                                                                                <?php } ?>
                                                                            </td>
                                                                            <td width="30%">
                                                                                <?php if ($item->test_status == 2) {
                                                                                foreach ($item->extraSaleOptionItem as $extra){?>
                                                                                <table width="100%">
                                                                                    <?php if($extra->product_name=="Folder " || $extra->product_name=="CD")
                                                                                    {

                                                                                    }
                                                                                    else
                                                                                    { ?>
                                                                                    <tr>
                                                                                        <td width="80%"><?= $extra->product_name ?></td>
                                                                                        <td width="20%"><?= $extra->product_quantity ?></td>
                                                                                    </tr>
                                                                                    <?php  } ?>
                                                                                </table>
                                                                                <?php } } ?>
                                                                            </td>

                                                                        </tr>
                                                                        <?php 
                                                                    } ?>
                                                                    <tr>
                                                                        <td colspan="1"><strong>Total</strong></td>
                                                                        <td colspan="2" class="text-center"><strong><?= $total_items ?></strong></td>
                                                                        <?php
                                                                        $cash_sale_tests_total = $cash_sale_tests_total + $total_items;
                                                                        ?>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td class="text-center">

                                                                <?php
                                                                if ($cash_sale_consultant_amount>0) {
                                                                    $cash_sale_total_consultant_amount +=$cash_sale_consultant_amount;
                                                                    echo $cash_sale_consultant_amount;
                                                                } else {

                                                                    echo '';
                                                                }
                                                                ?>
                                                            </td>


                                                            <td class="text-center">
                                                                <?php
                                                                if ($sale->discount == 0) {
                                                                    echo "";
                                                                } else {
                                                                    $cash_sale_discount_issue++;
                                                                    echo $sale->discount;
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?= $sale->grand_total ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?= $paidAmount ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?= $sale->refund_amount ?>
                                                                <?php $cash_sale_total_refund += $sale->refund_amount; ?>
                                                            </td>
                                                            <td class="text-center" >
                                                                <?php
                                                                $result = $sale->grand_total - $sale->paid_amount - $sale->refund_amount;
                                                                //$result = $sale->payments[0]->pos_paid - $sale->refund_amount;
                                                                if ($result == 0) {
                                                                    echo "";
                                                                } else {
                                                                    echo $result;
                                                                }
                                                                ?>
                                                            </td>

                                                            <td class="text-center">
                                                            <?= $sale->user->username ?>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                                <tr>
                                                    <td colspan="5" class="text-center"><strong>Total</strong></td>
                                                    <td class="text-center"><strong><?= number_format($cash_sale_tests_total) ?></strong></td>
                                                    <td class="text-center"><strong><?= number_format($cash_sale_total_consultant_amount) ?></strong></td>
                                                    <td class="text-center"><strong><?= number_format($cash_sale_sum_discount) ?></strong></td>
                                                    <td class="text-center"><strong><?= number_format($cash_sale_sum_grand_total) ?></strong></td>
                                                    <td class="text-center"><strong><?= number_format($cash_sale_sum_paid_amount) ?></strong></td>
                                                    <td class="text-center"><strong><?= number_format($cash_sale_total_refund) ?></strong></td>
                                                    <td class="text-center"><strong><?= number_format($cash_sale_sum_remaining) ?></strong></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <hr> 
                            <div class="text-center">
                                <strong>Credit Card Sale Report : 
                                    <?php if (isset($_GET['SalesSearch']['created_on'])) {
                                        echo $_GET['SalesSearch']['created_on'];
                                    } else {
                                        echo $searchModel->created_on;
                                    } ?> 
                                </strong>
                            </div>
                            <hr>
                            <hr>
                            <br>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm m-table table-bordered font" id="table">
                                            <thead style="
                                                border-top: 2px solid black;
                                                border-bottom:  2px solid black;
                                                ">
                                                <tr>
                                                    <td class="text-center"><strong>Sno.</strong></td>
                                                    <td class="text-center" width="10%"><strong>Time</strong></td>
                                                    <td class="text-center"><strong>Receipt</strong></td>
                                                    <td class="text-center"><strong>Patient</strong></td>
                                                    <td class="text-center"><strong>Ref</strong></td>
                                                    <td class="text-center" style="width: 400px;"><strong>Tests</strong></td>
                                                    <td class="text-center"><strong>Consultant</strong></td>
                                                    <td class="text-center"><strong>Discount</strong></td>
                                                    <td class="text-center"><strong>Total</strong></td>
                                                    <td class="text-center"><strong>Paid</strong></td>
                                                    <td class="text-center"><strong>Refund</strong></td>
                                                    <td class="text-center"><strong>Rem</strong></td>
                                                    <td class="text-center"><strong>By</strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                $sum_total = 0;
                                                $sum_discount = 0;
                                                $sum_grand_total = 0;
                                                $sum_paid_amount = 0;
                                                $sum_remaining = 0;
                                                $tests_total = 0;
                                                $discount_issue = 0;
                                                $credit_card_sale_total_consultant_amount = 0;

                                                $total_refund = 0;

                                                $CreditCardSaleCount=0;

                                                foreach ($sales as $sale) {

                                                    $paymentReference=false;
                                                    $paidAmount=0;
                                                    $payments= $sale->payments;

                                                    foreach($payments as $payment)
                                                    {
                                                        $mop=$payment->mop_id;
                                                        if((substr($payment->reference_no,0,7))=="ADC/PAY")
                                                        {
                                                            $paidAmount=$payment->amount;
                                                            $paymentReference=true;
                                                            break;
                                                        }


                                                    }

                                                    if ($sale->saleitems[0]->discount_reason != 10 && $sale->saleitems[0]->discount_reason != 11 && $mop==2 && $paymentReference) {
                                                        $CreditCardSaleCount++;
                                                        $total_extra = 0;
                                                        $total_items = 0;
                                                        $credit_card_sale_consultant_amount = 0;
                                                        $i++;
                                                        $sum_total = $sum_total + $sale->total;
                                                        $sum_discount = $sum_discount + $sale->discount;
                                                        $sum_grand_total = $sum_grand_total + $sale->grand_total;
                                                        $sum_paid_amount = $sum_paid_amount + $paidAmount;
                                                        $sum_remaining = $sum_remaining + ($sale->grand_total - $sale->paid_amount - $sale->refund_amount);
                                                        ?>
                                                        <tr>
                                                            <th scope="row">
                                                                <?= $i ?>
                                                            </th>
                                                            <td class="text-center">
                                                                <?= \app\helpers\datetime::saleDateTime($sale->created_on); ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?= $sale->invoice_no ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?= $sale->patient->name ?><br>
                                                                <?= $sale->patient->reg_no ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?= $sale->referred->name ?>
                                                            </td>
                                                            <td>
                                                                <table>
                                                                    <thead style="visibility: collapse">
                                                                        <tr>
                                                                            <th style="width: 300px"></th>
                                                                            <th></th>
                                                                            <th></th>
                                                                            <th></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <?php foreach ($sale->saleitems as $item) { ?>
                                                                    <?php
                                                                    $credit_card_sale_consultant_amount = $credit_card_sale_consultant_amount + $item->consultant_amount;
                                                                    ?>
                                                                    <tr>
                                                                        <td width="50%">
                                                                            <?= $item->item_name ?> ( <strong> <?= $item['item']['category']->name ?></strong>)
                                                                            <?php foreach ($item['extra'] as $extra) { ?>
                                                                                <li><?= $extra->item_name ?> - <?= $extra->item_rate ?>[<?= number_format($extra->item_quantity) ?>]</li>
                                                                            <?php
                                                                            $total_extra = $total_extra + ($extra->item_quantity * $extra->item_rate);
                                                                            }
                                                                            ?>
                                                                        </td>

                                                                        <td width="10%">
                                                                            <?= $item->item_price + $total_extra ?>
                                                                            <?php $total_items = $total_items + ($item->item_price + $total_extra); ?>
                                                                        </td>
                                                                        <td width="10%">
                                                                            <?php if ($item->test_status == 1) { ?>
                                                                                Pending
                                                                                <?php } else { ?>
                                                                                Complete

                                                                                <?php } ?>
                                                                        </td>


                                                                        <td width="30%">

                                                                            <?php if ($item->test_status == 2) {

                                                                                foreach ($item->extraSaleOptionItem as $extra){?>
                                                                                <table width="100%">
                                                                                    <?php if($extra->product_name=="Folder " || $extra->product_name=="CD")
                                                                                    {

                                                                                    }
                                                                                    else
                                                                                    { ?>
                                                                                    <tr>
                                                                                        <td width="80%"><?= $extra->product_name ?></td>
                                                                                        <td width="20%"><?= $extra->product_quantity ?></td>
                                                                                    </tr>
                                                                                <?php  } ?>

                                                                                </table>


                                                                            <?php } } ?>


                                                                        </td>
                                                                    </tr>
                                                                    <?php } ?>
                                                                    <tr>
                                                                        <td colspan="1"><strong>Total</strong></td>
                                                                        <td colspan="2" class="text-center"><strong><?= $total_items ?></strong></td>
                                                                        <?php
                                                                        $tests_total = $tests_total + $total_items;
                                                                        ?>
                                                                    </tr>
                                                                </table>


                                                            </td>
                                                            <td class="text-center">

                                                                <?php
                                                                if ($credit_card_sale_consultant_amount > 0) {

                                                                    echo $credit_card_sale_consultant_amount;
                                                                    $credit_card_sale_total_consultant_amount+=$credit_card_sale_consultant_amount;
                                                                } else {

                                                                    echo '';
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php
                                                                if ($sale->discount == 0) {
                                                                    echo "";
                                                                } else {
                                                                    $discount_issue++;
                                                                    echo $sale->discount;
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?= $sale->grand_total ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?= $paidAmount ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?= $sale->refund_amount ?>
                                                                <?php $total_refund += $sale->refund_amount; ?>
                                                            </td>
                                                            <td class="text-center" >
                                                                <?php
                                                                $result = $sale->grand_total - $sale->paid_amount - $sale->refund_amount;
                                                                //$result = $sale->payments[0]->pos_paid - $sale->refund_amount;
                                                                if ($result == 0) {
                                                                    echo "";
                                                                } else {
                                                                    echo $result;
                                                                }
                                                                ?>
                                                            </td>

                                                            <td class="text-center">
                                                            <?= $sale->user->username ?>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                }
                                                ?>

                                                <tr>
                                                    <td colspan="5" class="text-center"><strong>Total</strong></td>
                                                    <td class="text-center"><strong><?= number_format($tests_total) ?></strong></td>
                                                    <td class="text-center"><strong><?= number_format($credit_card_sale_total_consultant_amount) ?></strong></td>
                                                    <td class="text-center"><strong><?= number_format($sum_discount) ?></strong></td>
                                                    <td class="text-center"><strong><?= number_format($sum_grand_total) ?></strong></td>
                                                    <td class="text-center"><strong><?= number_format($sum_paid_amount) ?></strong></td>
                                                    <td class="text-center"><strong><?= number_format($total_refund) ?></strong></td>
                                                    <td  class="text-center"><strong><?= number_format($sum_remaining) ?></strong></td>

                                                    <td></td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!------------------- jazz cash sale report ----------------->
                            <hr>
                            <hr>
                            <div class="text-center">
                                <strong>Jazz Cash Sale Report: 
                                    <?php if (isset($_GET['SalesSearch']['created_on'])) {
                                        echo $_GET['SalesSearch']['created_on'];
                                    } else {
                                        echo $searchModel->created_on;
                                    } ?>
                                </strong>
                            </div>
                            <hr>
                            <hr>
                            <br>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm m-table table-bordered font" id="table">
                                            <thead style="
                                                border-top: 2px solid black;
                                                border-bottom:  2px solid black;
                                                ">
                                                <tr>
                                                    <td class="text-center"><strong>Sno.</strong></td>
                                                    <td class="text-center" width="10%"><strong>Time</strong></td>
                                                    <td class="text-center"><strong>Receipt</strong></td>
                                                    <td class="text-center"><strong>Patient</strong></td>
                                                    <td class="text-center"><strong>Ref</strong></td>
                                                    <td class="text-center" style="width: 400px;"><strong>Tests</strong></td>
                                                    <td class="text-center"><strong>Consultant</strong></td>
                                                    <td class="text-center"><strong>Discount</strong></td>
                                                    <td class="text-center"><strong>Total</strong></td>
                                                    <td class="text-center"><strong>Paid</strong></td>
                                                    <td class="text-center"><strong>Refund</strong></td>
                                                    <td class="text-center"><strong>Rem</strong></td>
                                                    <td class="text-center"><strong>By</strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $jazz_cash_i = 0;

                                                $jazz_cash_sum_total = 0;
                                                $sum_jazz_cash_discount = 0;
                                                $jazz_cash_sum_grand_total = 0;
                                                $sum_jazz_cash = 0;
                                                $jazz_cash_sum_remaining = 0;
                                                $jazz_cash_tests_total = 0;
                                                $jazz_cash_discount_issue = 0;
                                                $jazz_cash_consultant_amount = 0;
                                                $jazz_cash_total_refund = 0;
                                                foreach ($sales as $sale) {
                                                    if ($sale->saleitems[0]->discount_reason == 11) {
                                                        $jazz_cash_total_extra = 0;
                                                        $jazz_cash_total_items = 0;
                                                        $jazz_cash_total_consultant = 0;
                                                        $jazz_cash_i++;
                                                        $jazz_cash_sum_total = $jazz_cash_sum_total + $sale->total;
                                                        $sum_jazz_cash_discount = $sum_jazz_cash_discount + $sale->discount;
                                                        $jazz_cash_sum_grand_total = $jazz_cash_sum_grand_total + $sale->grand_total;
                                                        $sum_jazz_cash = $sum_jazz_cash + $sale->paid_amount;
                                                        $jazz_cash_sum_remaining = $jazz_cash_sum_remaining + ($sale->grand_total - $sale->paid_amount - $sale->refund_amount);
                                                        ?>
                                                        <tr>
                                                            <th scope="row">
                                                                <?= $jazz_cash_i ?>
                                                            </th>
                                                            <td class="text-center">
                                                                <?= \app\helpers\datetime::saleDateTime($sale->created_on); ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?= $sale->invoice_no ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?= $sale->patient->name ?><br>
                                                                <?= $sale->patient->reg_no ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?= $sale->referred->name ?>
                                                            </td>
                                                            <td>
                                                                <table>
                                                                    <thead style="visibility: collapse">
                                                                        <tr>
                                                                            <th style="width: 300px"></th>
                                                                            <th></th>
                                                                            <th></th>
                                                                            <th></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <?php foreach ($sale->saleitems as $item) { 
                                                                    $jazz_cash_consultant_amount = $jazz_cash_consultant_amount + $item->consultant_amount;
                                                                    $jazz_cash_total_consultant = $jazz_cash_total_consultant + $item->consultant_amount;
                                                                    ?>
                                                                    <tr>
                                                                        <td width="50%">
                                                                            <?= $item->item_name ?> ( <strong> <?= $item['item']['category']->name ?></strong>)
                                                                                <?php foreach ($item['extra'] as $extra) { 
                                                                                ?>
                                                                                <li><?= $extra->item_name ?> - <?= $extra->item_rate ?>[<?= number_format($extra->item_quantity) ?>]</li>
                                                                                <?php
                                                                                    $jazz_cash_total_extra = $jazz_cash_total_extra + ($extra->item_quantity * $extra->item_rate);
                                                                            }
                                                                            ?>

                                                                            </td>

                                                                        <td width="10%">
                                                                            <?= $item->item_price + $jazz_cash_total_extra ?>
                                                                            <?php $jazz_cash_total_items = $jazz_cash_total_items + ($item->item_price + $total_extra); ?>
                                                                        </td>
                                                                        <td width="10%">
                                                                            <?php if ($item->test_status == 1) { 
                                                                                ?>
                                                                                Pending
                                                                                <?php } else { 
                                                                                ?>
                                                                                Complete
                                                                                <?php 
                                                                            } 
                                                                            ?>
                                                                        </td>
                                                                        <td width="30%">
                                                                        <?php if ($item->test_status == 2) {
                                                                            foreach ($item->extraSaleOptionItem as $extra){?>
                                                                            <table width="100%">
                                                                                <?php if($extra->product_name=="Folder " || $extra->product_name=="CD")
                                                                                {

                                                                                }
                                                                                else
                                                                                { ?>
                                                                                <tr>
                                                                                    <td width="80%"><?= $extra->product_name ?></td>
                                                                                    <td width="20%"><?= $extra->product_quantity ?></td>
                                                                                </tr>
                                                                            <?php  } ?>

                                                                            </table>


                                                                        <?php } } ?>
                                                                        </td>
                                                                    </tr>
                                                                    <?php } ?>
                                                                    <tr>
                                                                        <td colspan="1"><strong>Total</strong></td>
                                                                        <td colspan="2" class="text-center"><strong><?= $jazz_cash_total_items ?></strong></td>
                                                                        <?php
                                                                        $jazz_cash_tests_total = $jazz_cash_tests_total + $jazz_cash_total_items;
                                                                        ?>
                                                                    </tr>
                                                                </table>

                                                            </td>
                                                            <td class="text-center">

                                                                <?php
                                                                if ($jazz_cash_total_consultant > 0) {

                                                                    echo $jazz_cash_total_consultant;
                                                                } else {

                                                                    echo '';
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php
                                                                if ($sale->discount == 0) {
                                                                    echo "";
                                                                } else {
                                                                    $jazz_cash_discount_issue++;
                                                                    echo $sale->discount;
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?= $sale->grand_total ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?= $sale->paid_amount ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?= $sale->refund_amount ?>
                                                                <?php $jazz_cash_total_refund += $sale->refund_amount; ?>
                                                            </td>
                                                            <td class="text-center" >
                                                                <?php
                                                                $result = $sale->grand_total - $sale->paid_amount - $sale->refund_amount;
                                                                //$result = $sale->payments[0]->pos_paid - $sale->refund_amount;
                                                                if ($result == 0) {
                                                                    echo "";
                                                                } else {
                                                                    echo $result;
                                                                }
                                                                ?>
                                                            </td>

                                                            <td class="text-center">
                                                                <?= $sale->user->username ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <tr>
                                                    <td colspan="5" class="text-center"><strong>Total</strong></td>
                                                    <td class="text-center"><strong><?= number_format($jazz_cash_tests_total) ?></strong></td>
                                                    <td class="text-center"><strong><?= number_format($jazz_cash_consultant_amount) ?></strong></td>
                                                    <td class="text-center"><strong><?= number_format($sum_jazz_cash_discount) ?></strong></td>
                                                    <td class="text-center"><strong><?= number_format($jazz_cash_sum_grand_total) ?></strong></td>
                                                    <td class="text-center"><strong><?= number_format($sum_jazz_cash) ?></strong></td>
                                                    <td class="text-center"><strong><?= number_format($jazz_cash_total_refund) ?></strong></td>
                                                    <td  class="text-center"><strong><?= number_format($jazz_cash_sum_remaining) ?></strong></td>

                                                    <td></td>

                                                </tr>
                                            </tbody>
                                        </table>

                                        <!------------------- jazz cash sale report end ----------------->
                                    </div>
                                </div>
                            </div>
                            <!------------------- easy paisa sale report staet ----------------->
                            <hr>
                            <hr>
                            <div class="text-center">
                                <strong>Easy Paisa Sale Report: 
                                    <?php if (isset($_GET['SalesSearch']['created_on'])) {
                                            echo $_GET['SalesSearch']['created_on'];
                                        } else {
                                            echo $searchModel->created_on;
                                        } ?> 
                                    </strong>
                            </div>
                            <hr>
                            <hr>
                            <br>
                            <table class="table table-sm m-table table-bordered font" id="table">
                                <thead style="border-top: 2px solid black;border-bottom:  2px solid black; ">
                                    <tr>
                                        <td class="text-center"><strong>Sno.</strong></td>
                                        <td class="text-center" width="10%"><strong>Time</strong></td>
                                        <td class="text-center"><strong>Receipt</strong></td>
                                        <td class="text-center"><strong>Patient</strong></td>
                                        <td class="text-center"><strong>Ref</strong></td>
                                        <td class="text-center" style="width: 400px;"><strong>Tests</strong></td>
                                        <td class="text-center"><strong>Consultant</strong></td>
                                        <td class="text-center"><strong>Discount</strong></td>
                                        <td class="text-center"><strong>Total</strong></td>
                                        <td class="text-center"><strong>Paid</strong></td>
                                        <td class="text-center"><strong>Refund</strong></td>
                                        <td class="text-center"><strong>Rem</strong></td>
                                        <td class="text-center"><strong>By</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $easy_paisa_i = 0;
                                    $easy_paisa_sum_total = 0;
                                    $sum_easy_paisa_discount = 0;
                                    $easy_paisa_sum_grand_total = 0;
                                    $sum_easy_paisa = 0;
                                    $easy_paisa_sum_remaining = 0;
                                    $easy_paisa_tests_total = 0;
                                    $easy_paisa_discount_issue = 0;
                                    $easy_paisa_consultant_amount = 0;
                                    $easy_paisa_total_refund = 0;
                                    foreach ($sales as $sale) {
                                        if ($sale->saleitems[0]->discount_reason == 10) {
                                            $easy_paisa_total_extra = 0;
                                            $easy_paisa_total_items = 0;
                                            $easy_paisa_total_consultant = 0;
                                            $easy_paisa_i++;
                                            $easy_paisa_sum_total = $easy_paisa_sum_total + $sale->total;
                                            $sum_easy_paisa_discount = $sum_easy_paisa_discount + $sale->discount;
                                            $easy_paisa_sum_grand_total = $easy_paisa_sum_grand_total + $sale->grand_total;
                                            $sum_easy_paisa = $sum_easy_paisa + $sale->paid_amount;
                                            $easy_paisa_sum_remaining = $easy_paisa_sum_remaining + ($sale->grand_total - $sale->paid_amount - $sale->refund_amount);
                                            ?>
                                            <tr>
                                                <th scope="row">
                                                    <?= $easy_paisa_i ?>
                                                </th>
                                                <td class="text-center">
                                                    <?= \app\helpers\datetime::saleDateTime($sale->created_on); ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $sale->invoice_no ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $sale->patient->name ?><br>
                                                    <?= $sale->patient->reg_no ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $sale->referred->name ?>
                                                </td>
                                                <td>
                                                    <table>
                                                        <thead style="visibility: collapse">
                                                            <tr>

                                                                <th style="width: 300px"></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <?php foreach ($sale->saleitems as $item) { 
                                                        $easy_paisa_consultant_amount = $easy_paisa_consultant_amount + $item->consultant_amount;
                                                        $easy_paisa_total_consultant = $easy_paisa_total_consultant + $item->consultant_amount;
                                                        ?>
                                                        <tr>
                                                            <td width="50%">
                                                                <?= $item->item_name ?> ( <strong> <?= $item['item']['category']->name ?></strong>)

                                                                <?php foreach ($item['extra'] as $extra) { ?>
                                                                <li><?= $extra->item_name ?> - <?= $extra->item_rate ?>[<?= number_format($extra->item_quantity) ?>]</li>
                                                                <?php
                                                                    $easy_paisa_total_extra = $easy_paisa_total_extra + ($extra->item_quantity * $extra->item_rate);
                                                                }
                                                                ?>
                                                            </td>

                                                            <td width="10%">
                                                                <?= $item->item_price + $easy_paisa_total_extra ?>
                                                                <?php $easy_paisa_total_items = $easy_paisa_total_items + ($item->item_price + $total_extra); ?>
                                                            </td>
                                                            <td width="10%">
                                                                <?php if ($item->test_status == 1) { ?>
                                                                    Pending
                                                                    <?php } else { ?>
                                                                    Complete

                                                                <?php } ?>
                                                            </td>

                                                            <td width="30%">


                                                                <?php if ($item->test_status == 2) {

                                                                    foreach ($item->extraSaleOptionItem as $extra){?>
                                                                    <table width="100%">
                                                                        <?php if($extra->product_name=="Folder " || $extra->product_name=="CD")
                                                                        {

                                                                        }
                                                                        else
                                                                        { ?>
                                                                        <tr>
                                                                            <td width="80%"><?= $extra->product_name ?></td>
                                                                            <td width="20%"><?= $extra->product_quantity ?></td>
                                                                        </tr>
                                                                    <?php  } ?>

                                                                    </table>


                                                                <?php } } ?>



                                                            </td>
                                                            </tr>
                                                        <?php } ?>
                                                        <tr>
                                                            <td colspan="1"><strong>Total</strong></td>
                                                            <td colspan="2" class="text-center"><strong><?= $easy_paisa_total_items ?></strong></td>
                                                            <?php
                                                            $easy_paisa_tests_total = $easy_paisa_tests_total + $easy_paisa_total_items;
                                                            ?>
                                                        </tr>

                                                    </table>

                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    if ($easy_paisa_total_consultant > 0) {

                                                        echo $easy_paisa_total_consultant;
                                                    } else {

                                                        echo '';
                                                    }
                                                    ?>
                                                </td>


                                                <td class="text-center">
                                                    <?php
                                                    if ($sale->discount == 0) {
                                                        echo "";
                                                    } else {
                                                        $easy_paisa_discount_issue++;
                                                        echo $sale->discount;
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $sale->grand_total ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $sale->paid_amount ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $sale->refund_amount ?>
                                                    <?php $easy_paisa_total_refund += $sale->refund_amount; ?>
                                                </td>
                                                <td class="text-center" >
                                                    <?php
                                                    $result = $sale->grand_total - $sale->paid_amount - $sale->refund_amount;
                                                    //$result = $sale->payments[0]->pos_paid - $sale->refund_amount;
                                                    if ($result == 0) {
                                                        echo "";
                                                    } else {
                                                        echo $result;
                                                    }
                                                    ?>
                                                </td>

                                                <td class="text-center">
                                                    <?= $sale->user->username ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>

                                    <tr>
                                        <td colspan="5" class="text-center"><strong>Total</strong></td>
                                        <td class="text-center"><strong><?= number_format($easy_paisa_tests_total) ?></strong></td>
                                        <td class="text-center"><strong><?= number_format($easy_paisa_consultant_amount) ?></strong></td>
                                        <td class="text-center"><strong><?= number_format($sum_easy_paisa_discount) ?></strong></td>
                                        <td class="text-center"><strong><?= number_format($easy_paisa_sum_grand_total) ?></strong></td>
                                        <td class="text-center"><strong><?= number_format($sum_easy_paisa) ?></strong></td>
                                        <td class="text-center"><strong><?= number_format($easy_paisa_total_refund) ?></strong></td>
                                        <td  class="text-center"><strong><?= number_format($easy_paisa_sum_remaining) ?></strong></td>

                                        <td></td>

                                    </tr>


                                </tbody>
                            </table>
                            <!---------------------- end easy paisa  ------------------------------------->
                            <hr>
                            <hr>
                            <div class="text-center">
                                <strong>Received Cash Pending Payments: <?php if (isset($_GET['SalesSearch']['created_on'])) {
                                        echo $_GET['SalesSearch']['created_on'];
                                    } else {
                                        echo $searchModel->created_on;
                                    } ?> 
                                </strong>
                            </div>
                            <hr>
                            <hr>
                            <br>
                            <table class="table table-sm m-table table-bordered font" id="table">
                                <thead style="
                                        border-top: 2px solid black;
                                        border-bottom:  2px solid black;
                                        ">
                                    <tr>
                                        <td class="text-center"><strong>Sno.</strong></td>
                                        <td class="text-center" width="10%"><strong>Time</strong></td>
                                        <td class="text-center"><strong>Receipt</strong></td>
                                        <td class="text-center"><strong>Patient</strong></td>
                                        <td class="text-center"><strong>Ref</strong></td>
                                        <td class="text-center" style="width: 400px;"><strong>Tests</strong></td>
                                        <td class="text-center"><strong>Consultant</strong></td>
                                        <td class="text-center"><strong>Discount</strong></td>
                                        <td class="text-center"><strong>Total</strong></td>
                                        <td class="text-center"><strong>Pre Paid</strong></td>
                                        <td class="text-center"><strong>Paid</strong></td>
                                        <td class="text-center"><strong>Rem</strong></td>
                                        <td class="text-center"><strong>By</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i_1 = 0;
                                        $rcpp_sum_total = 0;
                                        $rcpp_sum_discount = 0;
                                        $rcpp_sum_grand_total = 0;
                                        $rcpp_sum_paid_amount_cash = 0;
                                        $rcpp_sum_remaining = 0;
                                        $received_cash_pending_payments_total = 0;
                                        $rcpp_discount_issue = 0;
                                        $rccp_consultant_amount = 0;
                                        $rccp_sum_pre_paid_amount=0;

                                        foreach ($pending_payments as $payment) {

                                        if($payment->mop_id==1)
                                        {

                                        $total_extra = 0;
                                        $total_items = 0;
                                        $total_consultant = 0;
                                        $i_1++;
                                        $rcpp_sum_total = $rcpp_sum_total + $payment->sale->total;
                                        $rcpp_sum_discount  = $rcpp_sum_discount  + $payment->sale->discount;
                                        $rcpp_sum_grand_total = $rcpp_sum_grand_total + $payment->sale->grand_total;
                                        $rcpp_sum_paid_amount_cash = $rcpp_sum_paid_amount_cash + $payment->amount;
                                        $rccp_sum_pre_paid_amount = $rccp_sum_pre_paid_amount + $payment->paidAmount;
                                        $rcpp_sum_remaining = $rcpp_sum_remaining + ($payment->sale->grand_total - $payment->sale->paid_amount);
                                        ?>
                                        <tr>
                                            <th scope="row">
                                                <?= $i_1 ?>
                                            </th>
                                            <td class="text-center">
                                                <?= \app\helpers\datetime::saleDateTime($payment->created_on); ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $payment->sale->invoice_no ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $payment->sale->patient->name ?><br>
                                                <?= $payment->sale->patient->reg_no ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $payment->sale->referred->name ?>
                                            </td>

                                            <td>
                                                <table>
                                                    <thead style="visibility: collapse">
                                                        <tr>

                                                            <th style="width: 300px"></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <?php foreach ($payment->sale->saleitems as $item) { ?>

                                                    <?php
                                                    $rccp_consultant_amount = $rccp_consultant_amount + $item->consultant_amount;
                                                    $total_consultant = $total_consultant + $item->consultant_amount;
                                                    ?>
                                                    <tr>
                                                        <td width="50%">
                                                            <?= $item->item_name ?> ( <strong> <?= $item['item']['category']->name ?></strong>)

                                                            <?php foreach ($item['extra'] as $extra) { ?>

                                                            <li><?= $extra->item_name ?> - <?= $extra->item_rate ?>[<?= number_format($extra->item_quantity) ?>]</li>

                                                                <?php
                                                                $total_extra = $total_extra + ($extra->item_quantity * $extra->item_rate);
                                                            }
                                                            ?>


                                                        </td>

                                                        <td width="10%">
                                                            <?= $item->item_price + $total_extra ?>
                                                            <?php $total_items = $total_items + ($item->item_price + $total_extra); ?>
                                                            <?php $received_cash_pending_payments_total += $total_items; ?>
                                                        </td>
                                                        <td width="10%">
                                                            <?php if ($item->test_status == 1) { ?>
                                                                Pending
                                                                <?php } else { ?>
                                                                Complete

                                                            <?php } ?>
                                                        </td>

                                                        <td width="30%">

                                                            <?php if ($item->test_status == 2) {
                                                                foreach ($item->extraSaleOptionItem as $extra){?>
                                                                <table width="100%">
                                                                    <?php if($extra->product_name=="Folder " || $extra->product_name=="CD")
                                                                    {

                                                                    }
                                                                    else
                                                                    { ?>
                                                                    <tr>
                                                                        <td width="80%"><?= $extra->product_name ?></td>
                                                                        <td width="20%"><?= $extra->product_quantity ?></td>
                                                                    </tr>
                                                                <?php  } ?>

                                                                </table>


                                                            <?php } } ?>



                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                    <tr>

                                                        <td colspan="1"><strong>Total</strong></td>
                                                        <td colspan="2" class="text-center"><strong><?= $total_items ?></strong></td>

                                                    </tr>

                                                </table>

                                            </td>
                                            <td class="text-center">

                                                <?php
                                                if ($total_consultant > 0) {

                                                    echo $total_consultant;
                                                } else {

                                                    echo '';
                                                }
                                                ?>
                                            </td>


                                            <td class="text-center">
                                                <?php
                                                if ($payment->sale->discount == 0) {
                                                    echo "";
                                                } else {
                                                    $rcpp_discount_issue++;
                                                    echo $payment->sale->discount;
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $payment->sale->grand_total ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $payment->paidAmount ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $payment->amount ?>
                                            </td>
                                            <td class="text-center" >
                                                <?php
                                                $result = $payment->sale->grand_total - $payment->sale->paid_amount;
                                                if ($result == 0) {
                                                    echo "";
                                                } else {
                                                    echo $result;
                                                }
                                                ?>
                                            </td>

                                            <td class="text-center">
                                                <?= $payment->sale->user->username ?>
                                            </td>
                                                                                    </tr>
                                    <?php }}
                                    ?>
                                    <tr>
                                        <td colspan="5" class="text-center"><strong>Total</strong></td>
                                        <!-- <td class="text-center"><strong><?= number_format($received_cash_pending_payments_total) ?></strong></td> -->
                                        <td class="text-center"><strong><?= number_format($rcpp_sum_total) ?></strong></td>
                                        <td class="text-center"><strong><?= number_format($rccp_consultant_amount) ?></strong></td>
                                        <td class="text-center"><strong><?= number_format($rcpp_sum_discount ) ?></strong></td>
                                        <td class="text-center"><strong><?= number_format($rcpp_sum_grand_total) ?></strong></td>
                                        <td class="text-center"><strong><?= number_format($rccp_sum_pre_paid_amount) ?></strong></td>
                                        <td class="text-center"><strong><?= number_format($rcpp_sum_paid_amount_cash) ?></strong></td>
                                        <td  class="text-center"><strong><?= number_format($rcpp_sum_remaining) ?></strong></td>

                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <hr>
                            <div class="text-center">
                                <strong>Received Credit Card Pending Payments: <?php if (isset($_GET['SalesSearch']['created_on'])) {
                                        echo $_GET['SalesSearch']['created_on'];
                                    } else {
                                        echo $searchModel->created_on;
                                    } ?> 
                                </strong>
                            </div>
                            <hr>
                            <hr>
                            <br>
                            <table class="table table-sm m-table table-bordered font" id="table">
                                <thead style="
                                        border-top: 2px solid black;
                                        border-bottom:  2px solid black;
                                        ">
                                    <tr>
                                        <td class="text-center"><strong>Sno.</strong></td>
                                        <td class="text-center" width="10%"><strong>Time</strong></td>
                                        <td class="text-center"><strong>Receipt</strong></td>
                                        <td class="text-center"><strong>Patient</strong></td>
                                        <td class="text-center"><strong>Ref</strong></td>
                                        <td class="text-center" style="width: 400px;"><strong>Tests</strong></td>
                                        <td class="text-center"><strong>Consultant</strong></td>
                                        <td class="text-center"><strong>Discount</strong></td>
                                        <td class="text-center"><strong>Total</strong></td>
                                        <td class="text-center"><strong>Pre Paid</strong></td>
                                        <td class="text-center"><strong>Paid</strong></td>
                                        <td class="text-center"><strong>Rem</strong></td>
                                        <td class="text-center"><strong>By</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i_1 = 0;
                                    $sum_total_1 = 0;
                                    $sum_discount_1 = 0;
                                    $sum_grand_total_1 = 0;
                                    $sum_paid_amount_1 = 0;
                                    $sum_remaining_1 = 0;
                                    $tests_total_1 = 0;
                                    $discount_issue_1 = 0;
                                    $consultant_amount_1 = 0;
                                    $sum_pre_paid_amount_1=0;
                                    foreach ($pending_payments as $payment) {
                                        if($payment->mop_id==2)
                                        {
                                        $total_extra = 0;
                                        $total_items = 0;
                                        $total_consultant = 0;
                                        $i_1++;
                                        $sum_total_1 = $sum_total_1 + $payment->sale->total;
                                        $sum_discount_1 = $sum_discount_1 + $payment->sale->discount;
                                        $sum_grand_total_1 = $sum_grand_total_1 + $payment->sale->grand_total;
                                        $sum_paid_amount_1 = $sum_paid_amount_1 + $payment->amount;
                                        $sum_pre_paid_amount_1 = $sum_pre_paid_amount_1 + $payment->paidAmount;
                                        $sum_remaining_1 = $sum_remaining_1 + ($payment->sale->grand_total - $payment->sale->paid_amount);
                                        ?>
                                        <tr>
                                            <th scope="row">
                                                <?= $i_1 ?>
                                            </th>
                                            <td class="text-center">
                                                <?= \app\helpers\datetime::saleDateTime($payment->created_on); ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $payment->sale->invoice_no ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $payment->sale->patient->name ?><br>
                                                <?= $payment->sale->patient->reg_no ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $payment->sale->referred->name ?>
                                            </td>
                                            <td>
                                                <table>
                                                    <thead style="visibility: collapse">
                                                        <tr>

                                                            <th style="width: 300px"></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <?php foreach ($payment->sale->saleitems as $item) { ?>
                                                    <?php
                                                    $consultant_amount_1 = $consultant_amount_1 + $item->consultant_amount;
                                                    $total_consultant = $total_consultant + $item->consultant_amount;
                                                    ?>
                                                    <tr>
                                                        <td width="50%">
                                                            <?= $item->item_name ?> ( <strong> <?= $item['item']['category']->name ?></strong>)
                                                            <?php foreach ($item['extra'] as $extra) { ?>
                                                            <li><?= $extra->item_name ?> - <?= $extra->item_rate ?>[<?= number_format($extra->item_quantity) ?>]</li>

                                                            <?php
                                                                $total_extra = $total_extra + ($extra->item_quantity * $extra->item_rate);
                                                            }
                                                            ?>



                                                        </td>

                                                        <td width="10%">
                                                            <?= $item->item_price + $total_extra ?>
                                                            <?php $total_items = $total_items + ($item->item_price + $total_extra); ?>
                                                            <?php $tests_total_1 += $total_items; ?>
                                                        </td>
                                                        <td width="10%">
                                                            <?php if ($item->test_status == 1) { ?>
                                                                Pending
                                                            <?php } else { ?>
                                                                Complete

                                                            <?php } ?>
                                                        </td>

                                                        <td width="30%">


                                                        <?php if ($item->test_status == 2) {

                                                            foreach ($item->extraSaleOptionItem as $extra){?>
                                                            <table width="100%">
                                                                <?php if($extra->product_name=="Folder " || $extra->product_name=="CD")
                                                                {

                                                                }
                                                                else
                                                                { ?>
                                                                <tr>
                                                                    <td width="80%"><?= $extra->product_name ?></td>
                                                                    <td width="20%"><?= $extra->product_quantity ?></td>
                                                                </tr>
                                                            <?php  } ?>

                                                            </table>


                                                        <?php } } ?>



                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                    <tr>

                                                        <td colspan="1"><strong>Total</strong></td>
                                                        <td colspan="2" class="text-center"><strong><?= $total_items ?></strong></td>

                                                    </tr>

                                                </table>

                                            </td>
                                            <td class="text-center">

                                                <?php
                                                if ($total_consultant > 0) {

                                                    echo $total_consultant;
                                                } else {

                                                    echo '';
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                if ($payment->sale->discount == 0) {
                                                    echo "";
                                                } else {
                                                    $discount_issue_1++;
                                                    echo $payment->sale->discount;
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $payment->sale->grand_total ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $payment->paidAmount ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $payment->amount ?>
                                            </td>
                                            <td class="text-center" >
                                                <?php
                                                $result = $payment->sale->grand_total - $payment->sale->paid_amount;
                                                if ($result == 0) {
                                                    echo "";
                                                } else {
                                                    echo $result;
                                                }
                                                ?>
                                            </td>

                                            <td class="text-center">
                                                <?= $payment->sale->user->username ?>
                                            </td>
                                        </tr>
                                    <?php }}
                                    ?>
                                    <tr>
                                        <td colspan="5" class="text-center"><strong>Total</strong></td>
                                        <!-- <td class="text-center"><strong><?= number_format($tests_total_1) ?></strong></td> -->
                                        <td class="text-center"><strong><?= number_format($sum_total_1) ?></strong></td>
                                        <td class="text-center"><strong><?= number_format($consultant_amount_1) ?></strong></td>
                                        <td class="text-center"><strong><?= number_format($sum_discount_1) ?></strong></td>
                                        <td class="text-center"><strong><?= number_format($sum_grand_total_1) ?></strong></td>
                                        <td class="text-center"><strong><?= number_format($sum_pre_paid_amount_1) ?></strong></td>
                                        <td class="text-center"><strong><?= number_format($sum_paid_amount_1) ?></strong></td>
                                        <td  class="text-center"><strong><?= number_format($sum_remaining_1) ?></strong></td>

                                        <td></td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <hr>
                    
                        <div class="text-center">
                            <strong>Expense: <?php if (isset($_GET['SalesSearch']['created_on'])) {
                                    echo $_GET['SalesSearch']['created_on'];
                                } else {
                                    echo $searchModel->created_on;
                                } ?> 
                            </strong>
                        </div>
                        <hr>
                        <hr>
                        <br>
                        <table class="table table-sm m-table table-bordered font" id="table">
                            <thead style="
                                    border-top: 2px solid black;
                                    border-bottom:  2px solid black;
                                    ">
                                <tr>
                                    <td class="text-center"><strong>Sno.</strong></td>
                                    <td class="text-center" width="10%"><strong>Time</strong></td>
                                    <td class="text-center"><strong>Amount</strong></td>
                                    <td class="text-center"><strong>Category</strong></td>
                                    <td class="text-center"><strong>Description</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i_3 = 0;
                                $expense_total = 0;
                                foreach ($expenses as $expense) {
                                    $i_3++;
                                    ?>
                                    <tr>
                                        <th scope="row">
                                            <?= $i_3 ?>
                                        </th>
                                        <td class="text-center">
                                            <?= \app\helpers\datetime::saleDateTime($expense->created_on); ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $expense->amount ?>
                                            <?php $expense_total = $expense->amount + $expense_total ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $expense->cat->name ?><br>
                                        </td>
                                        <td class="text-center">
                                            <?= $expense->note ?>
                                        </td>
                                    </tr>
                                    <?php 
                                }
                                ?>
                                <tr>

                                    <td colspan="2" class="text-center"><strong>Total</strong></td>
                                    <td class="text-center"><strong><?= number_format($expense_total) ?></strong></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-sm-6">
                        <h4>Cash Payment</h4>
                        <table class="table table-sm m-table table-bordered font">
                            <tbody>
                                <tr>
                                    <td><strong>Total No Of Patient</strong></td>

                                    <td><?= $CashSaleCount ?></td>
                                    <!-- <td><?= $i_1 + $i ?></td> -->
                                </tr>
                                <tr>
                                    <td><strong>Total Discount Issued</strong></td>
                                    <td><?= $cash_sale_discount_issue ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Grand Total Tests Amount</strong></td>
                                    <td><?= number_format($cash_sale_tests_total) ?></td>
                                </tr>

                                <tr>
                                    <td><strong>Total Discount Amount</strong></td>
                                    <td><?= number_format($cash_sale_sum_discount) ?></td>
                                </tr>

                                <tr>
                                    <td><strong>Total Amount</strong></td>
                                    <td><?= number_format($cash_sale_sum_grand_total) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Total Remaining Amount</strong></td>
                                    <td><?= number_format($cash_sale_sum_remaining) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Total Refund</strong></td>
                                    <td><?= number_format($cash_sale_total_refund) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Total Paid Amount</strong></td>
                                    <td><?= number_format($cash_sale_sum_paid_amount) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Received Cash Pending Amount</strong></td>
                                    <td><?= number_format($rcpp_sum_paid_amount_cash) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-6">
                        <h4>Credit Card Payment</h4>
                        <table class="table table-sm m-table table-bordered font">

                            <tbody>

                                <tr>
                                    <td><strong>Total No Of Patient</strong></td>
                                    <!-- <td><?= $i_1 + $i ?></td> -->
                                    <td><?=  $CreditCardSaleCount ?></td>

                                </tr>
                                <tr>
                                    <td><strong>Total Discount Issued</strong></td>
                                    <td><?= $discount_issue ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Grand Total Tests Amount</strong></td>
                                    <td><?= number_format($tests_total) ?></td>
                                </tr>

                                <tr>
                                    <td><strong>Total Discount Amount</strong></td>
                                    <td><?= number_format($sum_discount) ?></td>
                                </tr>

                                <tr>
                                    <td><strong>Total Amount</strong></td>
                                    <td><?= number_format($sum_grand_total) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Total Remaining Amount</strong></td>
                                    <td><?= number_format($sum_remaining_1 + $sum_remaining) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Total Refund</strong></td>
                                    <td><?= number_format($total_refund) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Total Paid Amount</strong></td>
                                    <td><?= number_format($sum_paid_amount) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Received Credit Card Pending Amount</strong></td>
                                    <td><?= number_format($sum_paid_amount_1) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-sm-6">
                        <h4>Easy Paisa Payment</h4>
                        <table class="table table-sm m-table table-bordered font">

                            <tbody>

                                <tr>
                                    <td><strong>Total No Of Patient</strong></td>
                                    <td><?= $easy_paisa_i ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Total Discount Issued</strong></td>
                                    <td><?= $easy_paisa_discount_issue ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Grand Total Tests Amount</strong></td>
                                    <td><?= number_format($easy_paisa_tests_total) ?></td>
                                </tr>

                                <tr>
                                    <td><strong>Total Discount Amount</strong></td>
                                    <td><?= number_format($sum_easy_paisa_discount) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Total Refund</strong></td>
                                    <td><?= number_format($easy_paisa_total_refund) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Total Amount</strong></td>
                                    <td><?= number_format($easy_paisa_sum_grand_total) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Total Paid Amount</strong></td>
                                    <td><?= number_format($sum_easy_paisa) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    <div class="col-sm-6">
                        <h4>Jazz Cash Payment</h4>
                        <table class="table table-sm m-table table-bordered font">

                            <tbody>

                                <tr>
                                    <td><strong>Total No Of Patient</strong></td>
                                    <td><?= $jazz_cash_i ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Total Discount Issued</strong></td>
                                    <td><?= $jazz_cash_discount_issue ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Grand Total Tests Amount</strong></td>
                                    <td><?= number_format($jazz_cash_tests_total) ?></td>
                                </tr>

                                <tr>
                                    <td><strong>Total Discount Amount</strong></td>
                                    <td><?= number_format($sum_jazz_cash_discount) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Total Refund</strong></td>
                                    <td><?= number_format($jazz_cash_total_refund) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Total Amount</strong></td>
                                    <td><?= number_format($jazz_cash_sum_grand_total) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Total Paid Amount</strong></td>
                                    <td><?= number_format($sum_jazz_cash) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6">

                        <table class="table table-sm m-table table-bordered font">

                            <tbody>
                                <tr>
                                    <td><strong>Total Consultant Amount</strong></td>
                                    <td><?= number_format($cash_sale_total_consultant_amount+$credit_card_sale_total_consultant_amount+$easy_paisa_total_consultant+$jazz_cash_total_consultant) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Total Expense Amount</strong></td>
                                    <td><?= number_format($expense_total) ?></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-3">
                        <table class="table table-sm m-table table-bordered font">
                            <tbody>
                                <tr>
                                    <td><span style="font-size: large">CASH IN HAND SALE</span></td>
                                    <td>
                                        <?php
                                        $total_cash_sale = $rcpp_sum_paid_amount_cash + $cash_sale_sum_paid_amount - $expense_total - $cash_sale_total_consultant_amount -  $credit_card_sale_total_consultant_amount - $jazz_cash_consultant_amount-$cash_sale_total_refund-$total_refund-$easy_paisa_total_refund-$jazz_cash_total_refund;
                                        echo number_format($total_cash_sale);
                                        $total_sale+=$total_cash_sale; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                        <div class="col-sm-3">
                        <table class="table table-sm m-table table-bordered font">

                            <tbody>

                                <tr>
                                    <td><span style="font-size: large">Credit Card SALE</span></td>
                                    <td>
                                        <?php
                                        $total_credit_card_sale = $sum_paid_amount_1 + $sum_paid_amount - $easy_paisa_consultant_amount;
                                        echo number_format($total_credit_card_sale) ;
                                        $total_sale+=$total_credit_card_sale;
                                        ?>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-3">

                        <table class="table table-sm m-table table-bordered font">

                            <tbody>

                                <tr>
                                    <td><span style="font-size: large">EASY PAISA SALE</span></td>
                                    <td><?php
                                    $total_sale += $sum_easy_paisa;
                                    echo number_format($sum_easy_paisa) ?></td>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                    <div class="col-sm-3">

                        <table class="table table-sm m-table table-bordered font">

                            <tbody>

                                <tr>
                                    <td><span style="font-size: large">Jazz Cash SALE</span></td>
                                    <td><?php
                                    $total_sale += $sum_jazz_cash;
                                    echo number_format($sum_jazz_cash) ?></td>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <table class="table table-sm m-table table-bordered font">
                        <tbody>
                            <tr>
                                <td><span style="font-size: large">TOTAL Tests Ammount</span></td>
                                <td><?= number_format($cash_sale_sum_grand_total+$sum_grand_total+$jazz_cash_sum_grand_total+$easy_paisa_sum_grand_total) ?></td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                    <div class="col-sm-6">
                        <table class="table table-sm m-table table-bordered font">

                            <tbody>

                                <tr>
                                    <td><span style="font-size: large">TOTAL SALE</span></td>
                                    <td><?= number_format($total_sale) ?></td>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                </div>
                <p class="text-center">Report Printed At : <?= $report_print ?></p>
            </div>
            <br>
        </page>
    </body>

</html>
