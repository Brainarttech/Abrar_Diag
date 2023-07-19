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

                                                    <h4><?= $model->title ?></h4>

                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-1"></div>

                                    <div class="col-md-10">
                                            <div class="btn btn-primary" id="addRow">Add New Field</div>
                                            <br>

                                            <div class="">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered m-table m-table--border-primary m-table--head-bg-primary" id="generate_lab">
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
                                                            <th>
                                                                Action
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
                                                        <td></td>
                                                        <td><?= $data->unit?></td>
                                                        <td><?= $data->reference_range	?></td>
                                                       <td>

                                                            <a href="JavaScript:void(0);"  class=" trash m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">
                                                                <i class="la la-trash"></i>
                                                            </a>

                                                        </td>
                                                    </tr>

                                                    <?php } ?>

                                                    </tbody>

                                                    </table>
                                                </div>

                                            </div>

                                        <div class="row">
                                            <div class="col-lg-4"></div>
                                            <div class="col-lg-4 text-center">
                                                <button id="submit" class="btn btn-primary">
                                                    Submit
                                                </button>
                                                <a href ="<?= Yii::$app->homeUrl?>lab-form/index" class="btn btn-secondary">
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




</div>



<script>

    $(document).ready(function() {
        var table = $('#generate_lab').DataTable({
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
                {
                    "targets": [ 5 ],
                    "type":"html",
                },

            ],
            "bPaginate": false,
            "searching": false,
            "bSort" : false,
            //rowReorder: true,

        });


        $("#addRow").on("click", function(event) {
            var modal = bootbox.dialog({
                message: '<div class="form-group">'+
                '<label for="header">Header</label>'+
                '<input type="text" name="header" id="header"  class="form-control">'+
                '</div>'+
                '<div class="form-group">'+
                '<label>Name</label>'+
                '<input type="text" name="lab_name" id="name"  class="form-control">'+
                '</div>'+
                '<div class="form-group">'+
                '<label>Unit</label>'+
                '<input type="text" name="unit" id="unit"  class="form-control">'+
                '</div>'+
                '<div class="form-group">'+
                '<label>Reference Range</label>'+
                '<textarea name="reference_range" id="reference_range" class="form-control" rows="5"></textarea>'+
                '</div>',
                title: "<?= $model->title ?>",
                buttons: [
					{
						label: "Save",
						className: "btn btn-primary pull-left",
						callback: function(){
							if($('#name').val() ==='')
							{
								alert("Please Fill Name Field");
							}else {
								table.row.add([
									'<?= $_GET["id"]?>',
									$('#header').val(),
									$('#name').val(),
									'',
									$('#unit').val(),
									$('#reference_range').val(),
									'<a href="JavaScript:Void(0);"  class=" trash m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">'+
									'<i class="la la-trash"></i>'+
									'</a>'
								]).draw( false );
							}
							return false;
						}
					},
                    {
                        label: "Close",
                        className: "btn btn-default pull-left",
                        callback: function() {
                            console.log("just do something on close");
                        }
                    }
                ],
                show: false,
                onEscape: function() {
                    modal.modal("hide");
                }
            });
            modal.modal("show");
        });

        $('#generate_lab tbody').on( 'click', '.trash', function (event) {
            table
                .row( $(this).parents('tr') )
                .remove()
                .draw();
        } );

        $("#submit").on("click", function(event) {
            event.preventDefault();
            event.stopImmediatePropagation();
            if (table.rows().count() > 0){
                var submit_data = table.rows( { search: 'applied' } ).data().toArray();
                console.log(submit_data);
                var myJsonString = JSON.stringify(submit_data);
                $.ajax({
                    type: "POST",
                    url: '<?php echo Yii::$app->homeUrl?>ajax/lab-form-submit',
                    data: { json_string:myJsonString },
                    // serializes the form's elements.
                    success: function(data)
                    {
                        if(data==true)
                        {
                            window.location = '<?= Yii::$app->homeUrl?>lab-form/index';
                        }
                    }
                });
            }else {
                alert("Please Add Fields");
            }
        });
    });
</script>
