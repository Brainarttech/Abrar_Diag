<?php

$id = $_GET['id'];

$sales = \app\models\Sales::find()->select('paid_amount')->where(['id'=>$id])->one();
if($sales->paid_amount > 0){

    $sales = \app\models\Sales::find()
        ->joinWith('saleitems')
        ->joinWith('payments')
        ->joinWith('patient')
        ->joinWith('referred')
        ->joinWith('payments.mop')
        ->joinWith('saleitems.extra')
        ->andWhere(['sale.id'=>$id])->one();

}else {
    $sales = \app\models\Sales::find()
        ->joinWith('saleitems')
        ->joinWith('patient')
        ->joinWith('referred')
        ->joinWith('saleitems.extra')
        ->andWhere(['sale.id'=>$id])->one();
}

/*echo "<pre>";
print_r($sales);
echo "</pre>";*/

?>


<!DOCTYPE html>
<html>
<head>
    <title>Print Bill</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" rel="stylesheet" type='text/css' id="bootstrap-css">
    <link rel="stylesheet" type='text/css' href="<?php echo Yii::$app->homeUrl?>css/boot.min.css">
    <link rel="stylesheet" type='text/css' href="<?php echo Yii::$app->homeUrl?>css/print_bill.css">

</head>

<body class="font">
<page size="A4">
    <div class="container">

        <div class="row">
            <div class="col-sm-7">
                <h4>Abrar Diagnostic Centre</h4>
                <p style="margin-top: -7px;"><strong>312-E Charing Cross,<br>Peshawar Road, Rawalpindi Cantt</strong></p>
            </div>
            <div class="col-sm-5">
                <p >Tel: 5470205, 5167015, 5473543<br>Cell: 0331-5261588, Fax: 051-8317450<br>
                    Email: mri_ct@hotmail.com<br>Web: www.abrardiagnostics.com.pk</p>
            </div>

        </div>
        <hr>
        <hr>

        <div class="row" style="margin-top: 15px;">
            <div class="col-sm-7">
                <p>
                    <strong>Receipt No:</strong>
                    <?=$sales->invoice_no?><br>
                    <strong>Patient Name:</strong>
                    <?= ucfirst($sales->patient->name);?><br>
                    <strong>Date/Time:</strong>
                    <?= app\helpers\datetime::printBill($sales->created_on)?><br>
                    <strong>Panel:</strong>
                    Nill<br>
                </p>
            </div>
            <div class="col-sm-5">
                <p class="">
                    <strong>Patient Id:</strong>
                    <?=$sales->patient->reg_no?><br>
                    <strong>Age/Sex:</strong>
                    <?= $sales->patient->age.$sales->patient->age_type?> / <?= $sales->patient->gender?><br>
                    <strong>Referred By:</strong>
                    <?=$sales->referred->name?><br>
                    <strong>Entered By:</strong>
                    <?= Yii::$app->user->identity->username?>  <br>
                </p>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed font">
                                <thead style="
                                    border-top: 2px solid black;
                                    border-bottom:  2px solid black;
                                    ">
                                <tr>
                                    <td><strong>Test Detail</strong></td>
                                    <td class="text-center"><strong>Report Delivery Date/Time</strong></td>
                                    <td class="text-right"><strong>Charges</strong></td>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                <?php

                                $total = 0;
                                $extra_total = 0;
                                $flag = 0;
                                $first_time = 0;

                                ?>
                                <?php foreach ($sales->saleitems as $items){

                                    $total = $total + $items->item_price;

                                    ?>
                                    <tr>
                                        <?php if($items->test_status == 3){
                                        // $total = $total + $items->refund_surcharge;

                                        ?>
                                        <td><del><?=$items->item_name?></del>
                                            <?php if($items->refund_surcharge > 0){ ?>
                                                <br>
                                                Refund Charges : Rs <?= $items->refund_surcharge ?>
                                            <?php } ?>
                                            <?php if($items->extra){

                                                $flag = 1;

                                                foreach($items->extra as $extra ){?>
                                                    <li><?= $extra['item_name']?></li>
                                                <?php } } ?>
                                        </td>

                                        <td class="text-center"><del><?= app\helpers\datetime::printBillReportDelivery($items->created_on)?></del></td>
                                        <td class="text-right">Rs <?=$items->item_price?>

                                            <?php if($items->extra){
                                                $rate =0;
                                                foreach($items->extra as $extra ){
                                                    $extra_total =  $extra_total + ($extra['item_rate'] * $extra['item_quantity']);
                                                    $rate = $rate + $extra_total;
                                                    ?>
                                                    <br>
                                                    <span class="m-list-timeline__time">Rs <?=  $extra['item_rate'] * $extra['item_quantity'] ?></span>
                                                <?php } ?>

                                                <hr>
                                                Rs <?=$items->item_price + $rate ?>

                                            <?php  } ?>
                                        </td>
                                        <?php }else {



                                            ?>
                                            <td><?=$items->item_name?>
                                                <?php if($items->extra){

                                                    $flag = 1;

                                                    foreach($items->extra as $extra ){?>
                                                        <li><?= $extra['item_name']?></li>
                                                    <?php } } ?>
                                            </td>
                                            <td class="text-center"><?= app\helpers\datetime::printBillReportDelivery($items->created_on)?></td>
                                            <td class="text-right">Rs <?=$items->item_price?>
                                                <?php if($items->extra){
                                                    $rate =0;
                                                    foreach($items->extra as $extra ){
                                                        $extra_total =  $extra_total + ($extra['item_rate'] * $extra['item_quantity']);
                                                        $rate = $rate + $extra_total;
                                                        ?>
                                                        <br>
                                                        <span class="m-list-timeline__time">Rs <?=  $extra['item_rate'] * $extra['item_quantity'] ?></span>
                                                    <?php } ?>

                                                    <hr>
                                                    Rs <?=$items->item_price + $rate ?>

                                                <?php  } ?>
                                            </td>

                                        <?php } ?>
                                    </tr>
                                <?php }?>

                                <?php if($sales->tax==0 && $sales->discount==0 ){?>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line text-right"><strong>Total</strong></td>
                                        <td class="no-line text-right">Rs <?= number_format($grandtotal = $total + $extra_total )?></td>
                                    </tr>

                                    <?php if($sales->sale_status == 2 || $sales->sale_status == 3) { ?>


                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line text-right"><strong>Refund Amount</strong></td>
                                        <td class="no-line text-right">Rs <?= number_format($sales->refund_amount )?></td>
                                    </tr>

                                        <?php } ?>


                                <?php }else { ?>
                                    <tr>
                                        <td class="thick-line"></td>
                                        <td class="thick-line text-right"><strong>Subtotal</strong></td>
                                        <td class="thick-line text-right">Rs <?= number_format($extra_total + $total)?></td>
                                    </tr>

                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line text-right"><strong>Discount</strong></td>
                                        <td class="no-line text-right">Rs <?= number_format($sales->discount)?></td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line text-right"><strong>Total</strong></td>
                                        <td class="no-line text-right">Rs <?php $grandtotal = ($extra_total+$total)-$sales->discount;echo number_format($grandtotal);?></td>
                                    </tr>

                                    <?php if($sales->sale_status == 2 || $sales->sale_status == 3) { ?>


                                        <tr>
                                            <td class="no-line"></td>
                                            <td class="no-line text-right"><strong>Refund Amount</strong></td>
                                            <td class="no-line text-right">Rs <?= number_format($sales->refund_amount )?></td>
                                        </tr>

                                    <?php } ?>

                                <?php }?>



                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line text-right"><strong>Paid</strong></td>
                                    <td class="no-line text-right">Rs <?= number_format($sales->paid_amount)?></td>
                                </tr>

                                <?php if($sales->sale_status == 2 || $sales->sale_status == 3) { ?>


                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line text-right"><strong>Balance</strong></td>
                                        <td class="no-line text-right">Rs <?= number_format($sales->grand_total - ( $sales->paid_amount + $sales->refund_amount))?></td>

                                    </tr>

                                <?php }else { ?>

                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line text-right"><strong>Balance</strong></td>
                                    <td class="no-line text-right">Rs <?= number_format($sales->grand_total - $sales->paid_amount)?></td>

                                </tr>

                                <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <p class="text-center">Please bring this receipt for Report Collection / further Investigations</p>
                <img src="<?= Yii::$app->homeUrl?>images/frame.png" style="position: absolute;top: -220px;right: 10px;" alt="Facebook QR Code" height="62" width="62">
            </div>
        </div>
    </div>
    <br>
    <hr>
    <br>
    <div class="container">

        <div class="row">
            <div class="col-sm-7">
                <h4>Abrar Diagnostic Centre</h4>
                <p style="margin-top: -7px;"><strong>312-E Charing Cross,<br>Peshawar Road, Rawalpindi Cantt</strong></p>
            </div>
            <div class="col-sm-5">
                <p >Tel: 5470205, 5167015, 5473543<br>Cell: 0331-5261588, Fax: 051-8317450<br>
                    Email: mri_ct@hotmail.com<br>Web: www.abrardiagnostics.com.pk</p>
            </div>

        </div>
        <hr>
        <hr>

        <div class="row" style="margin-top: 15px;">
            <div class="col-sm-7">
                <p>
                    <strong>Receipt No:</strong>
                    <?=$sales->invoice_no?><br>
                    <strong>Patient Name:</strong>
                    <?= ucfirst($sales->patient->name);?><br>
                    <strong>Date/Time:</strong>
                    <?= app\helpers\datetime::printBill($sales->created_on)?><br>
                    <strong>Panel:</strong>
                    Nill<br>
                </p>
            </div>
            <div class="col-sm-5">
                <p class="">
                    <strong>Patient Id:</strong>
                    <?=$sales->patient->reg_no?><br>
                    <strong>Age/Sex:</strong>
                    <?= $sales->patient->age.$sales->patient->age_type?> / <?= $sales->patient->gender?><br>
                    <strong>Referred By:</strong>
                    <?=$sales->referred->name?><br>
                    <strong>Entered By:</strong>
                    <?= Yii::$app->user->identity->username?>  <br>
                </p>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed font">
                                <thead style="
                                    border-top: 2px solid black;
                                    border-bottom:  2px solid black;
                                    ">
                                <tr>
                                    <td><strong>Test Detail</strong></td>
                                    <td class="text-center"><strong>Report Delivery Date/Time</strong></td>
                                    <td class="text-right"><strong>Charges</strong></td>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                <?php

                                $total = 0;
                                $extra_total = 0;
                                $flag = 0;
                                $first_time = 0;

                                ?>
                                <?php foreach ($sales->saleitems as $items){

                                    $total = $total + $items->item_price;

                                    ?>
                                    <tr>
                                        <?php if($items->test_status == 3){
                                            // $total = $total + $items->refund_surcharge;

                                            ?>
                                            <td><del><?=$items->item_name?></del>
                                                <?php if($items->refund_surcharge > 0){ ?>
                                                    <br>
                                                    Refund Charges : Rs <?= $items->refund_surcharge ?>
                                                <?php } ?>
                                                <?php if($items->extra){

                                                    $flag = 1;

                                                    foreach($items->extra as $extra ){?>
                                                        <li><?= $extra['item_name']?></li>
                                                    <?php } } ?>
                                            </td>

                                            <td class="text-center"><del><?= app\helpers\datetime::printBillReportDelivery($items->created_on)?></del></td>
                                            <td class="text-right">Rs <?=$items->item_price?>

                                                <?php if($items->extra){
                                                    $rate =0;
                                                    foreach($items->extra as $extra ){
                                                        $extra_total =  $extra_total + ($extra['item_rate'] * $extra['item_quantity']);
                                                        $rate = $rate + $extra_total;
                                                        ?>
                                                        <br>
                                                        <span class="m-list-timeline__time">Rs <?=  $extra['item_rate'] * $extra['item_quantity'] ?></span>
                                                    <?php } ?>

                                                    <hr>
                                                    Rs <?=$items->item_price + $rate ?>

                                                <?php  } ?>
                                            </td>
                                        <?php }else {



                                            ?>
                                            <td><?=$items->item_name?>
                                                <?php if($items->extra){

                                                    $flag = 1;

                                                    foreach($items->extra as $extra ){?>
                                                        <li><?= $extra['item_name']?></li>
                                                    <?php } } ?>
                                            </td>
                                            <td class="text-center"><?= app\helpers\datetime::printBillReportDelivery($items->created_on)?></td>
                                            <td class="text-right">Rs <?=$items->item_price?>
                                                <?php if($items->extra){
                                                    $rate =0;
                                                    foreach($items->extra as $extra ){
                                                        $extra_total =  $extra_total + ($extra['item_rate'] * $extra['item_quantity']);
                                                        $rate = $rate + $extra_total;
                                                        ?>
                                                        <br>
                                                        <span class="m-list-timeline__time">Rs <?=  $extra['item_rate'] * $extra['item_quantity'] ?></span>
                                                    <?php } ?>

                                                    <hr>
                                                    Rs <?=$items->item_price + $rate ?>

                                                <?php  } ?>
                                            </td>

                                        <?php } ?>
                                    </tr>
                                <?php }?>

                                <?php if($sales->tax==0 && $sales->discount==0 ){?>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line text-right"><strong>Total</strong></td>
                                        <td class="no-line text-right">Rs <?= number_format($grandtotal = $total + $extra_total )?></td>
                                    </tr>

                                    <?php if($sales->sale_status == 2 || $sales->sale_status == 3) { ?>


                                        <tr>
                                            <td class="no-line"></td>
                                            <td class="no-line text-right"><strong>Refund Amount</strong></td>
                                            <td class="no-line text-right">Rs <?= number_format($sales->refund_amount )?></td>
                                        </tr>

                                    <?php } ?>


                                <?php }else { ?>
                                    <tr>
                                        <td class="thick-line"></td>
                                        <td class="thick-line text-right"><strong>Subtotal</strong></td>
                                        <td class="thick-line text-right">Rs <?= number_format($extra_total + $total)?></td>
                                    </tr>

                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line text-right"><strong>Discount</strong></td>
                                        <td class="no-line text-right">Rs <?= number_format($sales->discount)?></td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line text-right"><strong>Total</strong></td>
                                        <td class="no-line text-right">Rs <?php $grandtotal = ($extra_total+$total)-$sales->discount;echo number_format($grandtotal);?></td>
                                    </tr>

                                    <?php if($sales->sale_status == 2 || $sales->sale_status == 3) { ?>


                                        <tr>
                                            <td class="no-line"></td>
                                            <td class="no-line text-right"><strong>Refund Amount</strong></td>
                                            <td class="no-line text-right">Rs <?= number_format($sales->refund_amount )?></td>
                                        </tr>

                                    <?php } ?>

                                <?php }?>



                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line text-right"><strong>Paid</strong></td>
                                    <td class="no-line text-right">Rs <?= number_format($sales->paid_amount)?></td>
                                </tr>

                                <?php if($sales->sale_status == 2 || $sales->sale_status == 3) { ?>


                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line text-right"><strong>Balance</strong></td>
                                        <td class="no-line text-right">Rs <?= number_format($sales->grand_total - ( $sales->paid_amount + $sales->refund_amount))?></td>

                                    </tr>

                                <?php }else { ?>

                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line text-right"><strong>Balance</strong></td>
                                        <td class="no-line text-right">Rs <?= number_format($sales->grand_total - $sales->paid_amount)?></td>

                                    </tr>

                                <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <p class="text-center">Please bring this receipt for Report Collection / further Investigations</p>
                <img src="<?= Yii::$app->homeUrl?>images/frame.png" style="position: absolute;top: -220px;right: 10px;" alt="Facebook QR Code" height="62" width="62">
            </div>
        </div>
    </div>

</page>
</body>

</html>