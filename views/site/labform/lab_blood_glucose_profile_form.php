<h3 class="m-portlet__head-text text-center">LABORATORY REPORT</h3>
<h4 class="m-portlet__head-text text-center">Blood Glucose Profile</h4>
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
            <th style="border: none;"></th>
            <th style="border: none;"></th>
            <th>SI UNITS</th>
            <th colspan="2">CONVERSION UNITS</th>
        </tr>
        <tr>
            <th>INVESTIGATION</th>
            <th>RESULT</th>
            <th>CUT OF VALUE</th>
            <th>RESULT</th>
            <th>CUT OF VALUE</th>
        </tr>
        <tr>
            <td>Plasma Glucose (Fasting)</td>
            <td><?= $dataReader[pgf_cu_result] ?></td>
            <td>3.3-5.5 mmol/l</td>
            <td><?= $dataReader[pgf_si_result] ?></td>
            <td>60-104mg/dl</td>
        </tr>
        <tr>
            <td>Plasma Glucose(2 Hour ABF)</td>
            <td><?= $dataReader[pgr_cu_result] ?></td>
            <td>3.3–7.8mmol/l</td>
            <td><?= $dataReader[pgr_si_result] ?></td>
            <td>60-140mg/dl</td>
        </tr>
        <tr>
            <td>Plasma Glucose(Random)</td>
            <td><?= $dataReader[pg_abf_cu_result] ?></td>
            <td>3.3 – 10.3mmol/l</td>
            <td><?= $dataReader[pg_abf_si_result] ?></td>
            <td>60-185mg/dl</td>
        </tr>
    </table>
</div>