<h3 class="m-portlet__head-text text-center">LABORATORY REPORT</h3>
<h4 class="m-portlet__head-text text-center">Renal Function Test</h4>
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
    <table class="table table-bordered" style="width: 100%;">
        <tr>
            <th>SI UNITS</th>
            <th style="border: none;"></th>
            <th style="border: none;"></th>
            <th colspan="2">CONVERSION UNITS</th>
        </tr>
        <tr>
            <th>Investigation</th>
            <th>Result</th>
            <th>Cut of Value</th>
            <th>Result</th>
            <th>Cut of Value</th>
        </tr>
        <tr>
            <td>Serum Urea</td>
            <td><?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[su_si_result].'" readonly>'; ?>
            <td>3.3-6.7mmol/l</td>
            <td><?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[su_cu_result].'" readonly>'; ?></td>
            <td>20-40mg/dl</td>
        </tr>
        <tr>
            <td>Serum Creatinine</td>
            <td><?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[sc_si_result].'" readonly>'; ?></td>
            <td>Male 69-114mmol/l<br>Female 53-104 mmol/l</td>
            <td><?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[sc_cu_result].'" readonly>'; ?></td>
            <td>Male 0.9-1.5mg/dl<br>Female 0.7-1.37mg/dl</td>
        </tr>
        <tr>
            <td>Serum Sodium</td>
            <td><?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[ss_si_result].'" readonly>'; ?></td>
            <td>136-149mmol/l</td>
            <td><?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[ss_cu_result].'" readonly>'; ?></td>
            <td>Same</td>
        </tr>
        <tr>
            <td>Serum Potassium</td>
            <td><?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[sp_si_result].'" readonly>'; ?></td>
            <td>3.5-5.0 mmol/l</td>
            <td><?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[sp_cu_result].'" readonly>'; ?></td>
            <td>Same</td>
        </tr>
    </table>
</div>