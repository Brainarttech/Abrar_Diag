<?php

use yii\helpers\Url;
use yii;
use yii\helpers\BaseUrl;
//$baseUrl = Yii::$app->homeUrl;
//echo $baseUrl."labform/paper.css";
//echo Url::base(true)."labform/paper.css"; 
/* echo '<pre>';
  echo print_r($data);
  echo '</pre>';

  echo '<pre>';
  echo print_r($dataReader);
  echo '</pre>';

  echo '<pre>';
  echo print_r($option_items);
  echo '</pre>';

  echo '<pre>';
  echo print_r($extra_charges);
  echo '</pre>'; */
use yii\helpers\Html;
use yii\mPDF;
?>
<style>
.heading {
    font-size: 45px;
    font-weight: bold;

}

/* pdf page setting */
@page {
    margin-top: 5mm;
    margin-bottom: 5mm;
    margin-left: 0mm;
    margin-right: 0mm;
}

.heading1 {
    font-weight: 900;
}

.font-style {
    font-family: "Arial Black", Gadget, sans-serif;
    color: #4F0000;
}


/* depart span class */
.dept-span-class {
    font-size: 20px;
}

@media print {
    .print-hide {
        display: none !important;
        ;
    } 
}
</style>


<div style="height:4px;border:none;background-color:#555652;"></div>
<div class="container" style="margin-top:15%;">
    <div class="row">
        <div class="col-sm-12">
            <!-- body header div -->
            <div class="font-style dept-span-class "
                style="text-align:center;font-size:36px;margin-top:10px;margin-bottom:5%;"><span
                    style="font-weight:bold;"></span>

                </span>


            </div>

        </div>
        <!-- side div  -->
        <div class="print-hide" style="line-height:1.0;width:5%;float:left;margin-left:8mm;">
            <span style="font-size:30px; top:-30px !important;">
                <?= Html::img(BaseUrl::base().'\images\image3.png' , ['height' => '400px']) ?></span>
        </div>

        <!-- content display div -->

        <div id="parent"
            style="height:70%;width:680px;float:left;
    background-image:url('../images/letter.png'); background-position:center;background-repeat:no-repeat;margin-left:65px;margin-right:8mm;">

            <!-- display patient data other details -->
            <table id="child2" border="2px solid black" class="table table-hover"
                style="line-height:1.8;font-size:12px;width:100%;text-align:left">

                <tbody>
                    <tr>
                        <th align="left"> Patient Name </th>
                        <td align="left" style="padding-left:45px;"> <?= $patient_data->name ?></td>
                        <th align="left" style="padding-left:85px;"> Patient ID </th>
                        <td align="right"> <?= $patient_data->id ?></td>
                    </tr>
                    <tr>
                        <th align="left" scope="row"> Age </th>
                        <td align="left" style="padding-left:45px;">
                            <?= ($patient_data->age."/".$patient_data->age_type) ?></td>
                        <th align="left" scope="row" style="padding-left:85px;"> Sex </th>
                        <td align="right"> <?= ucfirst($patient_data->gender); ?></td>
                    </tr>
                    <tr class="table-primary">
                        <th align="left" scope="row">Date & Time</th>
                        <td align="left" style="padding-left:45px;">
                            <?= \app\helpers\datetime::saleItemDateTime($patient_data->created_on) ?></td>
                        <th align="left" scope="row" style="padding-left:85px;"> Invoice Id </th>
                        <td align="right"> <?= $invoice_no?> </td>
                    </tr>
                    <tr class="table-secondary">
                        <th align="left" scope="row">Test Name </th>
                        <td align="left" style="padding-left:45px;"><?= $item_data->name?></td>
                        <th align="left" scope="row" style="padding-left:85px;"> Referred By </th>
                        <td align="right"> <?= $query->sale->referred->name ?> </td>
                    </tr>

                </tbody>
            </table>
            <!-- department div -->
            <div>
                <h4
                    style="margin-top:20px;text-align:center;font-size:20px;margin-bottom:30px!important;font-weight:bold;">
                    <?= $item_data->name?> REPORT</h4>
                <?=  $report_data; ?>



            </div>
            <!-- Footer -->

<!-- 
            <button id="print_page" class="print-hide"
                style="background:#b82326;padding:10px 20px;margin-top:10%;float-right;color:white;border:none;border-radius:15px;cursor:pointer;"
                onclick="print()">Print the Report</button> -->
            <!-- End of Footer -->

            <script>
                 window.print();
        
         
            </script>