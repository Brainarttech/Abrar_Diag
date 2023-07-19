<?php

use yii\helpers\Url;

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
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title></title>

        <!-- Normalize or reset CSS with your favorite library -->
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css"> -->

        <!-- Load paper.css for happy printing -->
        <link rel="stylesheet" href="<?= Url::base(true) . '/labform/paper.css' ?>">
        <!-- <link rel="stylesheet" href="paper.css"> -->

        <!-- Set page size here: A5, A4 or A3 -->
        <!-- Set also "landscape" if you need -->
        <style>@page { size: A4 }</style>
        <style>
            .text-right{
                text-align:right;
            }
            body{
                font-size:16px;
            }
            th{
                border:1px solid #000;
            }
            .heading  {
                border: 1px solid #000;
            }
            .items td {
                border: 1px solid #000;
            }
            .tests{
                font-size:15px;
            }
            #range p{

                margin:0px;
            }
        </style>
    </head>

    <!-- Set "A5", "A4" or "A3" for class name -->
    <!-- Set also "landscape" if you need -->
    <body class="A4">

        <!-- Each sheet element should have the class "sheet" -->
        <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
        <section class="sheet padding-30mm">

            <!-- Write HTML just like a web page -->
            <!-- <article>This is an A4 document.</article> -->
            <table style="width:100%;border: none;">
                <tr>
                    <td style="padding-right: 0px;width: 116px;"><b>Patient Name</b></td>
                    <td><?= $query->sale->patient->name ?></td>
                    <td style=""><b>Patient ID</b></td>
                    <td  class="text-right" style="padding: 0px;width: 230px;"><?= $query->sale->patient->reg_no ?></td>
                </tr>
                <tr>
                    <td><b>Age</b></td>
                    <td><?= $query->sale->patient->age ?>/<?= $query->sale->patient->age_type ?></td>
                    <td><b>Sex</b></td>
                    <td class="text-right"><?= $query->sale->patient->gender ?></td>
                </tr>
                <tr>
                    <td><b>Date & Time</b></td>
                    <td><?= \app\helpers\datetime::saleItemDateTime($query->created_on) ?></td>
                    <td><b>Lab ID</b></td>
                    <td class="text-right"><?= $query->sale->invoice_no ?></td>
                </tr>
                <tr>
                    <td><b>Test Required</b></td>
                    <td><?= $query->item_name ?></td>
                    <td><b>Referred By</b></td>
                    <td class="text-right"><?= $query->sale->referred->name ?></td>
                </tr>
            </table>

            <div class="box" style="width:90.7%">
                <h1 style="margin: -2px;"><?= $query->labFormSubmit->lab_form_title ?></h1>
            </div>

            <table style="width:100%;border: solid 1px #000;" class="tests">
                <thead>
                    <tr  style="text-align: center;font-size: 15px;">
                        <th style="width: 210px;">
                            Test Name
                        </th>
                        <th style="width: 122px;"> <!-- style="text-align: center;" -->
                            Result
                        </th>
                        <th style="width: 115px;">
                            Unit
                        </th>
                        <th style="text-align: center;">
                            Reference Range
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($query->labFormSubmit->labFormFieldSubmit as $key => $temp) {
                        if ($query->labFormSubmit->labFormFieldSubmit[$key - 1]->header_name !== $query->labFormSubmit->labFormFieldSubmit[$key]->header_name && $temp->header_name !== '') {
                            echo '<tr><td style="padding-left: 2px;padding-bottom: 6px;padding-top: 6px;" colspan="4"><b>' . $temp->header_name . '</b></td></tr>';
                        }

                        echo '<tr class="items">';
                        echo '<td style="padding: 2px;padding-bottom: 6px;padding-top: 6px;text-align: center;vertical-align: top;">' . $temp->name . '</td>';
                        echo '<td style="padding: 2px;padding-bottom: 6px;padding-top: 6px;text-align: center;vertical-align: top;">' . $temp->result . '</td>';
                        echo '<td style="padding: 2px;padding-bottom: 6px;padding-top: 6px;text-align: center;vertical-align: top;">' . $temp->unit . '</td>';
                        echo '<td id="range" style=" padding: 2px;padding-bottom: 6px; padding-left: 30px;padding-top: 6px;">'. $temp->reference_range . '</td>';
                        echo '</tr>';
                    }
                    ?>

                </tbody>

            </table>

            <div class="footer" style="font-size: 16px;position: absolute;top: 870px;margin:0px">
                <p style="float: left;margin-bottom: 35px;"><strong>Remarks:</strong></p>
                <div class="clear-both"></div>
                <p style="position: relative; left: 500px;top: -70px;"><strong>Lab Tech</strong></p>
                <pre style="position: relative;top: -70px; width: 475px; overflow-wrap: break-word;"><?php echo $query->comment ?></pre>
                <div class="clear-both"></div>
            </div>


        </section>

    </body>

</html>
