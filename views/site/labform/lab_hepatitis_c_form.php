<h3 class="m-portlet__head-text text-center">LABORATORY REPORT</h3>
<h4 class="m-portlet__head-text text-center">HEPATITIS C TEST</h4>
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
    <label for="antihcv" class="col-3 offset-2 col-form-label">
        Anti HCV:
    </label>
	<div class="col-3">
    <?php
        if($dataReader[anti_hcv] === '0'){
            echo '<input class="form-control m-input" type="text" value="Reactive" readonly>';
        }
        else if($dataReader[anti_hcv] === '1'){
            echo '<input class="form-control m-input" type="text" value="Non Reactive" readonly>';
        }
    ?>
    </div>
</div>
<div class="m-section">
    <h3 class="m-section__heading text-center">
        (By immunochromatography )
    </h3>
</div>