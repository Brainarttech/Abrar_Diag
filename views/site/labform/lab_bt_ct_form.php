<h3 class="m-portlet__head-text text-center">LABORATORY REPORT</h3>
<h3 class="m-portlet__head-text text-center">BT. CT.</h3>
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
    <label for="bleedingtime" class="col-3 col-form-label">
        Bleeding Time:
    </label>
    <div class="col-3">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[bt_m].'" readonly>'; ?>
    </div>
    <label for="control" class="col-form-label">
        Minutes
    </label>
    <div class="col-3">
		<?php
            echo '<input class="form-control m-input" type="text" value="'.$dataReader[bt_s].'" readonly>';
        ?>
    </div>
    <label for="control" class="col-form-label">
        Seconds
    </label>
</div>
<div class="m-section">
    <h3 class="m-section__heading text-center">
        Normal Value Upto 9 Minute
    </h3>
</div>
<div class="form-group m-form__group row">
    <label for="clottingtime" class="col-3 col-form-label">
        Clotting Time:
    </label>
    <div class="col-3">
		<?php
            echo '<input class="form-control m-input" type="text" value="'.$dataReader[ct_m].'" readonly>';
        ?>
    </div>
    <label for="control" class="col-form-label">
        Minutes
    </label>
    <div class="col-3">
		<?php
            echo '<input class="form-control m-input" type="text" value="'.$dataReader[ct_s].'" readonly>';
        ?>
    </div>
    <label for="control" class="col-form-label">
        Seconds
    </label>
</div>
<div class="m-section">
    <h3 class="m-section__heading text-center">
        Normal Value Upto 11 Minute
    </h3>
</div>