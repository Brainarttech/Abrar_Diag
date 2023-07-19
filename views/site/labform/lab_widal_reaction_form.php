<h3 class="m-portlet__head-text text-center">LABORATORY REPORT</h3>
<h4 class="m-portlet__head-text text-center">WIDAL REACTION</h4>
<div class="form-group m-form__group row">
    <label for="natureofspecimen" class="col-3 offset-1 col-form-label">
        NATURE OF SPECIMEN:
    </label>
    <div class="col-4">
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
    <label for="to" class="col-2 offset-2 col-form-label">
        TO:
    </label>
    <div class="col-4">
		<?php	echo '<input class="form-control m-input" type="text" value="'.$dataReader[w_to].'" readonly>';	?>
    </div>
</div>
<div class="form-group m-form__group row">
    <label for="th" class="col-2 offset-2 col-form-label">
        TH:
    </label>
    <div class="col-4">
		<?php	echo '<input class="form-control m-input" type="text" value="'.$dataReader[w_th].'" readonly>';	?>
    </div>
</div>
<div class="form-group m-form__group row">
    <label for="ao" class="col-2 offset-2 col-form-label">
        AO:
    </label>
    <div class="col-4">
		<?php	echo '<input class="form-control m-input" type="text" value="'.$dataReader[w_ao].'" readonly>';	?>
    </div>
</div>
<div class="form-group m-form__group row">
    <label for="bo" class="col-2 offset-2 col-form-label">
        BO:
    </label>
    <div class="col-4">
		<?php	echo '<input class="form-control m-input" type="text" value="'.$dataReader[w_bo].'" readonly>';	?>
    </div>
</div>