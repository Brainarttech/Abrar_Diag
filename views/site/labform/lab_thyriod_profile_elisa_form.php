<h3 class="m-portlet__head-text text-center">LABORATORY REPORT</h3>
<h4 class="m-portlet__head-text text-center">Special  Chemistry</h4>
<div class="form-group m-form__group row">
    <label for="natureofspecimen" class="col-3 offset-2 col-form-label">
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
<div class="table table-bordered" style="width:100%">
    <table style="width:100%">
        <tr>
            <th>Test Name</th>
            <th>Result</th>
            <th>Normal  Rage </th>
            <th>Unit</th>
        </tr>
        <tr>
            <td>T3</td>
            <td>
				<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[t3].'" readonly>'; ?>
            </td>
            <td>1.1 - 2.8</td>
            <td>ng/mL</td>
        </tr>
        <tr>
            <td>T4</td>
            <td>
				<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[t4].'" readonly>'; ?>
            </td>
            <td>8.0-24.0</td>
            <td>Ug/dll</td>
        </tr>
        <tr>
            <td>TSH</td>
            <td>
				<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[tsh].'" readonly>'; ?>
            </td>
            <td>0.4-4.0</td>
            <td>uiU/ml</td>
        </tr>
    </table>
</div>