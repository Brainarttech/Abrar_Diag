

<?php

use app\models\Sales;


if (isset($_GET['day']) && !empty($_GET['day']))
{

    $today_date = str_split($_GET['day'],2);
    $today_date = implode('-',$today_date);
    $today = '20'.$today_date;
    $sales = \app\models\Sales::find()
        ->innerJoinWith('saleitems')
        ->innerJoinWith('patient')
        ->innerJoinWith('referred')
        ->andWhere(['like','sale.created_on',$today])->all();

    $time = strtotime($today);

    $myFormatForView = date("d/m/Y", $time);


}else if(isset($_GET['from']) && isset($_GET['to']) && !empty($_GET['from']) && !empty($_GET['to']))
{
    $from = $_GET['from'];
    $to = $_GET['to'];
    $start_date = $_GET['from'];
    $end_date  = $_GET['to'];


    $start_date = DateTime::createFromFormat('d/m/Y', $start_date);
    $start_date = $start_date->format('Y-m-d');

    $end_date = DateTime::createFromFormat('d/m/Y', $end_date);
    $end_date = $end_date->format('Y-m-d');
    $sales = \app\models\Sales::find()
        ->innerJoinWith('saleitems')
        ->innerJoinWith('patient')
        ->innerJoinWith('referred')
        ->andWhere(['between', 'sale.created_on', $start_date, $end_date])->all();


    $myFormatForView = $from.' - '. $to;



}
else
{
    $today = date('Y-m-d');
    $sales = \app\models\Sales::find()
        ->innerJoinWith('saleitems')
        ->innerJoinWith('patient')
        ->innerJoinWith('referred')
        ->andWhere(['like','sale.created_on',$today])->all();
    $time = strtotime($today);

    $myFormatForView = date("d/m/Y", $time);

}



$report_print = date("Y-m-d H:i:s");
$phpdate = strtotime( $report_print );
//$date = date( 'd/m/Y', $phpdate );
$report_print = date('d/m/Y h:i A',$phpdate);
//$sales = Sales::find()->where(['like','sale.created_on',$today]);



/*echo "<pre>";
print_r($sales);
echo "</pre>";*/


?>


<!DOCTYPE html>
<html>
<head>
    <title>Daily Sale Report : <?=$myFormatForView?> </title>
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
        <div class="text-center"><strong>Daily Sale Report : <?=$myFormatForView?></strong></div>
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
                                    <td class="text-center" width="10%"><strong>Time</strong></td>
                                    <td class="text-center"><strong>Receipt</strong></td>
                                    <td class="text-center"><strong>Patient</strong></td>
                                    <td class="text-center"><strong>Referred</strong></td>
                                    <td class="text-center"><strong>Total</strong></td>
                                    <td class="text-center"><strong>Discount</strong></td>
                                    <td class="text-center"><strong>Grand Total</strong></td>
                                    <td class="text-center"><strong>Paid</strong></td>
                                    <td class="text-center"><strong>Remaining</strong></td>

                                    <td class="text-center"><strong>Sale By</strong></td>
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
                                foreach ($sales as $sale)
                                {
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
                                            <?= \app\helpers\datetime::saleTime($sale->created_on);?>
                                        </td>
                                        <td class="text-center">
                                            <?= $sale->invoice_no?>
                                        </td>
                                        <td class="text-center">
                                            <?= $sale->patient->name?>
                                        </td>
                                        <td class="text-center">
                                            <?= $sale->referred->name?>
                                        </td>
                                        <td class="text-center">
                                            <?= $sale->total?>
                                        </td>
                                        <td class="text-center">
                                            <?php

                                            if($sale->discount==0)
                                            {
                                                echo "";
                                            }else{
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
                                        <td class="text-center">
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
                                    <td class="text-center"><strong><?= number_format($sum_total) ?></strong></td>
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

                <p class="text-center">Report Printed At : <?= $report_print ?></p>

            </div>
        </div>
    </div>
    <br>

</page>
</body>

</html>