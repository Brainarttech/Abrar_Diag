

<?php

$id = $_GET['id'];

$sales = \app\models\Sales::find()->select('paid_amount')->where(['id'=>$id])->one();
if($sales->paid_amount > 0){

    $sales = \app\models\Sales::find()
        ->innerJoinWith('saleitems')
        ->innerJoinWith('payments')
        ->innerJoinWith('patient')
        ->innerJoinWith('referred')
        ->innerJoinWith('payments.mop')
        ->innerJoinWith('saleitems.extra')
        ->andWhere(['sale.id'=>$id])->one();




}else {
    $sales = \app\models\Sales::find()
        ->innerJoinWith('saleitems')
        ->innerJoinWith('patient')
        ->innerJoinWith('referred')
        ->andWhere(['sale.id'=>$id])->one();
}

/*echo "<pre>";
print_r($sales);
echo "</pre>";
*/



?>


<style>
    .m-invoice-2 .m-invoice__wrapper .m-invoice__head .m-invoice__container.m-invoice__container--centered{
        width:80% !important;
    }
    .m-invoice-2 .m-invoice__wrapper .m-invoice__head .m-invoice__container .m-invoice__logo{
        padding-top: 4rem;
    }
    .m-invoice-2 .m-invoice__wrapper .m-invoice__footer{
        background-color: white;
    }
    .m-invoice-2 .m-invoice__wrapper .m-invoice__footer{
        margin-top: 0rem;
        padding: 0;
    }
    .m-invoice-2 .m-invoice__wrapper .m-invoice__footer .m-invoice__table.m-invoice__table--centered{
        width: 98%;
    }

    .m-invoice-2 .m-invoice__wrapper .m-invoice__body table tbody tr td{
        vertical-align:top;
    }


</style>

<div class="m-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="m-portlet">
                <div class="m-portlet__body m-portlet__body--no-padding">
                    <div class="m-invoice-2">
                        <div class="m-invoice__wrapper">
                            <div class="m-invoice__head" style="background-image: url(../../assets/app/media/img//logos/bg-6.jpg);">
                                <div class="m-invoice__container m-invoice__container--centered">
                                    <div class="m-invoice__logo">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <h1>Abrar Diagnostic Centre</h1>
                                                <strong>312-E Charging Cross,<br>Peshawar Road, Rawalpindi Cantt</strong></p>
                                            </div>
                                            <div class="col-sm-5">
                                                <p >Tel: 5470205, 5462750, 5473543<br>Fax: 051-8317450, Cell: 0331-5261589<br>
                                                    Email: mri_ct@hotmail.com<br>Web: www.abrardiagnostics.com.pk</p>
                                            </div>

                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <p>
                                                <strong>Receipt No:</strong>
                                                <?=$sales->invoice_no?><br>
                                                <strong>Client Name:</strong>
                                                <?= ucfirst($sales->patient->name);?><br>
                                                <strong>Date/Time:</strong>
                                                <?= app\helpers\datetime::printBill($sales->created_on)?><br>
                                                <strong>Panel:</strong>
                                                Nill<br>
                                            </p>
                                        </div>
                                        <div class="col-sm-5">
                                            <p class="">
                                                <strong>Client No:</strong>
                                                <?=$sales->patient->reg_no?><br>
                                                <strong>Age/Sex:</strong>
                                                <?= $sales->patient->age?>Y / <?= $sales->patient->gender?><br>
                                                <strong>Referred By:</strong>
                                                <?=$sales->referred->name?><br>
                                                <strong>Entered By:</strong>
                                                <?= Yii::$app->user->identity->username?>  <br>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-invoice__body m-invoice__body--centered">
                                <div class="m-portlet__body">
                                    <!--begin::Section-->

                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-condensed font">
                                                <thead style="
                                    border-top: 2px solid black;
                                    border-bottom:  2px solid black;
                                    ">
                                                <tr>
                                                    <td><strong>Test Detail</strong></td>
                                                    <td class="text-center"><strong>Status</strong></td>
                                                    <td class="text-right"><strong>Charges</strong></td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                                <?php

                                                $total = 0;
                                                $extra_total = 0 ;

                                                ?>
                                                <?php foreach ($sales->saleitems as $items){

                                                    $total = $total + $items->item_price;

                                                    ?>
                                                    <tr>
                                                        <td><?=$items->item_name?>
                                                            <?php if($items->extra){

                                                                foreach($items->extra as $extra ){?>



                                                            <div class="m-list-timeline">
                                                                <div class="m-list-timeline__items">
                                                                    <div class="m-list-timeline__item">
                                                                        <span class="m-list-timeline__badge"></span>
                                                                        <span class="m-list-timeline__text"><?= $extra['item_name']?></span>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <?php } } ?>
                                                        </td>

                                                            <?php if($items->test_status==1){

                                                                echo '<td class="text-center m--font-danger">Pending</td>';

                                                            }else if($items->test_status==2){
                                                                echo '<td class="text-center m--font-success">Complete</td>';


                                                            }?>



                                                        <td class="text-right">Rs <?=$items->item_price?>
                                                            <?php if($items->extra){
                                                                $rate =0;
                                                                foreach($items->extra as $extra ){
                                                                    $extra_total =  $extra_total + ($extra['item_rate'] * $extra['item_quantity']);
                                                                    $rate = $rate + $extra_total;
                                                                    ?>
                                                                    <span class="m-list-timeline__time"><?=  $extra['item_rate'] * $extra['item_quantity'] ?></span>
                                                                <?php } ?>

                                                            <hr>
                                                               Rs <?=$items->item_price + $rate ?>

                                                          <?php  } ?>
                                                        </td>
                                                    </tr>
                                                <?php }?>

                                                <?php if($sales->tax==0 && $sales->discount==0 ){?>

                                                    <tr>
                                                        <td class="no-line"></td>
                                                        <td class="no-line text-left"><strong>Total</strong></td>
                                                        <td class="no-line text-right">Rs <?= number_format($grandtotal = $total + $extra_total )?></td>
                                                    </tr>



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

                                                <?php }?>

                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line text-right"><strong>Paid</strong></td>
                                                    <td class="no-line text-right">Rs <?= number_format($sales->paid_amount)?></td>
                                                </tr>

                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line text-right"><strong>Balance</strong></td>
                                                    <td class="no-line text-right">Rs <?= number_format($sales->grand_total - $sales->paid_amount)?></td>

                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="m-form__actions m-form__actions--solid">
                                        <div class="row">
                                            <div class="col-lg-4"></div>
                                            <div class="col-lg-4 text-center">

                                                    <a class="add-payment btn btn-success" href="<?php echo Yii::$app->homeUrl?>payments/create?id=<?= $_GET['id'];?>">Pay Now</a>
                                                    <a class="add-later btn btn-danger" href="<?php echo Yii::$app->homeUrl?>payments/later?id=<?= $_GET['id'];?>">Pay Later</a>

                                            </div>
                                            <div class="col-lg-4"></div>
                                        </div>
                                    </div>


                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script>

    var discount = <?=$sales->discount?>;
    var item_total = <?= $total?>;




    $(document).on('click', '.remove', function(event){


        var btnid = $(this).attr('id');
        btnid = btnid.replace("btn", "");
        $('#addr'+btnid).remove();
        calc_total();
    });

    $('#tab_logic tbody').on('keyup',function(){
        //calc();
    });
    $('#tax').on('keyup change',function(){
        calc_total();
    });


    function calc()
    {
        $('#tab_logic tbody tr').each(function(i, element) {

            var html = $(this).html();
            if(html!='')
            {
                var surcharge = $(this).find('.surcharge').val();
                console.log(surcharge);
                var price = $(this).find('.item_price').html();
                $(this).find('.total').html(price-surcharge);
                calc_total();
            }
        });
    }

    function calc_total()
    {
        var total=0;
        var sur = 0;
        $('.total').each(function() {
            console.log($(this).val());
            total += parseInt($(this).text());
        });

        $('.surcharge').each(function() {
            console.log($(this).val());
            sur += parseInt($(this).val());
        });


        console.log("Total Surcharge"+sur);

        $('.refund_surcharge').html((sur).toFixed(2));

        //$('#sub_total').val(total.toFixed(2));
        //tax_sum=total/100*$('#tax').val();
        //$('#tax_amount').val(tax_sum.toFixed(2));
        var total_items_amount = item_total;
        var refund_surcharge = $('#refund_surcharge').html();


        var grand_total = total_items_amount - refund_surcharge - discount ;
        $('.total_amount').html((grand_total).toFixed(2));

    }


    $(document).on('keyup', '[data-min_max]', function(e){
        var min = parseInt($(this).data('min'));
        var max = parseInt($(this).data('max'));
        var val = parseInt($(this).val());
        if(val > max)
        {
            $(this).val(max);
            calc();
            return false;
        }
        else if(val < min)
        {
            $(this).val(min);
            calc();
            return false;
        }
        calc();

    });

    $(document).on('keydown', '[data-toggle=just_number]', function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: Ctrl+C
            (e.keyCode == 67 && e.ctrlKey === true) ||
            // Allow: Ctrl+X
            (e.keyCode == 88 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });


</script>