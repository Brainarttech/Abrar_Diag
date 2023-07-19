<h3 class="m-portlet__head-text text-center">LABORATORY REPORT</h3>
<h4 class="m-portlet__head-text text-center">Lever Function Test</h4>
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
            <td>Serum Bilirubin</td>
			<td><?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[sb_si_result].'" readonly>'; ?></td>
            <td>4-17 Umol/l</td>
			<td><?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[sb_cu_result].'" readonly>'; ?></td>
            <td>0.2-1.2 mg/dl</td>
        </tr>
        <tr>
            <td>Serum Alkaline Phosphate</td>
			<td><?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[sap_si_result].'" readonly>'; ?></td>
            <td>Adults: 73-201 I/U <br>Children: 185-575 I/U</td>
            <td>Same</td>
            <td>Same</td>
        </tr>
        <tr>
            <td>Serum SGPT/ALT</td>
			<td><?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[ssa_si_result].'" readonly>'; ?></td>
            <td>Upto 40 U/I</td>
            <td>Same</td>
            <td>Same</td>
        </tr>
        <tr>
            <td>Serum Total Protein</td>
			<td><?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[stp_si_result].'" readonly>'; ?></td>
            <td>65-84 g/l</td>
			<td><?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[stp_cu_result].'" readonly>'; ?></td>
            <td>6.5-8.4 g/dl</td>
        </tr>
    </table>
</div>