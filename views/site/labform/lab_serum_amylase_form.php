<h3 class="m-portlet__head-text text-center">LABORATORY REPORT</h3>
<h3 class="m-portlet__head-text text-center">SERUM AMYLASE</h3>
<div class="form-group m-form__group row">
    <label for="natureofspecimen" class="col-3 offset-2 col-form-label">
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
    <div class="col-2 offset-2">
        <h5>Test</h5>
    </div>
    <div class="col-4">
        <h5>Result</h5>
    </div>
    <div class="col-4">
        <h5>Ref. Value</h5>
    </div>
</div>
<div class="form-group m-form__group row">
    <div class="col-2 offset-2">
        <h5>Serum Amylase</h5>
    </div>
    <div class="col-4">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[serum_amylase].'" readonly>'; ?>
    </div>
    <div class="col-4">
        <h5>Upto 90 u/L</h5>
    </div>
</div>