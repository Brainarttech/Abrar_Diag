<h3 class="m-portlet__head-text text-center">LABORATORY REPORT</h3>
<h4 class="m-portlet__head-text text-center">Urine Routine Examination</h4>
<div class="form-group m-form__group row">
    <label for="natureofspecimen" class="col-2 offset-2 col-form-label">
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
    <label for="appearence" class="col-2 offset-2 col-form-label">
        APPEARENCE:
    </label>
    <div class="col-4">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[appearence].'" readonly>'; ?>
    </div>
</div>
<div class="form-group m-form__group row">
    <label for="turbidity" class="col-2 offset-2 col-form-label">
        TURBIDITY:
    </label>
    <div class="col-4">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[turbidity].'" readonly>'; ?>
    </div>
</div>
<div class="form-group m-form__group row">
    <label for="spgravity" class="col-2 offset-2 col-form-label">
        SP.GRAVITY:
    </label>
    <div class="col-4">
	<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[sp_gravity].'" readonly>'; ?>
    </div>
</div>
<div class="form-group m-form__group row">
    <label for="ph" class="col-2 offset-2 col-form-label">
        PH:
    </label>
    <div class="col-4">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[ph].'" readonly>'; ?>
    </div>
</div>
<div class="form-group m-form__group row">
    <label for="protein" class="col-2 offset-2 col-form-label">
        PROTEIN:
    </label>
    <div class="col-4">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[protein].'" readonly>'; ?>
    </div>
</div>
<div class="form-group m-form__group row">
    <label for="sugar" class="col-2 offset-2 col-form-label">
        SUGAR:
    </label>
    <div class="col-4">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[sugar].'" readonly>'; ?>
    </div>
</div>
<div class="form-group m-form__group row">
    <label for="bilesalt" class="col-2 offset-2 col-form-label">
        Bile Salt:
    </label>
    <div class="col-4">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[bile_salt].'" readonly>'; ?>
    </div>
</div>
<div class="form-group m-form__group row">
    <label for="bilepigment" class="col-2 offset-2 col-form-label">
        Bile Pigment:
    </label>
    <div class="col-4">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[bile_pigment].'" readonly>'; ?>
    </div>
</div>
<div class="form-group m-form__group row">
    <label for="microscopy" class="col-2 offset-2 col-form-label">
        MICROSCOPY:
    </label>
    <div class="col-4">
        <div class="form-group m-form__group row">
            <label for="rbcs" class="col-4 col-form-label">
                RBC's:
            </label>
            <div class="col-8">
				<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[m_rbc].'" readonly>'; ?>
            </div>
        </div>
        <div class="form-group m-form__group row">
            <label for="wbcspuscells" class="col-4 col-form-label">
                WBC's/Pus Cells:
            </label>
            <div class="col-8">
				<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[m_wbs].'" readonly>'; ?>
            </div>
        </div>
        <div class="form-group m-form__group row">
            <label for="casts" class="col-4 col-form-label">
                Casts:
            </label>
            <div class="col-8">
				<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[m_costs].'" readonly>'; ?>
            </div>
        </div>
        <div class="form-group m-form__group row">
            <label for="crystals" class="col-4 col-form-label">
                Crystals:
            </label>
            <div class="col-8">
				<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[m_crystals].'" readonly>'; ?>
            </div>
        </div>
        <div class="form-group m-form__group row">
            <label for="others" class="col-4 col-form-label">
                Others:
            </label>
            <div class="col-8">
				<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[m_other].'" readonly>'; ?>
            </div>
        </div>
    </div>
</div>