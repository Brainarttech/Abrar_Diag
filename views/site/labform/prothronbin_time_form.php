<h3 class="m-portlet__head-text text-center">LABORATORY REPORT</h3>
<h3 class="m-portlet__head-text text-center">Prothronbin Time</h3>
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
<div class="form-group m-form__group row">
    <label for="patient" class="col-3 offset-1 col-form-label">
        Patient:
    </label>
    <div class="col-3">
		<?php
            echo '<input class="form-control m-input" type="text" value="'.$dataReader[patient].'" readonly>';
        ?>
    </div>
    <label for="control" class="col-form-label">
        SECONDS
    </label>
</div>
<div class="form-group m-form__group row">
    <label for="control" class="col-3 offset-1 col-form-label">
        Control:
    </label>
    <div class="col-3">
		<?php
            echo '<input class="form-control m-input" type="text" value="'.$dataReader[control].'" readonly>';
        ?>
    </div>
    <label for="control" class="col-form-label">
        SECONDS
    </label>
</div>
<div class="form-group m-form__group row">
    <label for="control" class="col-3 offset-1 col-form-label">
        INR:
    </label>
    <div class="col-3">
		<?php
            echo '<input class="form-control m-input" type="text" value="'.$dataReader[inr].'" readonly>';
        ?>
    </div>
    <label for="control" class="col-form-label">
        SI UNIT
    </label>
</div>