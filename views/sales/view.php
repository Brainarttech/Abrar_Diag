<?php
/* echo "<pre>";
  print_r($model);echo "</pre>"; */

$sales = $model;
?>

<br>



<!--<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">

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
                             foreach ($order->lineItems as $line) or some such thing here 
<?php
$total = 0;
$extra_total = 0;
$flag = 0;
$first_time = 0;
?>
<?php
foreach ($sales->saleitems as $items) {

    $total = $total + $items->item_price;
    ?>
                                                                                                            <tr>
    <?php
    if ($items->test_status == 3) {
        // $total = $total + $items->refund_surcharge;
        ?>
                                                                                                                                                                                                <td><del><?= $items->item_name ?></del>
        <?php if ($items->refund_surcharge > 0) { ?>
                                                                                                                                                                                                                                                                                    <br>
                                                                                                                                                                                                                                                                                    Refund Charges : Rs <?= $items->refund_surcharge ?>
        <?php } ?>
        <?php
        if ($items->extra) {

            $flag = 1;

            foreach ($items->extra as $extra) {
                ?>
                                                                                                                                                                                                                                                                                                                                                        <li><?= $extra['item_name'] ?></li>
                <?php
            }
        }
        ?>
                                                                                                                                                                                        </td>

                                                                                                                                                                                        <td class="text-center"><del><?= app\helpers\datetime::printBillReportDelivery($items->created_on) ?></del></td>
                                                                                                                                                                                        <td class="text-right">Rs <?= $items->item_price ?>

        <?php
        if ($items->extra) {
            $rate = 0;
            foreach ($items->extra as $extra) {
                $extra_total = $extra_total + ($extra['item_rate'] * $extra['item_quantity']);
                $rate = $rate + $extra_total;
                ?>
                                                                                                                                                                                                                                                                                                                                                            <br>
                                                                                                                                                                                                                                                                                                                                                            <span class="m-list-timeline__time">Rs <?= $extra['item_rate'] * $extra['item_quantity'] ?></span>
            <?php } ?>

                                                                                                                                                                                                                                                                            <hr>
                                                                                                                                                                                                                                                                            Rs <?= $items->item_price + $rate ?>

        <?php } ?>
                                                                                                                                                                                        </td>
    <?php } else {
        ?>
                                                                                                                                                                                        <td><?= $items->item_name ?>
        <?php
        if ($items->extra) {

            $flag = 1;

            foreach ($items->extra as $extra) {
                ?>
                                                                                                                                                                                                                                                                                                                                                        <li><?= $extra['item_name'] ?></li>
                <?php
            }
        }
        ?>
                                                                                                                                                                                        </td>
                                                                                                                                                                                        <td class="text-center"><?= app\helpers\datetime::printBillReportDelivery($items->created_on) ?></td>
                                                                                                                                                                                        <td class="text-right">Rs <?= $items->item_price ?>
        <?php
        if ($items->extra) {
            $rate = 0;
            foreach ($items->extra as $extra) {
                $extra_total = $extra_total + ($extra['item_rate'] * $extra['item_quantity']);
                $rate = $rate + $extra_total;
                ?>
                                                                                                                                                                                                                                                                                                                                                            <br>
                                                                                                                                                                                                                                                                                                                                                            <span class="m-list-timeline__time">Rs <?= $extra['item_rate'] * $extra['item_quantity'] ?></span>
            <?php } ?>

                                                                                                                                                                                                                                                                            <hr>
                                                                                                                                                                                                                                                                            Rs <?= $items->item_price + $rate ?>

        <?php } ?>
                                                                                                                                                                                        </td>

    <?php } ?>
                                                                                                        </tr>
<?php } ?>

<?php if ($sales->tax == 0 && $sales->discount == 0) { ?>
                                                                                                        <tr>
                                                                                                            <td class="no-line"></td>
                                                                                                            <td class="no-line text-right"><strong>Total</strong></td>
                                                                                                            <td class="no-line text-right">Rs <?= number_format($grandtotal = $total + $extra_total) ?></td>
                                                                                                        </tr>

    <?php if ($sales->sale_status == 2 || $sales->sale_status == 3) { ?>


                                                                                                                                                                                        <tr>
                                                                                                                                                                                            <td class="no-line"></td>
                                                                                                                                                                                            <td class="no-line text-right"><strong>Refund Amount</strong></td>
                                                                                                                                                                                            <td class="no-line text-right">Rs <?= number_format($sales->refund_amount) ?></td>
                                                                                                                                                                                        </tr>

    <?php } ?>


<?php } else { ?>
                                                                                                        <tr>
                                                                                                            <td class="thick-line"></td>
                                                                                                            <td class="thick-line text-right"><strong>Subtotal</strong></td>
                                                                                                            <td class="thick-line text-right">Rs <?= number_format($extra_total + $total) ?></td>
                                                                                                        </tr>

                                                                                                        <tr>
                                                                                                            <td class="no-line"></td>
                                                                                                            <td class="no-line text-right"><strong>Discount</strong></td>
                                                                                                            <td class="no-line text-right">Rs <?= number_format($sales->discount) ?></td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td class="no-line"></td>
                                                                                                            <td class="no-line text-right"><strong>Total</strong></td>
                                                                                                            <td class="no-line text-right">Rs <?php
    $grandtotal = ($extra_total + $total) - $sales->discount;
    echo number_format($grandtotal);
    ?></td>
                                                                                                        </tr>

    <?php if ($sales->sale_status == 2 || $sales->sale_status == 3) { ?>


                                                                                                                                                                                        <tr>
                                                                                                                                                                                            <td class="no-line"></td>
                                                                                                                                                                                            <td class="no-line text-right"><strong>Refund Amount</strong></td>
                                                                                                                                                                                            <td class="no-line text-right">Rs <?= number_format($sales->refund_amount) ?></td>
                                                                                                                                                                                        </tr>

    <?php } ?>

<?php } ?>



                        <tr>
                            <td class="no-line"></td>
                            <td class="no-line text-right"><strong>Paid</strong></td>
                            <td class="no-line text-right">Rs <?= number_format($sales->paid_amount) ?></td>
                        </tr>

<?php if ($sales->sale_status == 2 || $sales->sale_status == 3) { ?>


                                                                                                        <tr>
                                                                                                            <td class="no-line"></td>
                                                                                                            <td class="no-line text-right"><strong>Balance</strong></td>
                                                                                                            <td class="no-line text-right">Rs <?= number_format($sales->grand_total - ( $sales->paid_amount + $sales->refund_amount)) ?></td>

                                                                                                        </tr>

<?php } else { ?>

                                                                                                        <tr>
                                                                                                            <td class="no-line"></td>
                                                                                                            <td class="no-line text-right"><strong>Balance</strong></td>
                                                                                                            <td class="no-line text-right">Rs <?= number_format($sales->grand_total - $sales->paid_amount) ?></td>

                                                                                                        </tr>

<?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
    <div class="col-md-2"></div>

</div>-->

<div class="payments-view">

    <table class="table table-bordered m-table">
        <thead>
            <tr>
                <th>
                    Test Detail
                </th>
                <th>
                    Report Delivery Date/Time
                </th>
                <th>
                    Charges
                </th>

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
            <?php
            foreach ($sales->saleitems as $items) {

                $total = $total + $items->item_price;
                ?>
                <tr>
                    <?php
                    if ($items->test_status == 3) {
                        // $total = $total + $items->refund_surcharge;
                        ?>
                        <td><del><?= $items->item_name ?></del>
                            <?php if ($items->refund_surcharge > 0) { ?>
                                <br>
                                Refund Charges : Rs <?= $items->refund_surcharge ?>
                            <?php } ?>
                            <?php
                            if ($items->extra) {

                                $flag = 1;

                                foreach ($items->extra as $extra) {
                                    ?>
                        <li><?= $extra['item_name'] ?></li>
            <?php }
        } ?>
                </td>

                <td class="text-center"><del><?= app\helpers\datetime::printBillReportDelivery($items->created_on) ?></del></td>
                <td class="text-right">Rs <?= $items->item_price ?>

                    <?php
                    if ($items->extra) {
                        $rate = 0;
                        foreach ($items->extra as $extra) {
                            $extra_total = $extra_total + ($extra['item_rate'] * $extra['item_quantity']);
                            $rate = $rate + $extra_total;
                            ?>
                            <br>
                            <span class="m-list-timeline__time">Rs <?= $extra['item_rate'] * $extra['item_quantity'] ?></span>
                    <?php } ?>

                        <hr>
                        Rs <?= $items->item_price + $rate ?>

                <?php } ?>
                </td>
                <?php } else {
                    ?>
                <td><?= $items->item_name ?>
                    <?php
                    if ($items->extra) {

                        $flag = 1;

                        foreach ($items->extra as $extra) {
                            ?>
                        <li><?= $extra['item_name'] ?></li>
                        <?php }
                    } ?>
                </td>
                <td class="text-center"><?= app\helpers\datetime::printBillReportDelivery($items->created_on) ?></td>
                <td class="text-right">Rs <?= $items->item_price ?>
        <?php
        if ($items->extra) {
            $rate = 0;
            foreach ($items->extra as $extra) {
                $extra_total = $extra_total + ($extra['item_rate'] * $extra['item_quantity']);
                $rate = $rate + $extra_total;
                ?>
                            <br>
                            <span class="m-list-timeline__time">Rs <?= $extra['item_rate'] * $extra['item_quantity'] ?></span>
                    <?php } ?>

                        <hr>
                        Rs <?= $items->item_price + $rate ?>

                <?php } ?>
                </td>

    <?php } ?>
            </tr>
<?php } ?>

        <?php if ($sales->tax == 0 && $sales->discount == 0) { ?>
            <tr>
                <td class="no-line"></td>
                <td class="no-line text-right"><strong>Total</strong></td>
                <td class="no-line text-right">Rs <?= number_format($grandtotal = $total + $extra_total) ?></td>
            </tr>

    <?php if ($sales->sale_status == 2 || $sales->sale_status == 3) { ?>


                <tr>
                    <td class="no-line"></td>
                    <td class="no-line text-right"><strong>Refund Amount</strong></td>
                    <td class="no-line text-right">Rs <?= number_format($sales->refund_amount) ?></td>
                </tr>

    <?php } ?>


<?php } else { ?>
            <tr>
                <td class="thick-line"></td>
                <td class="thick-line text-right"><strong>Subtotal</strong></td>
                <td class="thick-line text-right">Rs <?= number_format($extra_total + $total) ?></td>
            </tr>

            <tr>
                <td class="no-line"></td>
                <td class="no-line text-right"><strong>Discount</strong></td>
                <td class="no-line text-right">Rs <?= number_format($sales->discount) ?></td>
            </tr>
            <tr>
                <td class="no-line"></td>
                <td class="no-line text-right"><strong>Total</strong></td>
                <td class="no-line text-right">Rs <?php $grandtotal = ($extra_total + $total) - $sales->discount;
    echo number_format($grandtotal); ?></td>
            </tr>

            <?php if ($sales->sale_status == 2 || $sales->sale_status == 3) { ?>


                <tr>
                    <td class="no-line"></td>
                    <td class="no-line text-right"><strong>Refund Amount</strong></td>
                    <td class="no-line text-right">Rs <?= number_format($sales->refund_amount) ?></td>
                </tr>

    <?php } ?>

<?php } ?>



        <tr>
            <td class="no-line"></td>
            <td class="no-line text-right"><strong>Paid</strong></td>
            <td class="no-line text-right">Rs <?= number_format($sales->paid_amount) ?></td>
        </tr>

<?php if ($sales->sale_status == 2 || $sales->sale_status == 3) { ?>


            <tr>
                <td class="no-line"></td>
                <td class="no-line text-right"><strong>Balance</strong></td>
                <td class="no-line text-right">Rs <?= number_format($sales->grand_total - ( $sales->paid_amount + $sales->refund_amount)) ?></td>

            </tr>

        <?php } else { ?>

            <tr>
                <td class="no-line"></td>
                <td class="no-line text-right"><strong>Balance</strong></td>
                <td class="no-line text-right">Rs <?= number_format($sales->grand_total - $sales->paid_amount) ?></td>

            </tr>

<?php } ?>

        </tbody>
    </table>

</div>
