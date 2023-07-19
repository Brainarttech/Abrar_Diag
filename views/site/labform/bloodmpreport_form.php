<h3 class="m-portlet__head-text text-center">LABORATORY REPORT</h3>
<h3 class="m-portlet__head-text text-center">BLOOD MP REPORT:</h3>
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
    <label for="bloodmp" class="col-4 offset-1 col-form-label">
        BloodMP:
    </label>
	<div class="col-3">
    <?php
        if($dataReader[blood_mp_status] === '0'){
            echo '<input class="form-control m-input" type="text" value="No MP Seen" readonly>';
        }
        else if($dataReader[blood_mp_status] === '1'){
            echo '<input class="form-control m-input" type="text" value="Mt Rings Seen" readonly>';
        }
        else if($dataReader[blood_mp_status] === '2'){
            echo '<input class="form-control m-input" type="text" value="Mt Rings & Gametocyte se" readonly>';
        }
        else if($dataReader[blood_mp_status] === '3'){
            echo '<input class="form-control m-input" type="text" value="BT Trophozoite seen" readonly>';
        }
    ?>
    </div>
</div>
<div class="form-group m-form__group row">
    <label for="bloodmpvalue" class="col-4 offset-1 col-form-label"></label>
    <div class="col-3">
		<?php
            echo '<input class="form-control m-input" type="text" value="'.$dataReader[blood_mp_value].'" readonly>';
        ?>
    </div>
</div>