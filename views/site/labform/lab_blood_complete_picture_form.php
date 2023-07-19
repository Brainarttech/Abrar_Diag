<h3 class="m-portlet__head-text" style="text-align: center;">Blood Complete Picture</h3>
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
    <label for="tlc" class="col-1 col-form-label">
        TLC:
    </label>

    <div class="col-2">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[tlc].'" readonly>'; ?>
    </div>

    <label for="power" class="col-1 col-form-label">
        10<sup>^3</sup>/mm<sup>^3</sup>
    </label>

    <label for="value" class="col-2 col-form-label">
        (4.5--10.5)
    </label>

    <label for="mcv" class="col-1 col-form-label">
        MCV:
    </label>

    <div class="col-2">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[mcv].'" readonly>'; ?>
    </div>

    <div class="col-1">
        fl
    </div>

    <label for="value" class="col-2 col-form-label">
         (76--96)
    </label>
</div>
<div class="form-group m-form__group row">
    <label for="rbc" class="col-1 col-form-label">
        RBC:
    </label>

    <div class="col-2">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[rbc].'" readonly>'; ?>
    </div>

    <label for="power" class="col-1 col-form-label">
        10<sup>^6</sup>/mm<sup>^3</sup>
    </label>

    <label for="value" class="col-2 col-form-label">
        (3.80--6.50)
    </label>

    <label for="mch" class="col-1 col-form-label">
        MCH:
    </label>

    <div class="col-2">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[mch].'" readonly>'; ?>
    </div>

    <div class="col-1">
        p g
    </div>

    <label for="value" class="col-2 col-form-label">
         (27.0--32.0)
    </label>
</div>
<div class="form-group m-form__group row">
    <label for="hb" class="col-1 col-form-label">
        HB:
    </label>

    <div class="col-2">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[hb].'" readonly>'; ?>
    </div>

    <label for="value" class="col-1 col-form-label">
        g/dl
    </label>

    <label for="value" class="col-2 col-form-label">
        (11.5--17.5)
    </label>

    <label for="mchc" class="col-1 col-form-label">
        MCHC:
    </label>

    <div class="col-2">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[mchc].'" readonly>'; ?>
    </div>

    <div class="col-1">
        g/dl
    </div>

    <label for="value" class="col-2 col-form-label">
         (30.0--35.0)
    </label>
</div>
<div class="form-group m-form__group row">
    <label for="hct" class="col-1 col-form-label">
        HCT:
    </label>

    <div class="col-2">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[hct].'" readonly>'; ?>
    </div>

    <label for="percentage" class="col-1 col-form-label">
        %
    </label>

    <label for="value" class="col-2 col-form-label">
        (36.0--52.0)
    </label>

    <label for="rdwc" class="col-1 col-form-label">
        RDWc:
    </label>

    <div class="col-2">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[rdwc].'" readonly>'; ?>
    </div>

    <div class="col-1">
        %
    </div>

    <label for="value" class="col-2 col-form-label">
    </label>
</div>
<div class="form-group m-form__group row">
    <label for="plt" class="col-1 col-form-label">
        PLT:
    </label>

    <div class="col-2">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[plt].'" readonly>'; ?>
    </div>

    <label for="power" class="col-1 col-form-label">
        10<sup>^3</sup>/mm<sup>^3</sup>
    </label>

    <label for="value" class="col-2 col-form-label">
        (150--450)
    </label>

    <label for="value" class="col-1 col-form-label">
    </label>

    <div class="col-2">
    </div>

    <div class="col-1">
    </div>

    <label for="value" class="col-2 col-form-label">
    </label>
</div>
<div class="form-group m-form__group row">
    <div class="col-6">
        <h3 class="m-portlet__head-text" style="text-align: center;">Differential Leucocyte Count</h3>
    </div>
    <div class="col-6">
        <h3 class="m-portlet__head-text" style="text-align: center;">Absolute</h3>
    </div>
</div>
<div class="form-group m-form__group row">
    <label for="dllneu" class="offset-1 col-form-label">
        NEU:
    </label>

    <div class="col-2">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[dll_neu].'" readonly>'; ?>
    </div>

    <label for="percentage" class="col-form-label">
        %
    </label>

    <label for="value" class="col-2 col-form-label text-center">
        (40.0--70.0)
    </label>

    <label for="abneu" class="col-form-label">
        #NEU:
    </label>

    <div class="col-2">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[ab_neu].'" readonly>'; ?>
    </div>

    <div class="col-1">
        10<sup>^3</sup>/mm<sup>^3</sup>
    </div>

    <label for="value" class="col-2 col-form-label text-center">
        (1.5--7.5)
    </label>
</div>
<div class="form-group m-form__group row">
    <label for="dlllym" class="offset-1 col-form-label">
        LYM:
    </label>

    <div class="col-2">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[dll_lym].'" readonly>'; ?>
    </div>

    <label for="percentage" class="col-form-label">
        %
    </label>

    <label for="value" class="col-2 col-form-label text-center">
        (20.0--40.0)
    </label>

    <label for="ablym" class="col-form-label">
        #LYM:
    </label>

    <div class="col-2">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[ab_lym].'" readonly>'; ?>
    </div>

    <div class="col-1">
        10<sup>^3</sup>/mm<sup>^3</sup>
    </div>

    <label for="value" class="col-2 col-form-label text-center">
        (0.8--4.4)
    </label>
</div>
<div class="form-group m-form__group row">
    <label for="dlleos" class="offset-1 col-form-label">
        EOS:
    </label>

    <div class="col-2">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[dll_eos].'" readonly>'; ?>
    </div>

    <label for="percentage" class="col-form-label">
        %
    </label>

    <label for="value" class="col-2 col-form-label text-center">
        (1.0--5.0)
    </label>

    <label for="abeos" class="col-form-label">
        #EOS:
    </label>

    <div class="col-2">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[ab_eos].'" readonly>'; ?>
    </div>

    <div class="col-1">
        10<sup>^3</sup>/mm<sup>^3</sup>
    </div>

    <label for="value" class="col-2 col-form-label text-center">
        (0.04--0.4)
    </label>
</div>
<div class="form-group m-form__group row">
    <label for="dllmon" class="offset-1 col-form-label">
        MON:
    </label>

    <div class="col-2">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[dll_mon].'" readonly>'; ?>
    </div>

    <label for="percentage" class="col-form-label">
        %
    </label>

    <label for="value" class="col-2 col-form-label text-center">
        (2.0--8.0)
    </label>

    <label for="abmon" class="col-form-label">
        #MON:
    </label>

    <div class="col-2">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[ab_mon].'" readonly>'; ?>
    </div>

    <div class="col-1">
        10<sup>^3</sup>/mm<sup>^3</sup>
    </div>

    <label for="value" class="col-2 col-form-label text-center">
        (0.1--0.9)
    </label>
</div>
<div class="form-group m-form__group row">
    <label for="" class="offset-1 col-form-label">
        Results Generated From DIATRON  [Fully automated Haematology Anlyzer]
    </label>
</div>
<div class="form-group m-form__group row">
    <label for="esr" class="offset-1 col-form-label">
        ESR
    </label>

    <div class="col-2">
		<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[esr].'" readonly>'; ?>
    </div>

    <label for="paragraph" class="col-form-label">
        mm/1st hour.(WESTERGREN) [ Male 1-14 Female 3--20]
    </label>
</div>