<h3 class="m-portlet__head-text text-center">LABORATORY REPORT</h3>
<h4 class="m-portlet__head-text text-center">BLOOD HEMOGLOBIN</h4>
<div class="form-group m-form__group row">
    <label for="natureofspecimen" class="col-4 offset-1 col-form-label">
        NATURE OF SPECIMEN:
    </label>
    <div class="col-3">
    <?php
        //echo '<pre>';
        //echo print_r($dataReader[n_o_s]);
        //echo '</pre>';
        //echo $dataReader[0]->n_o_s;
        //echo $dataReader[n_o_s];
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
    <label for="bloodhemoglobin" class="col-3 offset-2 col-form-label">
        BLOOD HEMOGLOBIN:
    </label>
    <div class="col-3">
		<?php
            echo '<input class="form-control m-input" type="text" value="'.$dataReader[blood_hemolobin].'" readonly>';
        ?>
    </div>
    <label for="control" class="col-form-label">
        g/dl
    </label>
</div>
<div class="m-section">
    <h3 class="m-section__heading text-center">
        Normal Value (Male 13.5-18g/dl) (Female 11.5-16.5g/dl)
    </h3>
</div>