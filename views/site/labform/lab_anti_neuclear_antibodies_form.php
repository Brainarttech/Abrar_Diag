<h3 class="m-portlet__head-text" style="text-align: center;">LABORATORY REPORT</h3>

<div class="form-group m-form__group row">
	<label for="natureofspecimen" class="col-3 offset-3 col-form-label">
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
<div class="form-group m-form__group row">
	<label for="antineuclearantibodies" class="col-3 offset-3 col-form-label">
		Anti Neuclear Antibodies:
	</label>
	<div class="col-3">
		<?php
	        if($dataReader[anti_neuclear_antibodies] === '0'){
	            echo '<input class="form-control m-input" type="text" value="Postive" readonly>';
	        }
	        else if($dataReader[anti_neuclear_antibodies] === '1'){
	            echo '<input class="form-control m-input" type="text" value="Negative" readonly>';
	        }
	    ?>
	</div>
</div>