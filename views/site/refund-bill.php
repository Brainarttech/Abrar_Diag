<?php
$id = $_GET['id'];

$sales = \app\models\Sales::find()->select('paid_amount')->where(['id' => $id])->one();
if ($sales->paid_amount > 0) {

    $sales = \app\models\Sales::find()
                    ->innerJoinWith('saleitems')
                    ->innerJoinWith('payments')
                    ->innerJoinWith('patient')
                    ->innerJoinWith('referred')
                    ->innerJoinWith('payments.mop')
                    ->andWhere(['sale.id' => $id])->one();
} else {
    $sales = \app\models\Sales::find()
                    ->innerJoinWith('saleitems')
                    ->innerJoinWith('patient')
                    ->innerJoinWith('referred')
                    ->andWhere(['sale.id' => $id])->one();
}

/* echo "<pre>";
  print_r($sales);
  echo "</pre>"; */
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
                                                <h1>Refund Panel</h1>

                                            </div>

                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <p>
                                                <strong>Receipt No:</strong>
<?= $sales->invoice_no ?><br>
                                                <strong>Client Name:</strong>
<?= ucfirst($sales->patient->name); ?><br>
                                                <strong>Date/Time:</strong>
<?= app\helpers\datetime::printBill($sales->created_on) ?><br>
                                                <strong>Panel:</strong>
                                                Nill<br>
                                            </p>
                                        </div>
                                        <div class="col-sm-5">
                                            <p class="">
                                                <strong>Client No:</strong>
<?= $sales->patient->reg_no ?><br>
                                                <strong>Age/Sex:</strong>
<?= $sales->patient->age ?>Y / <?= $sales->patient->gender ?><br>
                                                <strong>Referred By:</strong>
<?= $sales->referred->name ?><br>
                                                <strong>Entered By:</strong>
                                                <?= Yii::$app->user->identity->username ?>  <br>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-1"></div>

                                <div class="col-md-10">
                                    <form class="m-form m-form--fit m-form--label-align-right" action="<?= Yii::$app->homeUrl ?>ajax/refund-bill" id="m_form" novalidate="novalidate">

                                        <div class="">
                                            <div class="table-responsive">
                                                <table class="table table-bordered m-table m-table--border-primary m-table--head-bg-primary" id="tab_logic">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                TEST DETAIL
                                                            </th>
                                                            <th style="text-align: center;">
                                                                CHARGES
                                                            </th>
                                                            <th style="text-align: center;">
                                                                DISCOUNT
                                                            </th>
                                                            <th style="text-align: center;">
                                                                Paid
                                                            </th>
                                                            <th style="text-align: center;width: 20%;">
                                                                REFUND SURCHAGES
                                                            </th>
                                                            <th style="text-align: center;">
                                                                REFUND AMOUNT
                                                            </th>
                                                            <th style="text-align: center;">
                                                                ACTION
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="dynamictable">
<?php
$i = 0;
$total = 0;
$discount = 0;
foreach ($sales->saleitems as $items) {

    $total += $items->item_price;
    $discount = $discount + $items->item_discount;
    $i++;
    ?>
                                                            <tr id="addr<?= $i ?>">
                                                        <input type="hidden" value="<?= $items->id ?>" name="id[<?= $items->id ?>]">
                                                        <td><?= $items->item_name ?>
                                                        </td>
                                                        <td class="text-center"><span class="item_price"><?= $items->item_price ?></span></td>
                                                        <td class="text-center"><span class="item_discount"><?= $items->item_discount ?></span></td>

                                                        <td class="text-center"><span class="total_test_amount" id="total_test_amount<?= $i ?>"><?= $items->item_price - $items->item_discount ?></span></td>

    <?php if ($items->test_status == 3) { ?>

                                                            <td class="text-center m--font-danger" style="padding-left: 6%;padding-right: 6%"><?= $items->refund_surcharge ?></td>
                                                            <td class="m--font-danger text-center"><?= $items->refund_amount ?></td>

    <?php } else { ?>

                                                            <td class="text-center" style="padding-left: 6%;padding-right: 6%"><input type="text" id="sur<?= $i ?>"  data-min_max data-min="0" data-max="<?= $items->item_price - $items->item_discount ?>" data-toggle="just_number"  class="form-control surcharge" style="display: none" name="item[<?= $items->id ?>]" value="0"> </td>
                                                            <td class="text-center"><span class="total" id="totalShow<?= $i ?>" style="display: none"><?= $items->item_price - $items->item_discount ?></span></td>

    <?php } ?>

                                                        <td class="text-center">
    <?php if ($items->test_status == 1) { ?>

                                                                <label class="m-checkbox">

                                                                    <input type="checkbox" class="valid" id="valid_<?= $i ?>" name="valid[<?= $items->id ?>]">
                                                                    <span></span>
                                                                </label>

    <?php
    } else if ($items->test_status == 2) {
        echo "Complete";
    } else {
        echo "<span class='m--font-danger'>Already Refund On<br>" . app\helpers\datetime::saleDateTime($items->refund_on) . "</span>";
    }
    ?>

                                                        </td>
                                                        </tr>

                                                        <?php } ?>

                                                    <tr>
                                                        <td class="no-line"><strong>Grand Total</strong></td>
                                                        <td class="text-center"><strong><span class="total_test_amount"><strong><?= number_format($total) ?></span></strong></td>
                                                        <td class="text-center"><strong><span class="total_test_discount"><strong><?= number_format($discount) ?></span></strong></td>
                                                        <td class="no-line text-center"><strong><span class="total_test_amount_overAll"><?= number_format($sales->grand_total) ?></span></strong></td>
                                                        <td class="no-line text-center"><span class="refund_surcharge">0</span> </td>
                                                        <td class="no-line text-center"><span class="total_refund_amount">0</span></td>
                                                        <td></td>
                                                    </tr>

                                                    <!-- <?php /* if(!$sales->tax==0 && !$sales->discount==0 ){ */ ?>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Discount</strong></td>
                                    <td class="no-line text-center"><?/*=$sales->discount*/?></td>
                                </tr>
<?php /* } */ ?>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-center"><strong>Refund Surcharges</strong></td>
                                <td class="no-line text-center"><span class="refund_surcharge">0</span> </td>
                            </tr>-->

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="m-invoice__footer">
                                                <div class="m-invoice__table  m-invoice__table--centered table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>
                                                                    TOTAL REFUND AMOUNT
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>

                                                                <td class="m--font-danger">
                                                                    <span class="total_amount">0</span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="row">
                                        <div class="col-lg-4"></div>
                                        <div class="col-lg-4 text-center">
                                            <button id="submit" class="btn btn-primary">
                                                Submit
                                            </button>
                                            <a href ="<?= Yii::$app->homeUrl ?>sales/index" class="btn btn-secondary">
                                                Cancel
                                            </a>
                                        </div>
                                        <div class="col-lg-4"></div>
                                    </div>

                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <br>




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script>

    var discount = <?= $sales->discount ?>;
    var item_total = <?= $total ?>;




    $(document).on('click', '.remove', function (event) {


        var btnid = $(this).attr('id');
        btnid = btnid.replace("btn", "");
        $('#addr' + btnid).remove();
        calc_total();
    });

    $('#tab_logic tbody').on('keyup', function () {
        //calc();
    });
    $('#tax').on('keyup change', function () {
        calc_total();
    });


    function calc()
    {
        $('#tab_logic tbody tr').each(function (i, element) {

            var html = $(this).html();
            if (html != '')
            {
                if ($(this).find('.surcharge').is(":visible"))
                {

                    var surcharge = $(this).find('.surcharge').val();
                    console.log(surcharge);
                    var price = $(this).find('.item_price').html() - $(this).find('.item_discount').html();
                    var to = price - surcharge;
                    if (to < 0)
                    {
                        $(this).find('.total').html(price);
                    } else {
                        $(this).find('.total').html(price - surcharge);
                    }
                    calc_total();

                } else
                {
                    calc_total();
                }
            }
        });
    }

    function calc_total()
    {
        var total = 0;
        var sur = 0;
        var paid = <?php echo $sales->paid_amount; ?>;
        $('.total').each(function () {
            if ($(this).is(":visible"))
            {
                console.log($(this).val());
                total += parseInt($(this).text());
            }

        });

        $('.surcharge').each(function () {
            console.log($(this).val());
            if ($(this).is(":visible"))
            {
                sur += parseInt($(this).val());
            }
        });


        console.log("Total Surcharge" + sur);
        if (total != paid) {
            total = total - paid;
        }
        $('.refund_surcharge').html(number_format(sur));
        $('.total_refund_amount').html(number_format(total));


        $('.total_amount').html(number_format(total));



    }


    $(document).on('keyup', '[data-min_max]', function (e) {
        var min = parseInt($(this).data('min'));
        var max = parseInt($(this).data('max'));
        var val = parseInt($(this).val());
        if (val > max)
        {
            $(this).val(max);
            calc();
            return false;
        }
        else if (val < min)
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


                    $("input:checkbox").change(function () {
                        if (this.checked) {



                            var id = $(this).attr("id").split('_').pop();
                            $('#sur' + id).show();
                            $('#totalShow' + id).show();


                        } else {

                            var id = $(this).attr("id").split('_').pop();
                            $('#sur' + id).hide();
                            $('#totalShow' + id).hide();

                        }
                        calc();

                    });


                    function number_format(number, decimals, dec_point, thousands_point) {

                        if (number == null || !isFinite(number)) {
                            throw new TypeError("number is not valid");
                        }

                        if (!decimals) {
                            var len = number.toString().split('.').length;
                            decimals = len > 1 ? len : 0;
                        }

                        if (!dec_point) {
                            dec_point = '.';
                        }

                        if (!thousands_point) {
                            thousands_point = ',';
                        }

                        number = parseFloat(number).toFixed(decimals);

                        number = number.replace(".", dec_point);

                        var splitNum = number.split(dec_point);
                        splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
                        number = splitNum.join(dec_point);

                        return number;
                    }

                    $("#submit").click(function () {

                        var count = 0;
                        $("input:checkbox").each(function () {
                            if ($(this).is(":checked") && !$(this).is(':disabled'))
                            {
                                count++;
                            }


                        });

                        if (count == 0)
                        {
                            bootbox.alert({
                                message: "Please Select At Least One Test",
                                className: 'bb-alternate-modal'
                            });
                        }
                        else
                        {
                            bootbox.confirm({
                                message: "Are you sure you want to refund ?",
                                buttons: {
                                    confirm: {
                                        label: 'Yes Refund It',
                                        className: 'btn-success'
                                    },
                                    cancel: {
                                        label: 'No',
                                        className: 'btn-danger'
                                    }
                                },
                                callback: function (result) {
                                    console.log('This was logged in the callback: ' + result);
                                    if (result == true)
                                    {
                                        console.log('This was logged in the callback: ' + result);

                                        var frm = $('#m_form');

                                        console.log('This was logged in the callback: ' + frm);


                                        $.ajax({
                                            type: frm.attr('method'),
                                            url: frm.attr('action'),
                                            data: frm.serialize(),
                                            success: function (data) {
                                                console.log('Submission was successful.');
                                                bootbox.alert(data, function () {
                                                    location.reload();
                                                });
                                            },
                                            error: function (data) {
                                                console.log('An error occurred.');
                                                console.log(data);
                                            }
                                        });


                                    }
                                }
                            });
                        }




                    });


</script>