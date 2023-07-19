<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LabForm */

$this->title = $model->form_name;
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
		.m-invoice-2 .m-invoice__wrapper .m-invoice__body table#generate_lab_form tbody tr td{
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
					<div class="m-invoice__logo">
						<div class="row">
							<h4><?= $model->form_name ?></h4>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="">
						<div class="table-responsive">
							<table class="table table-bordered m-table m-table--border-primary m-table--head-bg-primary" id="generate_lab_form">
								<thead>
									<tr>
										<th>
											Lab Form ID
										</th>
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

									$get_data = \app\models\LabFormField::find()->where(['lab_form_id'=>$_GET['id']])->all();
									foreach ($get_data as $data)
									{?>
										<tr>
											<td><?= $_GET['id']?></td>
											<td><?= $data->header_name?></td>
											<td><?= $data->name?></td>
											<td>
												<input class="form-control m-input" type="text" id="<?= $data->id?>" name="form_values_id[<?= $data->id?>]" required>
											</td>
											<td><?= $data->unit?></td>
											<td><?= $data->reference_range	?></td>
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

    $(document).ready(function() {
        var table = $('#generate_lab_form').DataTable({
            rowGroup: {
                // Group by office
                dataSrc: 1
            },
            "columnDefs": [
                {
                    "targets": [ 0 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 1 ],
                    "visible": false,
                    "searchable": false
                },
                /*{
                    "targets": [ 5 ],
                    "type":"html",
                },*/

            ],
            "bPaginate": false,
            "searching": false,
            "bSort" : false,
            //rowReorder: true,

        });
    });
</script>
