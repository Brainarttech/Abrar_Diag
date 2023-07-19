<h3 class="m-portlet__head-text text-center">LABORATORY REPORT</h3>
<h4 class="m-portlet__head-text text-center">BLOOD LIPID PROFILE</h4>
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
    </select>
</div>
<div class="table-responsive"> 
    <table class="table table-bordered" style="width: 100%;">
        <tr>
            <th>INVESTIGATION</th>
            <th>RESULT</th>
            <th>Reference Range</th>
            <th>RESULT</th>
            <th>Reference Range</th>
        </tr>
        <tr>
            <td>Serum cholesterol</td>
            <td>
				<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[lp_se_cho_bf].'" readonly>'; ?>
			</td>
            <td>Desirable &lt;5.2 mmol/l <br>Borderline &lt;5.2-6 mmol/l <br> High Risk &gt;6.2 mmol/l</td>
            <td>
				<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[lp_se_cho_af].'" readonly>'; ?>
			</td>
            <td>Desirable &lt;200 mg/dl <br> Borderline &lt;200-239 mg/dl <br> High Risk &gt;240 mg/dl</td>
        </tr>
        <tr>
            <td>serum HDL cholesterol</td>
            <td>
				<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[lp_se_hdl_cho_bf].'" readonly>'; ?>
			</td>
            <td>&lt;1.04mmol/l</td>
            <td>
				<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[lp_se_hdl_cho_af].'" readonly>'; ?>
			</td>
            <td>&lt;40 mg/dl</td>
        </tr>
        <tr>
            <td>Serum Triglyceride</td>
            <td>
				<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[lp_se_tri_bf].'" readonly>'; ?>
			</td>
            <td>Male 0.45 ------- 2.7 mmol/l<br>Female 0.34 ------ 2.15 mmol/l</td>
            <td>
				<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[lp_se_tri_af].'" readonly>'; ?>
			</td>
            <td>Male 40 ------- 240 mg/dl<br>Female 30 ------ 190 mg/dl</td>
        </tr>
        <tr>
            <td>L.D.L cholesterol</td>
            <td>
				<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[lp_ldl_cho_bf].'" readonly>'; ?>
			</td>
            <td>Up to 4.1 mmol/l</td>
            <td>
				<?php echo '<input class="form-control m-input" type="text" value="'.$dataReader[lp_ldl_cho_af].'" readonly>'; ?>
			</td>
            <td>Up to 160 mg/dl</td>
        </tr>
    </table>
</div>