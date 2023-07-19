<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LabForm */

$this->title = $model->item->name;
$this->params['breadcrumbs'][] = ['label' => 'Lab Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="lab-form-view">
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
        .m-table.m-table--head-bg-primary thead th {
            background: #5867dd !important;
            color: #fff !important;
            border-bottom: 0 !important;
            border-top: 0 !important;
            padding: .75rem !important;
        }
        .m-invoice-2 .m-invoice__wrapper .m-invoice__body table#generate_lab_form_readonly tbody tr td{
            border-color: #5867dd !important;
            padding: .75rem !important;
            border-top: 1px solid;
            text-align: left !important;
            font-weight: 300 !important;
            font-size: 14px !important;
        }

    </style>
    <div class="m-invoice-2">
        <div class="m-invoice__wrapper12">
            <div class="m-invoice__head">
                <div class="m-invoice__container m-invoice__container--centered">
                    <div class="row" style="display: block;text-align:center">
                        <h4><?= $model->labFormSubmit->lab_form_title ?></h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="">
                        <div class="table-responsive">
                            <table class="table table-bordered m-table m-table--border-primary m-table--head-bg-primary" id="generate_lab_form_readonly">
                                <thead>
                                    <tr>
                                        <th>
                                            Test Header
                                        </th>
                                        <th>
                                            Test Name
                                        </th>
                                        <th style="text-align: center;">
                                            Result
                                        </th>
                                        <th style="text-align: center;">
                                            Unit
                                        </th>
                                        <th style="text-align: center;width: 50%;">
                                            Reference Range
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($model->labFormSubmit->labFormFieldSubmit as $temp) {
                                        ?>
                                        <tr>
                                            <td><?= $temp->header_name ?></td>
                                            <td><?= $temp->name ?></td>
                                            <td><?= $temp->result ?></td>
                                            <td><?= $temp->unit ?></td>
                                            <td><?= $temp->reference_range ?></td>
                                        </tr>
                                    <?php } ?>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




</div>



<script>

    $(document).ready(function () {
        var table = $('#generate_lab_form_readonly').DataTable({
            rowGroup: {
                // Group by office
                //dataSrc: 1
            },
            "columnDefs": [
                {
                    "targets": [0],
                    "visible": false,
                    "searchable": false
                },
                        /*{
                         "targets": [ 1 ],
                         "visible": false,
                         "searchable": false
                         },
                         {
                         "targets": [ 5 ],
                         "type":"html",
                         },*/

            ],
            "bPaginate": false,
            "searching": false,
            "bSort": false,
            //rowReorder: true,

        });
    });
</script>
