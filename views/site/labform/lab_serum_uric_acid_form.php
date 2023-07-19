<h3 class="m-portlet__head-text text-center">LABORATORY REPORT</h3>
<h3 class="m-portlet__head-text text-center">Serum Uric Acid</h3>
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
    <label for="serumuricacid" class="col-3 offset-2 col-form-label">
        SERUM URIC ACID:
    </label>
    <div class="col-3">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[serum_uric_acid].'" readonly>'; ?>
    </div>
    <label for="control" class="col-form-label">
        mg/dl
    </label>
</div>
<div class="m-section">
    <h3 class="m-section__heading text-center">
        NORMAL VALUE    (MALE)    3.4 - 7.0mg/dl
    </h3>
</div>
<div class="m-section">
    <h3 class="m-section__heading text-center">
        NORMAL VALUE    (FEMALE)    2.4 - 5.7mg/dl
    </h3>
</div>