<h3 class="m-portlet__head-text text-center">LABORATORY REPORT</h3>
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
    <label for="asotiter" class="col-3 offset-1 col-form-label">
        A.S.O.Titer:
    </label>
    <div class="col-3">
        <?php
            echo '<input class="form-control m-input" type="text" value="'.$dataReader[asotiter].'" readonly>';
        ?>
    </div>
    <!-- <label for="antineuclearantibodies" class="col-3 col-form-label">
        Anti Neuclear Antibodies:
    </label> -->
    <div class="col-3">
    <?php
        if($dataReader[asotiter_status] === '0'){
            echo '<input class="form-control m-input" type="text" value="Postive" readonly>';
        }
        else if($dataReader[asotiter_status] === '1'){
            echo '<input class="form-control m-input" type="text" value="Negative" readonly>';
        }
        else if($dataReader[asotiter_status] === '2'){
            echo '<input class="form-control m-input" type="text" value="IU/ML" readonly>';
        }
    ?>
    </div>
</div>

<div class="m-section">
    <h3 class="m-section__heading text-center">
        Normal Value Less Than 200 IU/M
    </h3>
</div>
