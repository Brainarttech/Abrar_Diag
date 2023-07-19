<h3 class="m-portlet__head-text text-center">LABORATORY REPORT</h3>
<h4 class="m-portlet__head-text text-center">ELISA READER</h4>
<div class="form-group m-form__group row">
    <label for="natureofspecimen" class="col-4 offset-1 col-form-label">
        NATURE OF SPECIMEN:
    </label>
    <div class="col-3">
    <?php
        if($dataReader[n_o_s] === '0'){
            echo '<input class="form-control m-input" type="text" value="Blood" readonly>';
        }
        else if($dataReader[n_o_s] === '1'){
            echo '<input class="form-control m-input" type="text" value="Urine" readonly>';
        }
        else if($dataReader[n_o_s] === '2'){
            echo '<input class="form-control m-input" type="text" value="Semen" readonly>';
        }
        else if($dataReader[n_o_s] === '3'){
            echo '<input class="form-control m-input" type="text" value="SLIVA" readonly>';
        }
    ?>
    </div>
</div>
<div class="table table-bordered" style="width:100%">
    <table style="width:100%">
        <tr>
            <th>Name</th>
            <th>Cut of Value</th>
            <th>O.D</th>
            <th>Result</th>
        </tr>
        <tr>
            <td>Hbs Ag</td>
            <td>1.00</td>
            <td>
				<?php echo $dataReader[hbs_od]; ?>
            </td>
            <td>
				<?php
					if($dataReader[hbs_result] === '0'){
						echo "Reactive  (+)";
					}
					else if($dataReader[hbs_result] === '1'){
						echo "Non Reactive  (-)";
					}
				?>
            </td>
        </tr>
        <tr>
            <td>Hcv</td>
            <td>1.00</td>
            <td>
				<?php echo $dataReader[hcv_od]; ?>
            </td>
            <td>
				<?php
					if($dataReader[hcv_result] === '0'){
						echo "Reactive  (+)";
					}
					else if($dataReader[hcv_result] === '1'){
						echo "Non Reactive  (-)";
					}
				?>
            </td>
        </tr>
    </table>
</div>