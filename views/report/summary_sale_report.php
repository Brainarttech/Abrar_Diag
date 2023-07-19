<?php

use app\models\User;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\dropdown\DropdownX;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */



$this->title = 'Summary Sale Report';
$this->params['breadcrumbs'][] = $this->title;


?>

<style>
    .table-sm td, .table-sm th{
        padding: .rem;
    }
</style>

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

<div class="sales-index">

<link rel="stylesheet" type='text/css' href="<?php echo Yii::$app->homeUrl ?>css/print_bill.css">
    <?php Pjax::begin(['timeout' => '30000']); ?>
    <?php  echo $this->render('_summary_sale_search', ['model' => $searchModel]); ?>
    
    <?php
        $sales = $dataProvider->models;
        $count=0;
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
        $sum_total_1 = 0;
        $sum_discount_1 = 0;
        $sum_grand_total_1 = 0;
        $sum_paid_amount_1 = 0;
        $sum_remaining_1 = 0;
        $tests_total_1 = 0;
        $discount_issue_1 = 0;
        $consultant_amount_1 = 0;
        $sum_pre_paid_amount_1=0;
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
                foreach ($sale->saleitems as $item) { 
                    $cash_sale_consultant_amount = $cash_sale_consultant_amount + $item->consultant_amount;
                    foreach ($item['extra'] as $extra) {
                        $total_extra = $total_extra + ($extra->item_quantity * $extra->item_rate);
                    }
                    $total_items = $total_items + ($item->item_price + $total_extra);    
                }
                $cash_sale_tests_total = $cash_sale_tests_total + $total_items;
                if ($cash_sale_consultant_amount>0) {
                    $cash_sale_total_consultant_amount +=$cash_sale_consultant_amount;
                }
                if ($sale->discount) {
                    $cash_sale_discount_issue++;
                }
                $cash_sale_total_refund += $sale->refund_amount;
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
                foreach ($sale->saleitems as $item) { 
                    $credit_card_sale_consultant_amount = $credit_card_sale_consultant_amount + $item->consultant_amount;
                    foreach ($item['extra'] as $extra) {
                        $total_extra = $total_extra + ($extra->item_quantity * $extra->item_rate);
                    }
                    $total_items = $total_items + ($item->item_price + $total_extra);
                           
                } 
                $tests_total = $tests_total + $total_items;
                if ($credit_card_sale_consultant_amount > 0) {
                    $credit_card_sale_total_consultant_amount+=$credit_card_sale_consultant_amount;
                } 
                if ($sale->discount) {
                    $discount_issue++;
                }
                $total_refund += $sale->refund_amount;
            }
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
                foreach ($sale->saleitems as $item) { 
                            $jazz_cash_consultant_amount = $jazz_cash_consultant_amount + $item->consultant_amount;
                            $jazz_cash_total_consultant = $jazz_cash_total_consultant + $item->consultant_amount;
                            foreach ($item['extra'] as $extra) { 
                                $jazz_cash_total_extra = $jazz_cash_total_extra + ($extra->item_quantity * $extra->item_rate);
                            }
                            $jazz_cash_total_items = $jazz_cash_total_items + ($item->item_price + $total_extra);
                            
                }
                $jazz_cash_tests_total = $jazz_cash_tests_total + $jazz_cash_total_items;
                if ($sale->discount) {
                    $jazz_cash_discount_issue++;
                }
                $jazz_cash_total_refund += $sale->refund_amount; 
            }
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
                foreach ($sale->saleitems as $item) { 
                    $easy_paisa_consultant_amount = $easy_paisa_consultant_amount + $item->consultant_amount;
                    $easy_paisa_total_consultant = $easy_paisa_total_consultant + $item->consultant_amount;
                    foreach ($item['extra'] as $extra) { 
                        $easy_paisa_total_extra = $easy_paisa_total_extra + ($extra->item_quantity * $extra->item_rate);
                    }
                    $easy_paisa_total_items = $easy_paisa_total_items + ($item->item_price + $total_extra);
                }
                $easy_paisa_tests_total = $easy_paisa_tests_total + $easy_paisa_total_items;   
                if ($sale->discount) {
                    $easy_paisa_discount_issue++;
                }
            }
        }
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
                foreach ($payment->sale->saleitems as $item) {
                    $rccp_consultant_amount = $rccp_consultant_amount + $item->consultant_amount;
                    $total_consultant = $total_consultant + $item->consultant_amount;
                    foreach ($item['extra'] as $extra) { 
                        $total_extra = $total_extra + ($extra->item_quantity * $extra->item_rate);
                    }
                    $total_items = $total_items + ($item->item_price + $total_extra);
                    $received_cash_pending_payments_total += $total_items;
                }
                if ($payment->sale->discount) {
                    $rcpp_discount_issue++;
                }
            }
            if($payment->mop_id==2)                      {
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
                foreach ($payment->sale->saleitems as $item) {
                    $consultant_amount_1 = $consultant_amount_1 + $item->consultant_amount;
                    $total_consultant = $total_consultant + $item->consultant_amount;
                    foreach ($item['extra'] as $extra) {
                        $total_extra = $total_extra + ($extra->item_quantity * $extra->item_rate);
                    }
                                
                    $total_items = $total_items + ($item->item_price + $total_extra);
                    $tests_total_1 += $total_items;
                              
                } 
                if ($payment->sale->discount == 0) {
                    $discount_issue_1++;
                }
            }
        }
    ?>

    <div class="container">
        <div class="row p-2">
            <div class="col-12">
                <?= Html::a ( '<i class="fa fa-repeat"></i> '.Yii::t ( 'app', 'Reset List' ), [
                    'summary-sale-report'

                    ], [

                    'class' => 'btn btn-info'

                    ] ).'&nbsp;&nbsp;<a class="btn btn-success"  target=_blank href="'.Yii::$app->homeUrl.'report/summary-sale-report?type=print&'.$_SERVER['QUERY_STRING'].'"><i class="fa fa-print">  Print</i></a>' 
                ?>
            </div>
        </div>
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
                        <td><span style="font-size: large">TOTAL Tests Amount</span></td>
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
    </div>
</div>

