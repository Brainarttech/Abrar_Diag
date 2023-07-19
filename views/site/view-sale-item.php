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
                                                <?= $data->item_name?>
                                            </h1>
                                        </a>
                                      <span class="m-badge m-badge--success m-badge--wide">
								Complete
							</span>
                                    </div>
                                    <div class="m-invoice__items">
                                        <div class="m-invoice__item">
																<span class="m-invoice__subtitle">
																	DATA
																</span>
																<span class="m-invoice__text">
																	<?= \app\helpers\datetime::saleItemDateTime($data->created_on)?>
																</span>
                                        </div>
                                        <div class="m-invoice__item">
																<span class="m-invoice__subtitle">
																	RECEIPT NO
																</span>
																<span class="m-invoice__text">
																	<?= $data->sale->invoice_no?>
																</span>
                                        </div>
                                        <div class="m-invoice__item">
																<span class="m-invoice__subtitle">
																	PATIENT
																</span>
																<span class="m-invoice__text">
																	<?= $data->sale->patient->name?>
                                                                    <br>
                                                                    <?= $data->sale->patient->gender?> / <?= $data->sale->patient->phone_no?>
																</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#report" role="tab">
                                                Report
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
                                                            </tr>
                                                            </thead>
                                                            <tbody id="optionaltable">
                                                            <?php
                                                            
                                                            foreach ($option_items as $value){
                                                                
                                                                ?>

                                                                <tr>
                                                                    <td style="padding-right: 2%">
                                                                        <input type="text"  value="<?= $value['product_name']?>" class="form-control " readonly>
                                                                    </td>
                                                                    <td style="padding-left: 2%;padding-right: 2%"> <input type="text" value="<?= $value['product_quantity']?>" class="form-control" readonly>
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
                                                    </tr>
                                                    </thead>
                                                    <tbody id="dynamictable">
                                                    <?php

                                                    $total = 0;

                                                    foreach ($extra_charges as $value){

                                                    ?>

                                                    <tr >
                                                        <td style="padding-right: 2%">
                                                            <input type="text" class="form-control" value="<?= $value['item_name']?>" readonly>

                                                        </td>
                                                        <td> <textarea class="form-control m_autosize_1" rows="1" readonly><?= $value['item_description']?></textarea></td>
                                                        <td style="padding-left: 2%;padding-right: 2%">
                                                            <input type="text" class="form-control" value="<?= $value['item_quantity']?>" readonly>
                                                        </td>
                                                        <td> <input type="text"  class="form-control" value="<?= $value['item_rate']?>" readonly> </td>
                                                        <td class="m--font-danger"><span class="total"><?= $result  = $value['item_quantity'] * $value['item_rate']?> <?php $total = $total + $result?>  </span></td>
                                                    </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
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
                                                                <span class="total_amount"><?= $total?></span>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="comment" role="tabpanel">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <textarea id="commentdata" name="commentdata" class="form-control" data-provide="markdown" rows="10" readonly><?=$data->comment?></textarea>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="report" role="tabpanel">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <textarea id="reportdata" name="rowdata" class="form-control" data-provide="markdown" rows="10" readonly><?=$data->report?></textarea>
                                            </div>
                                        </div>
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

        <script>


            autoSize();


            function autoSize() {
                var Autosize={init:function(){var i,t;i=$(".m_autosize_1"),autosize(i),autosize(t),autosize.update(t)}};
                jQuery(document).ready(function(){Autosize.init()});


            }





            var BootstrapMarkdown={init:function(){}};jQuery(document).ready(function(){BootstrapMarkdown.init()});

        </script>