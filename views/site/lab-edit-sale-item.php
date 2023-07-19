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
    .m-form .form-control-feedback{
        border :#f4516c 1px solid;
    }

    .select2-container {
        width: 100% !important;
    }
</style>


<div class="m-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="m-portlet">
                <div class="m-portlet__body m-portlet__body--no-padding">
                    <div class="m-invoice-2">
                        <div class="m-invoice__wrapper">
                            <div class="m-invoice__head">
                                <div class="m-invoice__container m-invoice__container--centered">
                                    <div class="m-invoice__logo">
                                        <a href="#">
                                            <h1>
                                                <?= $data->item_name ?>
                                            </h1>
                                        </a>
                                        <span class="m-badge m-badge--danger m-badge--wide">
                                            Pending
                                        </span>
                                    </div>
                                    <div class="m-invoice__items">
                                        <div class="m-invoice__item">
                                            <span class="m-invoice__subtitle">
                                                DATE
                                            </span>
                                            <span class="m-invoice__text">
                                                <?= \app\helpers\datetime::saleItemDateTime($data->created_on) ?>
                                            </span>
                                        </div>
                                        <div class="m-invoice__item">
                                            <span class="m-invoice__subtitle">
                                                RECEIPT NO
                                            </span>
                                            <span class="m-invoice__text">
                                                <?= $data->sale->invoice_no ?>
                                            </span>
                                        </div>
                                        <div class="m-invoice__item">
                                            <span class="m-invoice__subtitle">
                                                PATIENT
                                            </span>
                                            <span class="m-invoice__text">
                                                <?= $data->sale->patient->name ?>
                                                <br>
                                                <?= $data->sale->patient->gender ?> / <?= $data->sale->patient->phone_no ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <form  class="m-form m-form--fit m-form--label-align-right" action="<?php echo Yii::$app->homeUrl ?>ajax/update-department-report" id="m_form" novalidate="novalidate">

                                <input type="hidden" id="patientID" name="patientID" value="<?= $data->sale->patient->id ?>">
                                <input type="hidden" id="ItemID" name="ItemID" value="<?= $data->item->id ?>">
                                <input type="hidden" id="ItemName" name="ItemName" value="<?= $data->item->name ?>">

                                <div class="m-invoice__body m-invoice__table--centered ">
                                    <ul class="nav nav-tabs  m-tabs-line m-tabs-line--2x m-tabs-line--success" role="tablist">

                                        <li class="nav-item m-tabs__item">
                                            <a class="nav-link m-tabs__link active" data-toggle="tab" href="#optional" role="tab">
                                                Attach Products
                                            </a>
                                        </li>


                                        <li class="nav-item m-tabs__item">
                                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#add_extra" role="tab">
                                                Add Extra Charges Products
                                            </a>
                                        </li>

                                        <li class="nav-item m-tabs__item">
                                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#comment" role="tab">
                                                Comment
                                            </a>
                                        </li>
                                        <li class="nav-item m-tabs__item">
                                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#labtest" role="tab">
                                                Lab Test
                                            </a>
                                        </li>
                                    </ul>


                                    <div class="tab-content">
                                        <div class="tab-pane active" id="optional" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="table-responsive">
                                                        <table class="table" id="tab_optional">
                                                            <thead>
                                                                <tr>
                                                                    <th>
                                                                        PRODUCT
                                                                    </th>
                                                                    <th style="text-align: center;width: 20%;">
                                                                        QTY
                                                                    </th>
                                                                    <th>
                                                                        ACTION
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="optionaltable">
                                                                <?php
                                                                $i = 0;
                                                                foreach ($required_option_items as $value) {
                                                                    $i++;
                                                                    ?>

                                                                    <tr id="opt<?= $i ?>">
                                                                        <td style="padding-right: 2%">
                                                                            <input type="hidden" name="opt_product[<?= $i ?>]" value="<?= $value['id'] ?>">
                                                                            <input type="text" name="opt_product_name[<?= $i ?>]" value="<?= $value['product_name'] ?>" class="form-control required" readonly>
                                                                        </td>
                                                                        <td style="padding-left: 2%;padding-right: 2%"> <input type="text" name="opt_qty[<?= $i ?>]" value="<?= $value['default_quantity'] ?>" class="qty form-control digit groupOfTexbox required">
                                                                        </td>
                                                                        <td>
                                                                            <button id="btn<?= $i ?>" type="button" class="btn btn-danger btn-sm del" aria-label="Close">Remove</button>
                                                                        </td>
                                                                    </tr>

                                                                <?php }
                                                                ?>
<!-- <tr id="opt9">
<td style="padding-right: 2%">
    <input type="text" name="opt_product[9]" class="form-control required">
</td>
<td style="padding-left: 2%;padding-right: 2%"> <input type="text" name="opt_qty[9]" value="1" class="qty form-control digit groupOfTexbox required">
</td>
<td>
    <button id="btn9" type="button" class="btn btn-danger btn-sm del" aria-label="Close">Remove</button>
</td>
</tr>-->

                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <div class="row clearfix">
                                                        <div class="col-md-12">
                                                            <a href="javascript:void(0)" id="add_row_optional" class="btn btn-info btn-sm pull-left m-btn m-btn--icon">
                                                                <span>
                                                                    <i class="fa fa-plus"></i>
                                                                    <span>
                                                                        Add
                                                                    </span>
                                                                </span>
                                                            </a>
                                                            <!-- <button id='delete_row' class="pull-right btn btn-danger">Delete Row</button> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                </div>
                                            </div>


                                        </div>


                                        <div class="tab-pane" id="add_extra" role="tabpanel">

                                            <div class="table-responsive">
                                                <table class="table" id="tab_logic">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                PRODUCT
                                                            </th>
                                                            <th style="text-align: left">
                                                                DESCRIPTION
                                                            </th>
                                                            <th style="text-align: center;width: 10%;">
                                                                QTY
                                                            </th>
                                                            <th style="text-align: center;width: 10%;">
                                                                RATE
                                                            </th>
                                                            <th>
                                                                AMOUNT
                                                            </th>
                                                            <th>
                                                                ACTION
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="dynamictable">

                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <a href="javascript:void(0)" id="add_row" class="btn btn-info pull-left m-btn m-btn--icon">
                                                        <span>
                                                            <i class="fa fa-plus"></i>
                                                            <span>
                                                                Add
                                                            </span>
                                                        </span>
                                                    </a>
                                                    <!-- <button id='delete_row' class="pull-right btn btn-danger">Delete Row</button> -->
                                                </div>
                                            </div>

                                            <div class="m-invoice__footer">
                                                <div class="m-invoice__table  m-invoice__table--centered table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>
                                                                    TOTAL AMOUNT
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
                                        <div class="tab-pane" id="comment" role="tabpanel">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <textarea name="comm" id="comm" class="form-control" data-provide="markdown" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="labtest" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="m-portlet__body">
                                                        <div class="form-group m-form__group row">
                                                            <label for="example-text-input" class="offset-1 col-4 col-form-label">
                                                                EXAM REQUIRED:
                                                            </label>
                                                            <div class="col-6">
                                                                <select class="form-control m-input" id="examrequired" name="examrequired" required>
                                                                    <option></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="lab_test_body">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    </form>

                                    <div class="m-form__actions m-form__actions--solid">
                                        <div class="row">
                                            <div class="col-lg-4"></div>
                                            <div class="col-lg-4 text-center">
                                                <button id="submit" class="btn btn-primary" >
                                                    Submit
                                                </button>
                                                <button type="reset" class="btn btn-secondary">
                                                    Cancel
                                                </button>
                                            </div>
                                            <div class="col-lg-4"></div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>

                                </div>

                        </div>
                    </div>
                </div>
            </div>

            <script>
<?php
// echo '<pre>';
// echo print_r($query);
// echo '</pre>';
// die();
$option_array = array();
$paid_array = array();
$lab_test_array = array();
foreach ($option_items as $temp) {
    $option['id'] = $temp['id'];
    $option['text'] = $temp['product_name'];
    $option['qty'] = $temp['default_quantity'];
    $option_array[] = $option;
    unset($option);
}

foreach ($extra_charges as $temp) {
    $option['id'] = $temp['id'];
    $option['text'] = $temp['product'];
    $option['rate'] = $temp['rate'];
    $paid_array[] = $option;
    unset($option);
}
foreach ($data->labForm as $temp) {
    $option['id'] = $_GET['id'] . ',' . $temp['id'];
    $option['sale_item_id'] = $_GET['id'];
    $option['text'] = $temp['form_name'];
    $lab_test_array[] = $option;
    unset($option);
}

?>

                var i = 0;
                var j =<?= $i ?>;

                var option_items = <?php echo json_encode($option_array) ?>;
                var paid_items = <?php echo json_encode($paid_array) ?>;
                var lab_form = <?php echo json_encode($lab_test_array) ?>;
                var lab_form_id = "<?= $_GET['id'].','.$lab_form_id ?>";
                autoSize();
                $("#add_row").click(function () {
                    i++;
                    $('#dynamictable').append('<tr id="addr' + i + '"><td style="padding-right: 2%"><select class="form-control m-select2 required " id="paid_' + i + '"  name="product[' + i + ']"><option value="">Search for products</option></select></td><td> <textarea class="form-control m_autosize_1" name="description[' + i + ']"  rows="1"></textarea></td><td style="padding-left: 2%;padding-right: 2%"> <input type="text" name="qty[' + i + ']" class="qty form-control digit groupOfTexbox required" value="1"> </td> <td > <input type="text" name="rate[' + i + ']" class="price form-control digit groupOfTexbox required"> </td> <td class="m--font-danger"><span class="total">0</span></td> <td> <button id="btn' + i + '" type="button" class="close" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </td></tr>');
                    autoSize();
                    autoSelectPaid('paid_' + i);
                    forecedNunber();

                });

                $("#add_row_optional").click(function () {
                    j++;
                    $('#optionaltable').append('<tr id="opt' + j + '"><td style="padding-right: 2%"> <select class="form-control m-select2 required " id="m_' + j + '"  name="opt_product[' + j + ']"><option value="">Search for products</option></select></td><td style="padding-left: 2%;padding-right: 2%"> <input type="text" name="opt_qty[' + j + ']" value="1" class="qty form-control digit groupOfTexbox required"> </td><td> <button id="btn' + j + '" type="button" class="btn btn-danger btn-sm del" aria-label="Close">Remove</button> </td></tr>');
                    autoSelect('m_' + j);
                    forecedNunber();

                });

                function forecedNunber() {
                    $('.groupOfTexbox').keypress(function (event) {
                        return isNumber(event, this)
                    });

                }


                function autoSize() {
                    var Autosize = {init: function () {
                            var i, t;
                            i = $(".m_autosize_1"), autosize(i), autosize(t), autosize.update(t)
                        }};
                    jQuery(document).ready(function () {
                        Autosize.init()
                    });


                }

                $(document).on('click', '.del', function (event) {

                    $('.tooltip').remove();

                    var btnid = $(this).attr('id');
                    btnid = btnid.replace("btn", "");
                    $('#opt' + btnid).remove();
                });

                $(document).on('click', '.close', function (event) {

                    $('.tooltip').remove();

                    var btnid = $(this).attr('id');
                    btnid = btnid.replace("btn", "");
                    $('#addr' + btnid).remove();
                    calc_total();
                });

                $('#tab_logic tbody').on('keyup change', function () {
                    calc();
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
                            var qty = $(this).find('.qty').val();
                            var price = $(this).find('.price').val();
                            $(this).find('.total').html(qty * price);
                            calc_total();
                        }
                    });
                }

                function calc_total()
                {
                    var total = 0;
                    $('.total').each(function () {
                        console.log($(this).val());
                        total += parseInt($(this).text());
                    });

                    //$('#sub_total').val(total.toFixed(2));
                    //tax_sum=total/100*$('#tax').val();
                    //$('#tax_amount').val(tax_sum.toFixed(2));
                    $('.total_amount').html((total).toFixed(2));
                }


                var BootstrapMarkdown = {init: function () {}};
                jQuery(document).ready(function () {
                    BootstrapMarkdown.init()
                });

                $("#submit").click(function () {


                    var me = $(this);
                    if ($("#m_form").valid())
                    {
                        var form = $("#m_form");

                        if (me.data('requestRunning')) {
                            return;
                        }
                        me.data('requestRunning', true);

                        var url = form.attr('action');
                        console.log(form.serialize());
                        var comment = $('#comm').val();
                        var id = <?= $_GET['id']; ?>;

                        $.ajax({
                            type: "POST",
                            url: url,
                            data: form.serialize() + "&comment=" + comment + "" + "&sale_item_id=" + id + "", // serializes the form's elements.
                            success: function (data)
                            {
                                //console.log(data);
                                bootbox.confirm("Do you want to print the form?", function (result) {
                                    //console.log('This was logged in the callback: ' + result);
                                    if (result) {
                                        window.location = "<?= Yii::$app->homeUrl ?>site/lab-form-print?id=<?= $_GET['id'] ?>";

                                                                } else {
                                                                    window.location = "<?= Yii::$app->homeUrl ?>site/view-sale-item?id=<?= $_GET['id'] ?>";

                                                                                            }
                                                                                        });

                                                                                    }, complete: function () {
                                                                                        me.data('requestRunning', false);
                                                                                    }
                                                                                });
                                                                            }
                                                                            $('.digit').each(function () {
                                                                                $(this).rules("add", {
                                                                                    required: true,
                                                                                    digits: true
                                                                                });
                                                                            });


                                                                        });
                                                                        var FormControls = {
                                                                            init: function () {
                                                                                $("#m_form").validate({
                                                                                    rules: {

                                                                                    }

                                                                                    , invalidHandler: function (e, r) {
                                                                                        var i = $("#m_form_1_msg");
                                                                                        i.removeClass("m--hide").show(), mApp.scrollTo(i, -50)
                                                                                    }
                                                                                    , submitHandler: function (e) {}
                                                                                }

                                                                                )
                                                                            }
                                                                        };
                                                                        jQuery(document).ready(function () {
                                                                            FormControls.init();
                                                                            jQuery.extend(jQuery.validator.messages, {
                                                                                required: "Required",
                                                                            });
                                                                        }

                                                                        );



                                                                        // THE SCRIPT THAT CHECKS IF THE KEY PRESSED IS A NUMERIC OR DECIMAL VALUE.
                                                                        function isNumber(evt, element) {

                                                                            var charCode = (evt.which) ? evt.which : event.keyCode

                                                                            if (
                                                                                    (charCode != 45 || $(element).val().indexOf('-') != -1) && // “-” CHECK MINUS, AND ONLY ONE.
                                                                                    (charCode != 46 || $(element).val().indexOf('.') != -1) && // “.” CHECK DOT, AND ONLY ONE.
                                                                                    (charCode < 48 || charCode > 57))
                                                                                return false;

                                                                            return true;
                                                                        }

                                                                        function autoSelect(id) {
                                                                            var Select2 = {
                                                                                init: function () {
                                                                                    $("#" + id + "").select2({
                                                                                        /* placeholder: "Search for products", allowClear: !0, ajax: {
                                                                                         url: "<?= Yii::$app->homeUrl ?>ajax/get-optional-items",
                                                                                         dataType: "json",
                                                                                         delay: 250,
                                                                                         data: function (e) {
                                                                                         return {
                                                                                         q: e.term, page: e.page
                                                                                         }
                                                                                         }
                                                                                         ,
                                                                                         processResults: function (data) {
                                                                                         console.log(data);
                                                                                         return {
                                                                                         
                                                                                         results: data
                                                                                         };
                                                                                         }
                                                                                         ,
                                                                                         cache: !0
                                                                                         }
                                                                                         , escapeMarkup: function (e) {
                                                                                         return e
                                                                                         }
                                                                                         , minimumInputLength: 1, templateResult: function (e) {
                                                                                         if (e.loading)return e.text;
                                                                                         return e.name;
                                                                                         }
                                                                                         , templateSelection: function (e) {
                                                                                         return e.name
                                                                                         }*/
                                                                                        placeholder: "Select a value", data: option_items
                                                                                    }
                                                                                    )

                                                                                    $("#" + id + "").change(function () {

                                                                                        var idi = id.replace(/^\D+/g, '');

                                                                                        var select_id = $(this).val();
                                                                                        var find = option_items.findIndex(x => x.id == select_id);
                                                                                        console.log(find);
                                                                                        var qty = option_items[find]['qty'];
                                                                                        console.log('input[name="opt_qty[' + id + ']"]');
                                                                                        $('input[name="opt_qty[' + idi + ']"]').val(qty);



                                                                                    })

                                                                                }
                                                                            };
                                                                            jQuery(document).ready(function () {
                                                                                Select2.init()
                                                                            }
                                                                            );

                                                                        }


                                                                        function autoSelectPaid(id) {
                                                                            var Select2 = {
                                                                                init: function () {
                                                                                    $("#" + id + "").select2({

                                                                                        placeholder: "Select a value", data: paid_items
                                                                                    }
                                                                                    )

                                                                                    $("#" + id + "").change(function () {

                                                                                        var idi = id.replace(/^\D+/g, '');

                                                                                        var select_id = $(this).val();
                                                                                        var find = paid_items.findIndex(x => x.id == select_id);
                                                                                        console.log(find);
                                                                                        var rate = paid_items[find]['rate'];
                                                                                        console.log('input[name="rate[' + idi + ']"]');
                                                                                        $('input[name="rate[' + idi + ']"]').val(rate);



                                                                                    })

                                                                                }
                                                                            };
                                                                            jQuery(document).ready(function () {
                                                                                Select2.init()
                                                                            }
                                                                            );

                                                                        }

                                                                        jQuery(document).ready(function () {
                                                                            var Select2 = {
                                                                                init: function () {
                                                                                    $("#examrequired").select2({
                                                                                        placeholder: "Select a Test",
                                                                                        data: lab_form,
                                                                                    }
                                                                                    )
                                                                                    
                                                                                    $("#examrequired").change(function () {
                                                                                        
                                                                                        console.log("Change");
                                                                                        //console.log($(this).val());
                                                                                        //console.log(<?= json_encode(Yii::$app->urlManager->createUrl('lab-form/view?id=')); ?>);
                                                                                        $.get(<?= json_encode(Yii::$app->urlManager->createUrl('lab-form/render-edit?id=')) ?> + $(this).val(), function (data) {
                                                                                            //console.log(data);
                                                                                            $("#lab_test_body").html(data);
                                                                                        });
                                                                                        // //console.log(lab_test_items);
                                                                                        // //console.log($("#examrequired").val());
                                                                                        // var find_index = lab_test_items.findIndex(x => x.id==$("#examrequired").val());
                                                                                        // //console.log(find);
                                                                                        // var search_table_name = lab_test_items[find_index]['tablename'];
                                                                                        // //console.log(search_table_name);
                                                                                        // $("#lab_test_body").html("");
                                                                                        // anti_neuclear_antibodies += "<input type=\"hidden\" id=\"lab_table_name\" name=\"lab_table_name\" value=\""+search_table_name+"\">";
                                                                                        // if(search_table_name==='lab_anti_neuclear_antibodies'){
                                                                                        // //console.log("yes yes!!!");
                                                                                        // $("#lab_test_body").append(anti_neuclear_antibodies);
                                                                                        // }

                                                                                        // //$('#natureofspecimen').select2();
                                                                                        // /*var idi  = id.replace( /^\D+/g, '');
                                                                                        // var select_id  = $(this).val();
                                                                                        // var find = paid_items.findIndex(x => x.id==select_id);
                                                                                        // console.log(find);
                                                                                        // var rate = paid_items[find]['rate'];
                                                                                        // console.log('input[name="rate['+idi+']"]');
                                                                                        // $('input[name="rate['+idi+']"]').val(rate);*/
                                                                                    })
                                                                                }
                                                                            };
                                                                            Select2.init();
                                                                            setTimeout(function(){  $('#examrequired').val(lab_form_id).trigger('change');}, 1000);
                                                                            
                                                                        });


            </script>