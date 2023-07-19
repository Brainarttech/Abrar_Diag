<h3 class="m-portlet__head-text" style="text-align: center;">LABORATORY REPORT</h3>
<h4 class="m-portlet__head-text text-center">Semen analysis</h4>
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
    <label for="appearance" class="col-2 col-form-label">
        APPEARANCE:
    </label>
	<?php echo '<input class="form-control m-input col-3" type="text" value="'.$dataReader[app].'" readonly>'; ?>
    <label for="volume" class="col-3 col-form-label">
        VOLUME:
    </label>
    <?php echo '<input class="form-control m-input col-3" type="text" value="'.$dataReader[vol].'" readonly>'; ?>
</div>
<div class="form-group m-form__group row">
    <label for="method" class="col-2 col-form-label">
        METHOD:
    </label>
    <?php echo '<input class="form-control m-input col-3" type="text" value="'.$dataReader[meth].'" readonly>'; ?>
    <label for="viscocity" class="col-3 col-form-label">
        VISCOCITY:
    </label>
    <?php echo '<input class="form-control m-input col-3" type="text" value="'.$dataReader[visco].'" readonly>'; ?>
</div>
<div class="form-group m-form__group row">
    <label for="spermcount" class="col-2 col-form-label">
        SPERM COUNT:
    </label>
    <?php echo '<input class="form-control m-input col-3" type="text" value="'.$dataReader[sp_co].'" readonly>'; ?>
    <label for="antineuclearantibodies" class="col-6 col-form-label">
        Million / ml(Normal60---120million/ml)
    </label>
</div>
<div class="form-group m-form__group row">
    <label for="ph" class="col-2 col-form-label">
        PH:
    </label>
    <?php echo '<input class="form-control m-input col-3" type="text" value="'.$dataReader[ph].'" readonly>'; ?>
</div>
<hr>
<div class="table-responsive">
    <table class="table table-bordered" style="width: 100%;">
        <tr>
            <th>Time</th>
            <th>Fully Active</th>
            <th>Sulggish</th>
            <th>Dead</th>
        </tr>
        <tr>
            <td>After 15 Minute</td>
            <td>
				<?php echo '<input class="form-control m-input col-11" style="display: inline-block;" type="text" value="'.$dataReader[fa_15m].'" readonly>'; ?>
                <label>%</label>
            </td>
            <td>
				<?php echo '<input class="form-control m-input col-11" style="display: inline-block;" type="text" value="'.$dataReader[sul_15m].'" readonly>'; ?>
                <label>%</label>
            </td>
            <td>
				<?php echo '<input class="form-control m-input col-11" style="display: inline-block;" type="text" value="'.$dataReader[d_15m].'" readonly>'; ?>
                <label>%</label>
            </td>
        </tr>
        <tr>
            <td>After 1 Hour</td>
            <td>
				<?php echo '<input class="form-control m-input col-11" style="display: inline-block;" type="text" value="'.$dataReader[fa_1h].'" readonly>'; ?>
                <label>%</label>
            </td>
            <td>
				<?php echo '<input class="form-control m-input col-11" style="display: inline-block;" type="text" value="'.$dataReader[sul_1h].'" readonly>'; ?>
                <label>%</label>
            </td>
            <td>
				<?php echo '<input class="form-control m-input col-11" style="display: inline-block;" type="text" value="'.$dataReader[d_1h].'" readonly>'; ?>
                <label>%</label>
            </td>
        </tr>
        <tr>
            <td>After 3 Hour</td>
            <td>
				<?php echo '<input class="form-control m-input col-11" style="display: inline-block;" type="text" value="'.$dataReader[fa_3h].'" readonly>'; ?>
                <label>%</label>
            </td>
            <td>
				<?php echo '<input class="form-control m-input col-11" style="display: inline-block;" type="text" value="'.$dataReader[sul_3h].'" readonly>'; ?>
                <label>%</label>
            </td>
            <td>
				<?php echo '<input class="form-control m-input col-11" style="display: inline-block;" type="text" value="'.$dataReader[d_3h].'" readonly>'; ?>
                <label>%</label>
            </td>
        </tr>
        <tr>
            <td>After 6 Hour</td>
            <td>
				<?php echo '<input class="form-control m-input col-11" style="display: inline-block;" type="text" value="'.$dataReader[fa_6h].'" readonly>'; ?>
                <label>%</label>
            </td>
            <td>
				<?php echo '<input class="form-control m-input col-11" style="display: inline-block;" type="text" value="'.$dataReader[sul_6h].'" readonly>'; ?>
                <label>%</label>
            </td>
            <td>
				<?php echo '<input class="form-control m-input col-11" style="display: inline-block;" type="text" value="'.$dataReader[d_6h].'" readonly>'; ?>
                <label>%</label>
            </td>
        </tr>
    </table>
</div>
<div class="form-group m-form__group row">
    <label for="othmic" class="col-2 col-form-label">
        Other Microscopy:
    </label>
	<?php echo '<input class="form-control m-input col-3" type="text" value="'.$dataReader[oth_mic].'" readonly>'; ?>
</div>
<div class="form-group m-form__group row">
    <label for="opinion" class="col-2 col-form-label">
        Opinion:
    </label>
	<?php echo '<input class="form-control m-input col-3" type="text" value="'.$dataReader[opinion].'" readonly>'; ?>
</div>