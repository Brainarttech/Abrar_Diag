<div class="tab-content" data-select2-id="13">
    <div class="tab-pane active show" id="optional" role="tabpanel" data-select2-id="optional">
        <div class="row" data-select2-id="149">
            <div class="col-md-6" data-select2-id="148">
                <div class="table-responsive" data-select2-id="147">
                    <table class="table" id="tab_optional">
                        <thead>
                            <tr>
                                <th>PRODUCT</th>
                                <th style="text-align: center;width: 20%;">QTY</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody id="optionaltable">

                        <tr id="opt1">
                            <td style="padding-right: 2%">
                                <select class="form-control m-select2 required select2-hidden-accessible" id="m_1" name="opt_product[1]" data-select2-id="m_1" tabindex="-1" aria-hidden="true">
                                    <option value="" data-select2-id="122">Search for products</option>
                                    <option value="6" data-select2-id="123">Avil</option>
                                    <option value="7" data-select2-id="124">Distal Water</option>
                                    <option value="8" data-select2-id="125">Meta Clop</option>
                                    <option value="9" data-select2-id="126">HYZONATE 100mg</option>
                                    <option value="10" data-select2-id="127">HYZONATE 250mg</option>
                                    <option value="11" data-select2-id="128">Lasix</option>
                                    <option value="12" data-select2-id="129">Atropine </option>
                                    <option value="13" data-select2-id="130">zylocaine</option>
                                    <option value="14" data-select2-id="131">25% Dextrox</option>
                                    <option value="15" data-select2-id="132">Dicloran</option>
                                    <option value="16" data-select2-id="133">veran</option>
                                    <option value="17" data-select2-id="134">Adrenaline</option>
                                    <option value="18" data-select2-id="135">Propofol</option>
                                    <option value="19" data-select2-id="136">ketamen</option>
                                    <option value="20" data-select2-id="137">Dormicum</option>
                                    <option value="21" data-select2-id="138">Valium</option>
                                    <option value="22" data-select2-id="139">canula</option>
                                    <option value="23" data-select2-id="140">Butterfly Needle</option>
                                    <option value="24" data-select2-id="141">Syringe 10cc</option>
                                    <option value="32" data-select2-id="142">Gadolinium</option>
                                    <option value="33" data-select2-id="143">Gadovist</option>
                                    <option value="34" data-select2-id="144">Sulphate Powder</option>
                                </select>
                                <span class="select2 select2-container select2-container--default select2-container--above" dir="ltr" data-select2-id="145" style="width: 291.688px;">
                                    <span class="selection">
                                        <span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-m_1-container">
                                            <span class="select2-selection__rendered" id="select2-m_1-container" role="textbox" aria-readonly="true">
                                                <span class="select2-selection__placeholder">Select a value</span>
                                            </span>
                                            <span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                                        </span>
                                    </span>
                                    <span class="dropdown-wrapper" aria-hidden="true"></span>
                                </span>
                            </td>
                            <td style="padding-left: 2%;padding-right: 2%">
                                <input type="text" name="opt_qty[6]" value="1" class="qty form-control digit groupOfTexbox required">
                            </td>
                            <td> 
                                <button id="btn6" type="button" class="btn btn-danger btn-sm del" aria-label="Close">Remove</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row clearfix">
                    <div class="col-md-12">
                        <a href="javascript:void(0)" id="add_row_optional" class="btn btn-info btn-sm pull-left m-btn m-btn--icon">
                            <span>
                                <i class="fa fa-plus"></i>
                                <span>Add</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    var i=0;
    var j=1;

    var option_items = '{a,b,c,d,e,f}';
    var paid_items = '';
    console.log(option_items);
    autoSize();
    $("#add_row").click(function(){
        i++;
        $('#dynamictable').append('<tr id="addr'+i+'"><td style="padding-right: 2%"><select class="form-control m-select2 required " id="paid_'+i+'"  name="product['+i+']"><option value="">Search for products</option></select></td><td> <textarea class="form-control m_autosize_1" name="description['+i+']"  rows="1"></textarea></td><td style="padding-left: 2%;padding-right: 2%"> <input type="text" name="qty['+i+']" class="qty form-control digit groupOfTexbox required" value="1"> </td> <td > <input type="text" name="rate['+i+']" class="price form-control digit groupOfTexbox required"> </td> <td class="m--font-danger"><span class="total">0</span></td> <td> <button id="btn'+i+'" type="button" class="close" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </td></tr>');
        autoSize();
        autoSelectPaid('paid_'+i);
        forecedNunber();

    });

    $("#add_row_optional").click(function(){
        j++;
        $('#optionaltable').append('<tr id="opt'+j+'"><td style="padding-right: 2%"> <select class="form-control m-select2 required " id="m_'+j+'"  name="opt_product['+j+']"><option value="">Search for products</option></select></td><td style="padding-left: 2%;padding-right: 2%"> <input type="text" name="opt_qty['+j+']" value="1" class="qty form-control digit groupOfTexbox required"> </td><td> <button id="btn'+j+'" type="button" class="btn btn-danger btn-sm del" aria-label="Close">Remove</button> </td></tr>');
        autoSelect('m_'+j);
        forecedNunber();

    });

    function forecedNunber() {
        $('.groupOfTexbox').keypress(function (event) {
            return isNumber(event, this)
        });

    }


    function autoSize() {
        var Autosize={init:function(){var i,t;i=$(".m_autosize_1"),autosize(i),autosize(t),autosize.update(t)}};
        jQuery(document).ready(function(){Autosize.init()});


    }

    $(document).on('click', '.del', function(event){

        $('.tooltip').remove();

        var btnid = $(this).attr('id');
        btnid = btnid.replace("btn", "");
        $('#opt'+btnid).remove();
    });

    $(document).on('click', '.close', function(event){

        $('.tooltip').remove();

        var btnid = $(this).attr('id');
        btnid = btnid.replace("btn", "");
        $('#addr'+btnid).remove();
        calc_total();
    });

    /*$('#tab_logic tbody').on('keyup change',function(){
        calc();
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
                var qty = $(this).find('.qty').val();
                var price = $(this).find('.price').val();
                $(this).find('.total').html(qty*price);
                calc_total();
            }
        });
    }*/

    /*function calc_total()
    {
        var total=0;
        $('.total').each(function() {
            console.log($(this).val());
            total += parseInt($(this).text());
        });

        //$('#sub_total').val(total.toFixed(2));
        //tax_sum=total/100*$('#tax').val();
        //$('#tax_amount').val(tax_sum.toFixed(2));
        $('.total_amount').html((total).toFixed(2));
    }*/


    var BootstrapMarkdown={init:function(){}};jQuery(document).ready(function(){BootstrapMarkdown.init()});

    $("#submit").click(function(){

        var me = $(this);
        if($("#m_form").valid())
        {
            var form = $("#m_form");

            if ( me.data('requestRunning') ) {
                return;
            }
            me.data('requestRunning', true);

            var url = form.attr('action');
            console.log(form.serialize());
            var comment = $('#comm').val();
            var id = <?= $_GET['id'];?>

            console.log(comment);

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize()+ "&comment="+comment+""+ "&sale_item_id="+id+"", // serializes the form's elements.
                success: function(data)
                {
                    window.location = "<?= Yii::$app->homeUrl?>site/view-sale-item?id=<?=$_GET['id']?>";
                },complete: function() {
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
    var FormControls= {
            init:function() {
                $("#m_form").validate( {
                        rules: {

                        }

                        , invalidHandler:function(e, r) {
                            var i=$("#m_form_1_msg");
                            i.removeClass("m--hide").show(), mApp.scrollTo(i, -50)
                        }
                        , submitHandler:function(e) {}
                    }

                )
            }
        };
    jQuery(document).ready(function() {
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
            (charCode != 45 || $(element).val().indexOf('-') != -1) &&      // “-” CHECK MINUS, AND ONLY ONE.
            (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
            (charCode < 48 || charCode > 57))
            return false;

        return true;
    }

    function autoSelect(id) {
        var Select2 = {
            init: function () {
                $("#"+id+"").select2({
                       /* placeholder: "Search for products", allowClear: !0, ajax: {
                            url: "<?=Yii::$app->homeUrl?>ajax/get-optional-items",
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
                    placeholder:"Select a value", data:option_items
                    }
                )

                    $("#"+id+"").change(function() {

                        var idi  = id.replace( /^\D+/g, '');

                        var select_id  = $(this).val();
                        var find = option_items.findIndex(x => x.id==select_id);
                        console.log(find);
                        var qty  = option_items[find]['qty'];
                        console.log('input[name="opt_qty['+id+']"]');
                        $('input[name="opt_qty['+idi+']"]').val(qty);



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
                $("#"+id+"").select2({

                        placeholder:"Select a value", data:paid_items
                    }
                )

                $("#"+id+"").change(function() {

                    var idi  = id.replace( /^\D+/g, '');

                    var select_id  = $(this).val();
                    var find = paid_items.findIndex(x => x.id==select_id);
                    console.log(find);
                    var rate = paid_items[find]['rate'];
                    console.log('input[name="rate['+idi+']"]');
                    $('input[name="rate['+idi+']"]').val(rate);



                })

            }
        };
        jQuery(document).ready(function () {
                Select2.init()
            }
        );

    }

    
</script>