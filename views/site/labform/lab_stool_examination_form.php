<h3 class="m-portlet__head-text text-center">LABORATORY REPORT</h3>
<h3 class="m-portlet__head-text text-center">Stool  RE</h3>
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
<hr>				
<h3 class="m-portlet__head-text text-center">Physical Examination</h3>
<div class="form-group m-form__group row">
    <label for="color" class="col-3 offset-1 col-form-label">
        Colour:
    </label>
    <div class="col-3">
        <?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[color].'" readonly>'; ?>
    </div>
</div>
<div class="form-group m-form__group row">
    <label for="consistency" class="col-3 offset-1 col-form-label">
        Consistency:
    </label>
    <div class="col-3">
        <?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[consistency].'" readonly>'; ?>
    </div>
</div>
<div class="form-group m-form__group row">
    <label for="ph" class="col-3 offset-1 col-form-label">
        PH:
    </label>
    <div class="col-3">
        <?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[ph].'" readonly>'; ?>
    </div>
</div>
<div class="form-group m-form__group row">
    <label for="mucous" class="col-3 offset-1 col-form-label">
        Mucous:
    </label>
    <div class="col-3">
        <?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[mucous].'" readonly>'; ?>
    </div>
</div>
<div class="form-group m-form__group row">
    <label for="blood" class="col-3 offset-1 col-form-label">
        Blood:
    </label>
    <div class="col-3">
        <?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[blood].'" readonly>'; ?>
    </div>
</div>
<hr>
<h3 class="m-portlet__head-text text-center">Microscopic Examination</h3>
<div class="form-group m-form__group row">
    <label for="cysts" class="col-3 offset-1 col-form-label">
        Cysts:
    </label>
    <div class="col-3">
        <?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[cysts].'" readonly>'; ?>
    </div>
</div>
<div class="form-group m-form__group row">
    <label for="ova" class="col-3 offset-1 col-form-label">
        Ova:
    </label>
    <div class="col-3">
        <?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[ova].'" readonly>'; ?>
    </div>
</div>
<div class="form-group m-form__group row">
    <label for="puscells" class="col-3 offset-1 col-form-label">
        Pus Cells:
    </label>
    <div class="col-3">
        <?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[pus_cells].'" readonly>'; ?>
    </div>
</div>
<div class="form-group m-form__group row">
    <label for="rbcs" class="col-3 offset-1 col-form-label">
        RBC's:
    </label>
    <div class="col-3">
        <?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[rbcs].'" readonly>'; ?>
    </div>
</div>