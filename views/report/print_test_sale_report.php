
<?php

use app\models\Sales;


$query = $dataProvider->models;
$report_print = date("Y-m-d H:i:s");
$phpdate = strtotime( $report_print );
//$date = date( 'd/m/Y', $phpdate );
$report_print = date('d/m/Y h:i A',$phpdate);


?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Sale Report : <?= $_GET['SalesItemSearch']['created_on']?> </title>
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
<page size="A4">
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
        <div class="text-center"><strong>Test Wise Report : <?= $_GET['SalesItemSearch']['created_on']?> </strong></div>
        <hr>
        <hr>
        <br>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-sm m-table table-bordered font">
                                <thead style="
                                    border-top: 2px solid black;
                                    border-bottom:  2px solid black;
                                    ">
                                <tr>
                                    <td class="text-center"><strong>Sno.</strong></td>
                                    <td class="text-center" width="10%"><strong>Test Name</strong></td>
                                    <td class="text-center"><strong>Department</strong></td>
                                    <td class="text-center"><strong>Patient</strong></td>
                                    <td class="text-center"><strong>Referred</strong></td>
                                    <td class="text-center"><strong>Rate</strong></td>
                                    <td class="text-center"><strong>Time</strong></td>
                                    <td class="text-center"><strong>Status</strong></td>
                                    <td class="text-center"><strong>Update By</strong></td>
                                    <td class="text-center"><strong>Update Time</strong></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i = 0;
                                $sum_total = 0;
                                foreach ($query as $sale)
                                {
                                    $i++;
                                    $sum_total = $sum_total + $sale->item_price;
                                    ?>
                                    <tr>
                                        <th scope="row">
                                            <?= $i?>
                                        </th>
                                        <td class="text-center">
                                            <?= $sale->item->name?>

                                        </td>
                                        <td class="text-center">
                                            <?= $sale->item->category->name?>
                                        </td>
                                        <td class="text-center">
                                            <?= $sale->sale->patient->name?>
                                        </td>
                                        <td class="text-center">
                                            <?= $sale->sale->referred->name?>
                                        </td>
                                        <td class="text-center">
                                            <?= $sale->item_price?>
                                        </td>
                                        <td class="text-center">
                                            <?= \app\helpers\datetime::saleDateTime($sale->created_on);?>
                                        </td>
                                        <td class="text-center">

                                            <?php
                                            if($sale->test_status==1){ ?>
                                                Pending
                                            <?php } else { ?>
                                                Complete

                                            <?php } ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $sale->update->username?>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                            if(!empty($sale->updated_on)){
                                                echo \app\helpers\datetime::saleDateTime($sale->updated_on);
                                            }
                                            ?>

                                        </td>
                                    </tr>
                                <?php }
                                ?>
                                <!--<tr>
                                    <td colspan="5" class="text-center"><strong>Total</strong></td>
                                    <td class="text-center"><strong><?/*= number_format($sum_total) */?></strong></td>
                                    <td class="text-center"><strong></td>
                                    <td class="text-center"><strong></strong></td>
                                    <td class="text-center"><strong></strong></td>
                                    <td  class="text-center"><strong></strong></td>

                                    <td></td>

                                </tr>-->


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <p class="text-center">Report Printed At : <?= $report_print ?></p>

            </div>
        </div>
    </div>
    <br>

</page>
</body>

</html>