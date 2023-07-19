
<?php

use app\models\Sales;


$sales = $dataProvider->models;
$report_print = date("Y-m-d H:i:s");
$phpdate = strtotime( $report_print );
//$date = date( 'd/m/Y', $phpdate );
$report_print = date('d/m/Y h:i A',$phpdate);


?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Sale Report : <?= $_GET['SalesSearch']['created_on']?> </title>
    <link href="<?php echo Yii::$app->homeUrl?>css/boot.min.css" rel="stylesheet" type='text/css' id="bootstrap-css">
    <link rel="stylesheet" type='text/css' href="<?php echo Yii::$app->homeUrl?>css/print_bill.css">

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
        <hr>
        <hr>
        <div class="text-center"><strong>Detail Sale Report : <?= $_GET['SalesSearch']['created_on']?> </strong></div>
        <hr>
        <hr>
        <br>


        <div class="row">
            <div class="col-sm-12">
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
                                $consultant_amount = 0;
                                foreach ($sales as $sale)
                                {

                                    $total_extra = 0;
                                    $total_items = 0;
                                    $total_consultant = 0;
                                    $i++;
                                    $sum_total = $sum_total + $sale->total;
                                    $sum_discount = $sum_discount +  $sale->discount;
                                    $sum_grand_total = $sum_grand_total +  $sale->grand_total;
                                    $sum_paid_amount = $sum_paid_amount +  $sale->paid_amount;
                                    $sum_remaining = $sum_remaining +  ($sale->grand_total - $sale->paid_amount);
                                    ?>
                                    <tr>
                                        <th scope="row">
                                            <?= $i?>
                                        </th>
                                        <td class="text-center">
                                            <?= \app\helpers\datetime::saleDateTime($sale->created_on);?>
                                        </td>
                                        <td class="text-center">
                                            <?= $sale->invoice_no?>
                                        </td>
                                        <td class="text-center">
                                            <?= $sale->patient->name?><br>
                                            <?= $sale->patient->reg_no?>
                                        </td>
                                        <td class="text-center">
                                            <?= $sale->referred->name?>
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
                                                <?php foreach($sale->saleitems as $item){?>

                                                    <?php

                                                    $consultant_amount = $consultant_amount + $item->consultant_amount;
                                                    $total_consultant =  $total_consultant + $item->consultant_amount;
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?= $item->item_name?> ( <strong> <?= $item['item']['category']->name?></strong>)

                                                            <?php foreach ($item['extra'] as $extra){?>

                                                                <li><?= $extra->item_name?> - <?= $extra->item_rate?>[<?= number_format($extra->item_quantity)?>]</li>

                                                                <?php
                                                                $total_extra = $total_extra + ($extra->item_quantity * $extra->item_rate);

                                                            } ?>



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

                                            <?php if($total_consultant>0){

                                                echo $total_consultant;

                                            }else {

                                                echo '';

                                            }?>
                                        </td>


                                        <td class="text-center">
                                            <?php

                                            if($sale->discount==0)
                                            {
                                                echo "";
                                            }else{
                                                $discount_issue++;
                                                echo $sale->discount;
                                            }

                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $sale->grand_total?>
                                        </td>
                                        <td class="text-center">
                                            <?= $sale->paid_amount?>
                                        </td>
                                        <td class="text-center" >
                                            <?php
                                            $result = $sale->grand_total - $sale->paid_amount;
                                            if($result==0)
                                            {
                                                echo "";
                                            }else{
                                                echo $result;
                                            }

                                            ?>
                                        </td>

                                        <td class="text-center">
                                            <?= $sale->user->username ?>
                                        </td>
                                    </tr>
                                <?php }
                                ?>

                                <tr>
                                    <td colspan="5" class="text-center"><strong>Total</strong></td>
                                    <td class="text-center"><strong><?= number_format($tests_total) ?></strong></td>
                                    <td class="text-center"><strong><?= number_format($consultant_amount)?></strong></td>
                                    <td class="text-center"><strong><?=  number_format($sum_discount) ?></strong></td>
                                    <td class="text-center"><strong><?= number_format($sum_grand_total) ?></strong></td>
                                    <td class="text-center"><strong><?= number_format($sum_paid_amount) ?></strong></td>
                                    <td  class="text-center"><strong><?= number_format($sum_remaining) ?></strong></td>

                                    <td></td>

                                </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <br>
                <br>

                <div class="row">
                    <div class="col-sm-6">

                    </div>
                    <div class="col-sm-6">

                        <table class="table table-sm m-table table-bordered font">

                            <tbody>

                            <tr>
                                <td><strong>Total No Of Patient</strong></td>
                                <td><?= $i?></td>
                            </tr>
                            <tr>
                                <td><strong>Total Discount Issued</strong></td>
                                <td><?= $discount_issue?></td>
                            </tr>
                            <tr>
                                <td><strong>Total Tests Amount</strong></td>
                                <td><?= number_format($tests_total)?></td>
                            </tr>
                            <tr>
                                <td><strong>Total Consultant Amount</strong></td>
                                <td><?= number_format($consultant_amount)?></td>
                            </tr>
                            <tr>
                                <td><strong>Total Discount Amount</strong></td>
                                <td><?= number_format($sum_discount)?></td>
                            </tr>
                            <tr>
                                <td><strong>Total Amount</strong></td>
                                <td><?= number_format($sum_grand_total)?></td>
                            </tr>
                            <tr>
                                <td><strong>Total Paid Amount</strong></td>
                                <td><?=  number_format($sum_paid_amount) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Total Remaining Amount</strong></td>
                                <td><?= number_format($sum_remaining) ?></td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

                <br>
                <br>

                <div class="row">
                    <div class="col-sm-6">

                    </div>
                    <div class="col-sm-6">

                        <table class="table table-sm m-table table-bordered font">

                            <tbody>

                            <tr>
                                <td><span style="font-size: large">CASH IN HAND SALE</span></td>
                                <td><?= number_format($sum_paid_amount - $consultant_amount )?></td>
                            </tr>

                            </tbody>
                        </table>

                    </div>
                </div>

                <br>
                <br>
                <p class="text-center">Report Printed At : <?= $report_print ?></p>

            </div>
        </div>
    </div>
    <br>

</page>
</body>

</html>