<h3 class="m-portlet__head-text text-center">LABORATORY REPORT</h3>
<h3 class="m-portlet__head-text text-center">Fluid Re</h3>
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
    <div class="col-6">
        <div class="form-group m-form__group row">
            <label for="appearanceone" class="col-4 col-form-label">
                Appearance:
            </label>
            <div class="col-8">
				<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[appearanceone].'" readonly>'; ?>
            </div>
        </div>
        <div class="form-group m-form__group row">
            <label for="appearancetwo" class="col-4 col-form-label">
            </label>
            <div class="col-8">
				<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[appearancetwo].'" readonly>'; ?>
            </div>
        </div>
    </div>
    <div class="col-6">
        <label for="deposit" class="col-2 col-form-label"> <!--  offset-2 -->
            Deposit:
        </label>
    </div>
</div>
<div class="form-group m-form__group row">
    <label for="rivaltatest" class="col-2 col-form-label">
        Rivalta Test:
    </label>
    <div class="col-3">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[riv_test].'" readonly>'; ?>
    </div>
    <label for="leshman" class="col-3 col-form-label">
        Leshman:
    </label>
    <div class="col-3">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[lesh_man].'" readonly>'; ?>
    </div>
</div>
<div class="form-group m-form__group row">
    <label for="specificgravity" class="col-2 col-form-label">
        Specific Gravity:
    </label>
    <div class="col-3">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[spec_gra].'" readonly>'; ?>
    </div>
    <label for="gramstain" class="col-3 col-form-label">
        Gram Stain:
    </label>
    <div class="col-3">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[gram_st].'" readonly>'; ?>
    </div>
</div>
<div class="form-group m-form__group row">
    <label for="totalcellcount" class="col-2 col-form-label">
        Total Cell Count:
    </label>
    <div class="col-3">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[total_cc].'" readonly>'; ?>
    </div>
    <label for="znstain" class="col-3 col-form-label">
        Z N Stain:
    </label>
    <div class="col-3">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[zn_stain].'" readonly>'; ?>
    </div>
</div>
<div class="m-section">
    <h3 class="m-section__heading text-center">
        Protein:   56 g/l      20 - 40 g/l
    </h3>
</div>
<div class="m-section">
    <h3 class="m-section__heading text-center">
        Protein    5.6 g/dl      2.0 - 4.0 g/dl
    </h3>
</div>