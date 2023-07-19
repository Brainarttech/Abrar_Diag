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

.heading{
font-size: 45px;
font-weight:bold;

}
/* pdf page setting */
@page{
  margin-top:5mm;
  margin-bottom:5mm;
  margin-left:0mm;
  margin-right:0mm;
}
.heading1{
  font-weight :900;
}
.font-style{
  font-family: "Arial Black", Gadget, sans-serif;
   color :#4F0000; 
}


/* depart span class */
.dept-span-class{
  font-size: 20px;
}


</style>

 <nav class="navbar"> 
         <div class="container">
            
            <div class="navbar-header "> 
            <!-- logo display div -->
            <div style="width:170px;height:90px;float:left;padding-bottom:6px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= Html::img(BaseUrl::base().'\..\resources\images\pdfside.png' , ['height' => '99px' , 'width' => '99px'] , ['style' => 'margin-left:30mm']) ?></div>
            <!-- head div  -->
            <div style="width:600px;text-align:center;">
            <span style="display:inline-block;">
             <span class="font-style heading" style="text-shadow: 1px 2px, 2px 1px, 2px 1px;font-size:2rem;" >ABRAR DIAGNOSTIC CENTER</span><br>
             <span class="font-style "style="font-weight:bold; color: #0095da !important;"> 312-E Charing Cross, Peshawar Road, Rawalpindi Cantt, Tel: 5167015, 5473543<br>
             E-mail:mri_ct@hotmail.com Web: www.abrardiagnostics.com.pk</span>
            </span>
            </div>
            
            
            </div> 
          </div> 
        </nav> 
 <div style="height:4px;border:none;background-color:#555652"></div> 
<div class="container">
  <div class="row">
    <div class="col-sm-12">
   <!-- body header div -->
<div class="font-style dept-span-class" style="text-align:center;font-size:15px;margin-top:10px;"><span style="font-weight:bold;">PATHOLOGY DEPARTMENT</span><br>
Special Chemistry and Harmone Assay<br> 
Final Lab Report</span>

    
    </div>
  
  </div>
  <!-- side div  -->
  <div style="line-height:1.0;width:50px;float:left;margin-left:8mm;">
  <span style="font-size:30px; top:-30px !important;"> <?= Html::img(BaseUrl::base().'\..\resources\images\image3.png' , ['height' => '800px']) ?></span>
 </div>

<!-- content display div -->

<div id="parent" style="height:810px;width:680px;float:right;
    background-image:url('../resources/images/letter.png'); background-position:center;background-repeat:no-repeat;margin-left:65px;margin-right:8mm;">
  
  <!-- display patient data other details -->
<table id="child2" border="2px solid black"  class="table table-hover" style="line-height:1.8;font-size:12px;width:100%;text-align:left">
  
  <tbody>
    <tr>
      <th align="left" > Patient Name </th>
      <td align="left" style="padding-left:45px;"> <?= $query->sale->patient->name ?></td>
      <th align="left" style="padding-left:85px;"> Patient ID </th>
      <td align="right"> <?= $query->sale->patient->reg_no ?></td>
    </tr>
    <tr>
      <th align="left" scope="row"> Age </th>
      <td align="left" style="padding-left:45px;"><?= ($query->sale->patient->age."/".$query->sale->patient->age_type) ?></td>
      <th align="left" scope="row" style="padding-left:85px;"> Sex </th>
      <td align="right"> <?= ucfirst($query->sale->patient->gender); ?></td>
    </tr>
    <tr class="table-primary">
      <th align="left" scope="row">Date & Time</th>
      <td align="left" style="padding-left:45px;"> <?= \app\helpers\datetime::saleItemDateTime($query->created_on) ?></td>
      <th align="left" scope="row" style="padding-left:85px;"> Lab ID </th>
      <td align="right"> <?= $query->sale->invoice_no ?> </td>
    </tr>
    <tr class="table-secondary">
      <th align="left" scope="row">Test Required </th>
      <td align="left" style="padding-left:45px;"><?= $query->item_name ?></td>
      <th align="left" scope="row" style="padding-left:85px;"> Referred By </th>
      <td align="right"> <?= $query->sale->referred->name ?> </td>
    </tr>
    
  </tbody>
</table>
<!-- department div -->
<div style="margin-top:8px;text-align:center;font-weight:bold;font-size:18px;border:1px solid black;"> <?= strtoupper($query->labFormSubmit->lab_form_title) ?> </div>
<br>

<!-- test report display table -->

<table style="border-collapse:collapse;width:100%;font-size:12px;border:1px solid black;z-index:1;">
<tr>
<th style="border:1px solid black;"> Test Name </th>
<th style="border:1px solid black;"> Result </th>
<th style="border:1px solid black;"> Unit </th>
<th style="border:1px solid black;"> Reference Range </th>

</tr>
<?php
    foreach ($query->labFormSubmit->labFormFieldSubmit as $key => $temp) {
        if ($query->labFormSubmit->labFormFieldSubmit[$key - 1]->header_name !== $query->labFormSubmit->labFormFieldSubmit[$key]->header_name && $temp->header_name !== '') {
?>
<tr >
  <th colspan='4' style="line-height:2.4;text-align:left;" > <b> <?=$temp->header_name?> </b> </th>
</tr>
<?php } ?>
<tr style="border:1px solid black;">
<td style="border:1px solid black;text-align:center;"> <?=$temp->name?></td>
<td style="border:1px solid black;text-align:center;"> <?=$temp->result?> </td>
<td style="border:1px solid black;text-align:center;"> <?=$temp->unit ?> </td>
<td style="border:1px solid black;line-height:1.8;padding:5px 0px 5px 9px;"><?=$temp->reference_range ?></td>
</tr>
<?php } ?>
</table>
  <?php if(!empty($query->comment) && !ctype_space($query->comment)
){ ?>
  <div style=" color:blue;
  position:absolute;
  z-index:3;"><strong> Remarks: </strong> <span style="padding-left: 5px;"> <?=$query->comment?> </span> </div>
<?php } ?>
<!-- end of test report table  -->
</div>
<!-- end of content div -->
</div>
<div style="padding-left:90px;">This is a computer generate report.</div>
<!-- Footer -->
<footer style=" margin-top:10px;">

       <div class="font-style" style=" width:193px;float:right;margin-right:8mm;line-height: 1.2;padding:6px 0px 6px 6px;border:2px solid black;">
      <span  style="font-weight:bold;color:black;">Dr. Qurat Ul Ain Naeem</span> <br>
     <span style="color:black;">M.B.B.S. , F.C.P.S <br>
      Consultant Pathologist</span>
       <div>
      </footer>
      <!-- End of Footer -->

