<h3 class="m-portlet__head-text text-center">LABORATORY REPORT</h3>
<h4 class="m-portlet__head-text text-center">Blood Group Rh Factor</h4>
<div class="form-group m-form__group row">
    <label for="natureofspecimen" class="col-4 offset-2 col-form-label">
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
    <label for="bloodgroup" class="col-4 offset-2 col-form-label">
        Blood Group:
    </label>
	<div class="col-4">
    <?php
        if($dataReader[blood_group] === '0'){
            echo '<input class="form-control m-input" type="text" value="AYE" readonly>';
        }
        else if($dataReader[blood_group] === '1'){
            echo '<input class="form-control m-input" type="text" value="BEE" readonly>';
        }
        else if($dataReader[blood_group] === '2'){
            echo '<input class="form-control m-input" type="text" value="AB" readonly>';
        }
        else if($dataReader[blood_group] === '3'){
            echo '<input class="form-control m-input" type="text" value="OOO" readonly>';
        }
		else if($dataReader[blood_group] === '4'){
            echo '<input class="form-control m-input" type="text" value="A" readonly>';
        }
		else if($dataReader[blood_group] === '5'){
            echo '<input class="form-control m-input" type="text" value="B" readonly>';
        }
		else if($dataReader[blood_group] === '6'){
            echo '<input class="form-control m-input" type="text" value="AB" readonly>';
        }
		else if($dataReader[blood_group] === '7'){
            echo '<input class="form-control m-input" type="text" value="O" readonly>';
        }
    ?>
    </div>
</div>
<div class="form-group m-form__group row">
    <label for="rhfactor" class="col-4 offset-2 col-form-label">
        Rh Factor:
    </label>
	<div class="col-4">
    <?php
        if($dataReader[rh_factor] === '0'){
            echo '<input class="form-control m-input" type="text" value="Postive" readonly>';
        }
        else if($dataReader[rh_factor] === '1'){
            echo '<input class="form-control m-input" type="text" value="Negative" readonly>';
        }
    ?>
    </div>
</div>