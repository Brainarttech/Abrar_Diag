<h3 class="m-portlet__head-text text-center">LABORATORY REPORT</h3>
<h3 class="m-portlet__head-text text-center">Serology</h3>
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
    <label for="crp" class="col-2 col-form-label">
        CRP:
    </label>
	<div class="col-3">
		<?php
			if($dataReader[sr_crp] === '0'){
				echo '<input class="form-control m-input" type="text" value="Postive" readonly>';
			}
			else if($dataReader[sr_crp] === '1'){
				echo '<input class="form-control m-input" type="text" value="Negative" readonly>';
			}
		?>
    </div>
    <label for="rafactor" class="col-3 col-form-label">
        RA FACTOR:
    </label>
	<div class="col-3">
		<?php
			if($dataReader[sr_ra_fac] === '0'){
				echo '<input class="form-control m-input" type="text" value="Postive" readonly>';
			}
			else if($dataReader[sr_ra_fac] === '1'){
				echo '<input class="form-control m-input" type="text" value="Negative" readonly>';
			}
		?>
    </div>
</div>
<div class="form-group m-form__group row">
    <label for="vdrl" class="col-2 col-form-label">
        VDRL:
    </label>
	<div class="col-3">
		<?php
			if($dataReader[sr_vdrl] === '0'){
				echo '<input class="form-control m-input" type="text" value="Postive" readonly>';
			}
			else if($dataReader[sr_vdrl] === '1'){
				echo '<input class="form-control m-input" type="text" value="Negative" readonly>';
			}
		?>
    </div>
    <label for="anf" class="col-3 col-form-label">
        ANF:
    </label>
	<div class="col-3">
		<?php
			if($dataReader[sr_anf] === '0'){
				echo '<input class="form-control m-input" type="text" value="Postive" readonly>';
			}
			else if($dataReader[sr_anf] === '1'){
				echo '<input class="form-control m-input" type="text" value="Negative" readonly>';
			}
		?>
    </div>
</div>
<div class="form-group m-form__group row">
    <label for="asot" class="col-2 col-form-label">
        ASOT:
    </label>
	<div class="col-3">
		<?php
			if($dataReader[sr_asot] === '0'){
				echo '<input class="form-control m-input" type="text" value="> 200 IU/Ml" readonly>';
			}
			else if($dataReader[sr_asot] === '1'){
				echo '<input class="form-control m-input" type="text" value="<  200 IU/Ml" readonly>';
			}
		?>
    </div>
    <label for="toxoplasma" class="col-3 col-form-label">
        TOXOPLASMA:
    </label>
	<div class="col-3">
		<?php
			if($dataReader[sr_toxo] === '0'){
				echo '<input class="form-control m-input" type="text" value="Postive" readonly>';
			}
			else if($dataReader[sr_toxo] === '1'){
				echo '<input class="form-control m-input" type="text" value="Negative" readonly>';
			}
		?>
    </div>
</div>
<div class="m-section">
    <h3 class="m-section__heading text-center">
        Brucella Anti Body
    </h3>
</div>
<div class="form-group m-form__group row">
    <label for="melitensis" class="col-2 col-form-label">
        MELITENSIS:
    </label>
	<div class="col-3">
		<?php
			if($dataReader[sr_meli] === '0'){
				echo '<input class="form-control m-input" type="text" value="Postive" readonly>';
			}
			else if($dataReader[sr_meli] === '1'){
				echo '<input class="form-control m-input" type="text" value="Negative" readonly>';
			}
		?>
    </div>
    <label for="abortus" class="col-3 col-form-label">
        ABORTUS:
    </label>
	<div class="col-3">
		<?php
			if($dataReader[sr_abor] === '0'){
				echo '<input class="form-control m-input" type="text" value="Postive" readonly>';
			}
			else if($dataReader[sr_abor] === '1'){
				echo '<input class="form-control m-input" type="text" value="Negative" readonly>';
			}
		?>
    </div>
</div>