<h3 class="m-portlet__head-text text-center">LABORATORY REPORT</h3>
<h4 class="m-portlet__head-text text-center">CARDIAC ENZYMES</h4>
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
<div class="table-responsive">
    <table class="table table-bordered" style="width:100%">
        <tr>
            <th>Investigation</th>
            <th>Result</th> 
            <th>Normal Value</th>
        </tr>
        <tr>
            <td>Serum ASAT(GOT)</td>
            <td>
                <?php echo '<input class="form-control m-input col-9" style="display: inline-block;" type="text" value="'.$dataReader[serum_asat_got].'" readonly>'; ?>
                <label class="col-2">U/L</label>
            </td>
            <td>MEN ....UP TO 37 U/L<br>WOMEN ....UP TO 31 U/L</td>
        </tr>
        <tr>
            <td>Serum L.D.H</td>
            <td>
                <?php echo '<input class="form-control m-input col-9" style="display: inline-block;" type="text" value="'.$dataReader[serum_ldh].'" readonly>'; ?>
                <label class="col-2">U/L</label>
            </td>
            <td>230....460 U/L</td>
        </tr>
        <tr>
            <td>Serum C.P.K</td>
            <td>
                <?php echo '<input class="form-control m-input col-9" style="display: inline-block;" type="text" value="'.$dataReader[serum_cpk].'" readonly>'; ?>
                <label class="col-2">U/L</label>
            </td>
            <td>Up to 165 U/L</td>
        </tr>
    </table>
</div>