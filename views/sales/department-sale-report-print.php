
<?php

use app\models\Sales;
use app\models\ItemCategory;
$sales = $dataProvider->models;
$report_print = date("Y-m-d H:i:s");
$phpDate = strtotime( $report_print );
$report_print = date('d/m/Y h:i A',$phpDate);
$departmentName ='';
$departmentId = Yii::$app->request->queryParams['SalesSearch']['department'];
if($departmentId)
{
    $department = ItemCategory::find()->select(['name'])->where(['id' => $departmentId ])->one();
    $departmentName = $department->name;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= $departmentName? $departmentName: "Department" ?> Sale Report : <?= $_GET['SalesSearch']['created_on']?> </title>
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
            <div class="col-sm-5 text-right">
                <p >Tel: 5470205, 5167015, 5473543<br>Fax: 051-8317450, Cell: 0331-5261588<br>
                    Email: mri_ct@hotmail.com<br>Web: www.abrardiagnostics.com.pk</p>
            </div>
        </div>
        <hr>
        <hr>
        <div class="text-center"><strong><?= $departmentName? $departmentName: "Department" ?>  Sale Report : <?= $_GET['SalesSearch']['created_on']?> </strong></div>
        <hr>
        <hr>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-sm m-table table-bordered font" id="table">
                                <thead style="border-top: 2px solid black; border-bottom:  2px solid black;">
                                    <tr>
                                        <td class="text-center"><strong>Sno.</strong></td>
                                        <td class="text-center" ><strong>Department</strong></td>
                                        <td class="text-center"><strong>Total Tests</strong></td>
                                        <td class="text-center"><strong>Total Amount</strong></td>
                                        <td class="text-center"><strong> Total Discount</strong></td>
                                        <td class="text-center" ><strong>Total Consultant</strong></td>
                                        <td class="text-center"><strong>Total</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i = 0;
                                        $sum_tests = 0;
                                        $sum_total_amount = 0;
                                        $sum_discount = 0;
                                        $sum_consultant_amount = 0;
                                        $sum_grand_total = 0;
                                        foreach ($sales as $provider)
                                        {

                                            $grand_total = $provider->total_amount - $provider->total_discount;
                                            $sum_grand_total = $sum_grand_total+$grand_total;
                                            $sum_tests = $sum_tests + $provider->total_test;
                                            $sum_total_amount = $sum_total_amount + $provider->total_amount;
                                            $sum_discount = $sum_discount + $provider->total_discount;
                                            $sum_consultant_amount = $sum_consultant_amount+ $provider->total_consultant;
                                            $i++;
                                            ?>
                                            <tr>
                                                <th scope="row">
                                                    <?= $i?>
                                                </th>
                                                <td class="text-center">
                                                    <?= $provider->item_category ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $provider->total_test?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $provider->total_amount?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $provider->total_discount?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $provider->total_consultant?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $grand_total?>
                                                </td>
                                            </tr>
                                            <?php 
                                        }
                                    ?>
                                    <tr>
                                        <td colspan="2" class="text-center"><strong>Total</strong></td>
                                        <td class="text-center"><strong><?= number_format($sum_tests) ?></strong></td>
                                        <td class="text-center"><strong><?= number_format($sum_total_amount)?></strong></td>
                                        <td class="text-center"><strong><?=  number_format($sum_discount) ?></strong></td>
                                        <td class="text-center"><strong><?= number_format($sum_consultant_amount) ?></strong></td>
                                        <td class="text-center"><strong><?= number_format($sum_grand_total) ?></strong></td>
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
                                <td><strong>Total No Of Tests</strong></td>
                                <td><?= number_format($sum_tests)?></td>
                            </tr>
                            <tr>
                                <td><strong>Total Tests Amount</strong></td>
                                <td><?= number_format($sum_total_amount)?></td>
                            </tr>
                            <tr>
                                <td><strong>Total Consultant Amount</strong></td>
                                <td><?= number_format($sum_consultant_amount)?></td>
                            </tr>
                            <tr>
                                <td><strong>Total Discount Amount</strong></td>
                                <td><?= number_format($sum_discount)?></td>
                            </tr>
                            <tr>
                                <td><strong>Total Amount</strong></td>
                                <td><?= number_format($sum_grand_total)?></td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
                <br>
                <br>
                <p class="text-right">Report Printed At : <?= $report_print ?></p>

            </div>
        </div>
    </div>
    <br>

</page>
</body>

</html>