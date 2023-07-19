<?php
use yii\helpers\Url;

//$baseUrl = Yii::$app->homeUrl;

//echo $baseUrl."labform/paper.css";
//echo Url::base(true)."labform/paper.css"; 
/*echo '<pre>';
echo print_r($data);
echo '</pre>';

echo '<pre>';
echo print_r($dataReader);
echo '</pre>';

echo '<pre>';
echo print_r($option_items);
echo '</pre>';

echo '<pre>';
echo print_r($extra_charges);
echo '</pre>';*/

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title><?= $dataReader[0][lab_test_name] ?></title>

  <!-- Normalize or reset CSS with your favorite library -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css"> -->

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="<?= Url::base(true).'/labform/paper.css' ?>">
  <!-- <link rel="stylesheet" href="paper.css"> -->

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>@page { size: A4 }</style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-30mm">

    <!-- Write HTML just like a web page -->
    <!-- <article>This is an A4 document.</article> -->
	<div class="box">
		<div class="row">
			NAME: <input class="medium" type="text" name="name" value="<?= $data->sale->patient->name?>">
			AGE: <input class="ex-small" type="text" name="age" value="<?= $data->sale->patient->age?>">
			ID: <input class="ex-small" type="text" name="id" value="<?= $data->sale->invoice_no ?>">
			SEX: <input class="ex-small" type="text" name="sex" value="<?= $data->sale->patient->gender?>">
		</div>
		<div class="row">
			REF BY: <input class="medium" type="text" name="ref-by" value="AL-SHAHBAZ MEDICAL COMPLEX">
			DATE: <input class="ex-small" type="text" name="date" value="<?= \app\helpers\datetime::saleItemDateTime($data->created_on)?>"> <input class="ex-small" type="text" name="nameref" value="#NAME?">
			RS: <input class="ex-small" type="text" name="date" value="<?= $data->item_price ?>">
		</div>
		<div class="row">
			NATURE OF SPECIMEN: <input class="small" type="text" name="nos" value="<?php
			if($dataReader[0][n_o_s] === '0'){
	            echo 'Blood';
	        }
	        else if($dataReader[0][n_o_s] === '1'){
	            echo 'Urine';
	        }
	        else if($dataReader[0][n_o_s] === '2'){
	            echo 'Semen';
	        }
	        else if($dataReader[0][n_o_s] === '3'){
	            echo 'SLIVA';
	        }?>">
			EXAM REQUIRED: <input class="small" type="text" name="exam-required" value="<?= $dataReader[0][lab_test_name] ?>">
		</div>
	</div>

	<?php
		if($dataReader[0][lab_table_name] === 'lab_blood_mp')
		{ // 1

	?>

	<div class="box">
		<h1>BLOOD MP REPORT:</h1>
	</div>
	
	<div class="result" style="width: 70%;">
		<h3> BloodMP: </h3>&emsp;&emsp;<input class="medium" type="text" name="blood-mp" value="<?php
		        if($dataReader[0][blood_mp_status] === '0'){
		            echo 'No MP Seen';
		        }
		        else if($dataReader[0][blood_mp_status] === '1'){
		            echo 'Mt Rings Seen';
		        }
		        else if($dataReader[0][blood_mp_status] === '2'){
		            echo 'Mt Rings & Gametocyte se';
		        }
		        else if($dataReader[0][blood_mp_status] === '3'){
		            echo 'BT Trophozoite seen';
		        }
		    ?>">
		<br>
		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;<input class="medium" type="text" name="patient" value="<?= $dataReader[0][blood_mp_value] ?>">
	</div>

	<?php
		}
		else if($dataReader[0][lab_table_name] === 'lab_blood_lp')
		{ // 2
	?>

	<div class="box">
		<h1>BLOOD LIPID PROFILE:</h1>
	</div>
	
	<table style="width:100%">
		<tr>
			<th>Investigation</th>
			<th>Result</th> 
			<th>Reference Range</th>
			<th>Result</th> 
			<th>Reference Range</th>
		</tr>
		<tr>
			<td> Serum cholesterol </td>
			<td><?= $dataReader[0][lp_se_cho_bf] ?></td>
			<td> Desirable < 5.2 mmol/l <br> Borderline < 5.2-6 mmol/l <br> High Risk > 6.2 mmol/l </td>
			<td><?= $dataReader[0][lp_se_cho_af] ?></td>
			<td> Desirable < 200 mg/dl <br> Borderline < 200-239 mg/dl <br> High Risk > 240 mg/dl </td>
		</tr>
		<tr>
			<td> Serum HDL <br> Cholesterol </td>
			<td><?= $dataReader[0][lp_se_hdl_cho_bf] ?></td>
			<td> < 1.04 mmol/l </td>
			<td><?= $dataReader[0][lp_se_hdl_cho_af] ?></td>
			<td> < 40 mg/dl </td>
		</tr>
		<tr>
			<td> Serum Triglyceride </td>
			<td><?= $dataReader[0][lp_se_tri_bf] ?></td>
			<td> Male 0.45 ---- 2.7 mmol/l <br> Female 0.34 ---- 2.15 mmol/l </td>
			<td><?= $dataReader[0][lp_se_tri_af] ?></td>
			<td> Male 40 ---- 240 mg/dl <br> Female 30 ---- 190 mg/dl </td>
		</tr>
		<tr>
			<td> L.D.L Cholesterol </td>
			<td><?= $dataReader[0][lp_ldl_cho_bf] ?></td>
			<td> Up to 4.1 mmol/l </td>
			<td><?= $dataReader[0][lp_ldl_cho_af] ?></td>
			<td> Up to 160 mg/dl </td>
		</tr>
	</table>

	<?php
		}
		else if($dataReader[0][lab_table_name] === 'lab_blood_gp')
		{ // 3
	?>

	<div class="box">
		<h1>Blood Glucose Profile</h1>
	</div>
	
	<table style="width:100%;border: none;">
		<tr>
			<th style="border: none;"></th>
			<th style="border: none;"></th>
			<th>SI UNITS</th>
			<th colspan="2">CONVERSION UNITS</th>
		</tr>
		<tr>
			<th>INVESTIGATION</th>
			<th>RESULT</th>
			<th>CUT.OF.VALUE</th>
			<th>RESULT</th>
			<th>CUT.OF.VALUE</th>
		</tr>
		<tr>
			<td>Plasma a Glucose (Fasting)</td>
			<td><?= $dataReader[0][pgf_cu_result] ?></td>
			<td> 3.3 - 5.5 mmol/l</td>
			<td><?= $dataReader[0][pgf_si_result] ?></td>
			<td> 60 - 104 mg/dl</td>
		</tr>
		<tr>
			<td>Plasma a Glucose (2 Hour ABF)</td>
			<td><?= $dataReader[0][pgr_cu_result] ?></td>
			<td> 3.3 - 7.8 mmol/l</td>
			<td><?= $dataReader[0][pgr_si_result] ?></td>
			<td> 60- 140 mg/dl</td>
		</tr>
		<tr>
			<td>Plasma a Glucose (Random)</td>
			<td><?= $dataReader[0][pg_abf_cu_result] ?></td>
			<td> 3.3 - 10.3 mmol/l</td>
			<td><?= $dataReader[0][pg_abf_si_result] ?></td>
			<td> 60 - 185 mg/dl</td>
		</tr>
	</table>

	<?php
		}
		else if($dataReader[0][lab_table_name] === 'lab_serology')
		{ // 4
	?>

	<div class="box">
		<h1>Serology Test:</h1>
	</div>
	
	<div>
		<div class="result-right">
			<h3 style="display: inline-block;"> RA FACTOR: </h3><input class="medium" type="text" name="ra-factor" value="<?php
				if($dataReader[0][sr_ra_fac] === '0'){
					echo 'Postive';
				}
				else if($dataReader[0][sr_ra_fac] === '1'){
					echo 'Negative';
				}
			?>"><br>
			<h3 style="display: inline-block;"> ANF: </h3> <input class="medium" type="text" name="anf" value="<?php
				if($dataReader[0][sr_anf] === '0'){
					echo 'Postive';
				}
				else if($dataReader[0][sr_anf] === '1'){
					echo 'Negative';
				}
			?>"><br>
			<h3 style="display: inline-block;"> TOXOPLASMA: </h3> <input class="medium" type="text" name="toxoplasma" value="<?php
				if($dataReader[0][sr_toxo] === '0'){
					echo 'Postive';
				}
				else if($dataReader[0][sr_toxo] === '1'){
					echo 'Negative';
				}
			?>">
		</div>
		<div class="result-left">
			<h3 style="display: inline-block;"> CRP: </h3> <input class="medium" type="text" name="crp" value="<?php
				if($dataReader[0][sr_crp] === '0'){
					echo 'Postive';
				}
				else if($dataReader[0][sr_crp] === '1'){
					echo 'Negative';
				}
			?>"><br>
			<h3 style="display: inline-block;"> VDRL: </h3> <input class="medium" type="text" name="vdrl" value="<?php
				if($dataReader[0][sr_vdrl] === '0'){
					echo 'Postive';
				}
				else if($dataReader[0][sr_vdrl] === '1'){
					echo 'Negative';
				}
			?>"><br>
			<h3 style="display: inline-block;"> ASOT: </h3> <input class="medium" type="text" name="asot" value="<?php
				if($dataReader[0][sr_asot] === '0'){
					echo '> 200 IU/Ml';
				}
				else if($dataReader[0][sr_asot] === '1'){
					echo '<  200 IU/Ml';
				}
			?>">
		</div>
		<div class="clear-both"></div>
	</div>
	
	<h1>Brucella Anti Body</h1>
	<h3 style="display: inline-block;"> MELITENSIS: </h3> <input class="medium" type="text" name="crp" value="<?php
				if($dataReader[0][sr_meli] === '0'){
					echo 'Postive';
				}
				else if($dataReader[0][sr_meli] === '1'){
					echo 'Negative';
				}
			?>"><br>
	<h3 style="display: inline-block;"> ABORTUS: </h3> <input class="medium" type="text" name="vdrl" value="<?php
				if($dataReader[0][sr_abor] === '0'){
					echo 'Postive';
				}
				else if($dataReader[0][sr_abor] === '1'){
					echo 'Negative';
				}
			?>">


	<?php
		}
		else if($dataReader[0][lab_table_name] === 'lab_blood_rh_factor')
		{ // 5
	?>

	<div class="box">
		<h1>LABORATORY REPORT:</h1>
	</div>
	
	<div class="result">
		<h3> Blood Group: </h3><input class="medium" type="text" name="blood-group" value="<?php
        if($dataReader[0][blood_group] === '0'){
            echo 'AYE';
        }
        else if($dataReader[0][blood_group] === '1'){
            echo 'BEE';
        }
        else if($dataReader[0][blood_group] === '2'){
            echo 'AB';
        }
        else if($dataReader[0][blood_group] === '3'){
            echo 'OOO';
        }
		else if($dataReader[0][blood_group] === '4'){
            echo 'A';
        }
		else if($dataReader[0][blood_group] === '5'){
            echo 'B';
        }
		else if($dataReader[0][blood_group] === '6'){
            echo 'AB';
        }
		else if($dataReader[0][blood_group] === '7'){
            echo 'O';
        }
    ?>" readonly><br>
		<h3> Rh Factor: </h3><input class="medium" type="text" name="rh-Factor" value="<?php
        if($dataReader[0][rh_factor] === '0'){
            echo 'Postive';
        }
        else if($dataReader[0][rh_factor] === '1'){
            echo 'Negative';
        }
    ?>" readonly>
	</div>


	<?php
		}
		else if($dataReader[0][lab_table_name] === 'lab_semen_analysis')
		{ // 6
	?>

	<div class="box">
		<h1>SEMEN ANALYSIS:</h1>
	</div>
	
	<div class="result" style="width: 100%;text-align: left;">
		<h3> APPEARANCE: </h3><input class="small" type="text" name="appearance" value="<?= $dataReader[0][app] ?>" readonly>&emsp;&emsp;&emsp;&emsp;
		<h3> VOLUME: </h3><input class="small" type="text" name="volume" value="<?= $dataReader[0][vol] ?>" readonly><br>
		<h3> METHOD: </h3><input class="small" type="text" name="method" value="<?= $dataReader[0][meth] ?>" readonly>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
		<h3> VISCOCITY: </h3><input class="small" type="text" name="viscocity" value="<?= $dataReader[0][visco] ?>" readonly><br>
		<h3> SPERM COUNT: </h3><input class="small" type="text" name="sperm-count" value="<?= $dataReader[0][sp_co] ?>" readonly>Million/ml(Normal60---120million/ml)<br>
		<h3> PH: </h3><input class="small" type="text" name="ph" value="<?= $dataReader[0][ph] ?>" readonly>
	</div>
	
	<table style="width:100%">
		<tr>
			<th>Time</th>
			<th>Fully Active</th>
			<th>Sulggish</th>
			<th>Dead</th>
		</tr>
		<tr>
			<td>After 15 Minute</td>
			<td><?= $dataReader[0][fa_15m] ?>%</td>
			<td><?= $dataReader[0][sul_15m] ?>%</td>
			<td><?= $dataReader[0][d_15m] ?>%</td>
		</tr>
		<tr>
			<td>After 1 Hour</td>
			<td><?= $dataReader[0][fa_1h] ?>%</td>
			<td><?= $dataReader[0][sul_1h] ?>%</td>
			<td><?= $dataReader[0][d_1h] ?>%</td>
		</tr>
		<tr>
			<td>After 3 Hour</td>
			<td><?= $dataReader[0][fa_3h] ?>%</td>
			<td><?= $dataReader[0][sul_3h] ?>%</td>
			<td><?= $dataReader[0][d_3h] ?>%</td>
		</tr>
		<tr>
			<td>After 6 Hour</td>
			<td><?= $dataReader[0][fa_6h] ?>%</td>
			<td><?= $dataReader[0][sul_6h] ?>%</td>
			<td><?= $dataReader[0][d_6h] ?>%</td>
		</tr>
	</table>
	<p style="display: inline-block;">Other Microscopy</p>&emsp;&emsp;<input class="small" type="text" name="microscopy" value="<?= $dataReader[0][oth_mic] ?>" readonly><br>
	<p style="display: inline-block;">Opinion</p>&emsp;&emsp;<input class="small" type="text" name="opinion" value="<?= $dataReader[0][opinion] ?>" readonly>

	<?php
		}
		else if($dataReader[0][lab_table_name] === 'lab_urine_re')
		{ // 7
	?>

	<div class="box">
		<h1>Urine Routine Examination</h1>
	</div>
	
	<div class="result" style="width: 70%;">
		<h3 class="result-left"> APPEARENCE: &emsp;&emsp;</h3><input class="medium result-right input-margin" type="text" name="appearence" value="<?= $dataReader[0][appearence] ?>" readonly><br>
		<div class="clear-both"></div>
		<h3 class="result-left"> TURBIDITY: &emsp;&emsp;</h3><input class="medium result-right input-margin" type="text" name="turbidity" value="<?= $dataReader[0][turbidity] ?>" readonly><br>
		<div class="clear-both"></div>
		<h3 class="result-left"> SP.GRAVITY: &emsp;&emsp;</h3><input class="medium result-right input-margin" type="text" name="sp-gravity" value="<?= $dataReader[0][sp_gravity] ?>" readonly><br>
		<div class="clear-both"></div>
		<h3 class="result-left"> PH: &emsp;&emsp;</h3><input class="medium result-right input-margin" type="text" name="ph" value="<?= $dataReader[0][ph] ?>" readonly><br>
		<div class="clear-both"></div>
		<h3 class="result-left"> PROTEIN: &emsp;&emsp;</h3><input class="medium result-right input-margin" type="text" name="protein" value="<?= $dataReader[0][protein] ?>" readonly><br>
		<div class="clear-both"></div>
		<h3 class="result-left"> SUGAR: &emsp;&emsp;</h3><input class="medium result-right input-margin" type="text" name="sugar" value="<?= $dataReader[0][sugar] ?>" readonly><br>
		<div class="clear-both"></div>
		<h3 class="result-left"> BILE SALT: &emsp;&emsp;</h3><input class="medium result-right input-margin" type="text" name="bile-salt" value="<?= $dataReader[0][bile_salt] ?>" readonly><br>
		<div class="clear-both"></div>
		<h3 class="result-left"> BILE PIGMENT: &emsp;&emsp;</h3><input class="medium result-right input-margin" type="text" name="bile-pigment" value="<?= $dataReader[0][bile_pigment] ?>" readonly><br>
		<div class="clear-both"></div>
		<div>
			<h3 style="float: left;"> MICROSCOPY: &emsp;&emsp;</h3>
			<div style="text-align: right;">
				RBC's <input class="medium input-margin" type="text" name="rbc" value="<?= $dataReader[0][m_rbc] ?>" readonly><br>
				WBC's/Pus Cells <input class="medium" style="margin-top: 5px;" type="text" name="wbc" value="<?= $dataReader[0][m_wbs] ?>" readonly><br>
				Casts <input class="medium" style="margin-top: 5px;" type="text" name="casts" value="<?= $dataReader[0][m_costs] ?>" readonly><br>
				Crystals <input class="medium" style="margin-top: 5px;" type="text" name="crystals" value="<?= $dataReader[0][m_crystals] ?>" readonly><br>
				Other's <input class="medium" style="margin-top: 5px;" type="text" name="other" value="<?= $dataReader[0][m_other] ?>" readonly>
			</div>
		</div>
	</div>

	<?php
		}
		else if($dataReader[0][lab_table_name] === 'lab_blood_hb')
		{ // 8
	?>

	<div class="box">
		<h1>LABORATORY REPORT:</h1>
	</div>
	
	<div class="result" style="width: 82%;margin: 40px auto;">
		<h3> BLOOD HEMOGLOBIN: </h3>&emsp;&emsp;<input class="small" type="text" name="text1" value="<?= $dataReader[0][blood_hemolobin] ?>">&emsp;<input class="ex-small" type="text" name="text2" value="g/dl">
	</div>
	<h3 style="text-align:center;">Normal Value (Male 13.5-18g/dl)&emsp;(Female 11.5-16.5g/dl)</h3>

	<?php
		}
		else if($dataReader[0][lab_table_name] === 'lab_thyriod_profile')
		{ // 9
	?>

	<div class="box">
		<h1>SPECIAL CHEMISTRY:</h1>
	</div>
	
	<table style="width:100%">
		<tr>
			<th>Test Name</th>
			<th>Result</th> 
			<th>Normal Rage</th>
			<th>Unit</th>
		</tr>
		<tr>
			<td>T3</td>
			<td><?= $dataReader[0][t3] ?></td>
			<td>1.1-2.8</td>
			<td>ng/mL</td>
		</tr>
		<tr>
			<td>T4</td>
			<td><?= $dataReader[0][t4] ?></td>
			<td>8.0-24.0</td>
			<td>Ug/dll</td>
		</tr>
		<tr>
			<td>TSH</td>
			<td><?= $dataReader[0][tsh] ?></td>
			<td>0.4-4.0</td>
			<td>uiU/ml</td>
		</tr>
	</table>
	<h3 style="text-align:center;">Test performed on axsym system Abbott (meia)</h3>

	<?php
		}
		else if($dataReader[0][lab_table_name] === 'lab_liver_ft')
		{ // 10
	?>

	<div class="box">
		<h1>LIVER FUNCTION TEST</h1>
	</div>
	
	<table style="width:100%;border: none;">
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
			<td><?= $dataReader[0][sb_si_result] ?></td>
			<td>4-17 Umol/l</td>
			<td><?= $dataReader[0][sb_cu_result] ?></td>
			<td>0.2-1.2 mg/dl</td>
		</tr>
		<tr>
			<td>Serum Alkaline Phosphate</td>
			<td><?= $dataReader[0][sap_si_result] ?></td>
			<td>Adults: 73-201 I/U <br>Children: 185-575 I/U</td>
			<td>Same</td>
			<td>Same</td>
		</tr>
		<tr>
			<td>Serum SGPT/ALT</td>
			<td><?= $dataReader[0][ssa_si_result] ?></td>
			<td>Upto 40 U/I</td>
			<td>Same</td>
			<td>Same</td>
		</tr>
		<tr>
			<td>Serum Total Protein</td>
			<td><?= $dataReader[0][stp_si_result] ?></td>
			<td>65-84 g/l</td>
			<td><?= $dataReader[0][stp_cu_result] ?></td>
			<td>6.5-8.4 g/dl</td>
		</tr>
	</table>

	<?php
		}
		else if($dataReader[0][lab_table_name] === 'lab_hepatitis_b_surface')
		{ // 11
	?>

	<div class="box">
		<h1>LABORATORY REPORT:</h1>
	</div>
	
	<div class="result" style="width: 70%;">
		<h3> Hepatitis "B" Surface Antigen: </h3><input class="medium" type="text" name="patient" value="<?php
        if($dataReader[0][hepatitis_b] === '0'){
            echo 'Postive';
        }
        else if($dataReader[0][hepatitis_b] === '1'){
            echo 'Negative';
        }
    ?>">
	</div>

	<?php
		}
		else if($dataReader[0][lab_table_name] === 'lab_pttk')
		{ //12
	?>

	<div class="box">
		<h1>LABORATORY REPORT:</h1>
	</div>
	<h1 style="text-align:center;">PTTK</h1>
	
	<div class="result">
		<h3> Patient: </h3><input class="medium" type="text" name="patient" value="<?= $dataReader[0][patient] ?>"><br>
		<h3> Control: </h3><input class="medium" type="text" name="control" value="<?= $dataReader[0][control] ?>">
	</div>


	<?php
		}
		else if($dataReader[0][lab_table_name] === 'lab_pregnancy_test')
		{ //13
	?>

	<div class="box">
		<h1>LABORATORY REPORT:</h1>
	</div>
	
	<div class="result">
		<h3> Urine Pregnancy Test: </h3><input class="medium" type="text" name="patient" value="<?php
        if($dataReader[0][pregnancy_test] === '0'){
            echo 'Postive';
        }
        else if($dataReader[0][pregnancy_test] === '1'){
            echo 'Negative';
        }
    ?>">
	</div>

	<?php
		}
		else if($dataReader[0][lab_table_name] === 'lab_elisa_reader')
		{ //14
	?>

	<div class="box">
		<h1>ELISA READER:</h1>
	</div>
	
	<!-- <div class="result">
		<h3> Anti Nuclear Antibodies: </h3><input class="medium" type="text" name="anti-nuclear-antibodies">
	</div> -->
	
	<table style="width:100%">
		<tr>
			<th>Name</th>
			<th>Cut of Value</th>
			<th>O.D</th>
			<th>Result</th>
		</tr>
		<tr>
			<td>Hbs Ag</td>
			<td>1.00</td>
			<td><?= $dataReader[0][hbs_od] ?></td>
			<td><?php
					if($dataReader[0][hbs_result] === '0'){
						echo "Reactive  (+)";
					}
					else if($dataReader[0][hbs_result] === '1'){
						echo "Non Reactive  (-)";
					}
				?></td>
		</tr>
		<tr>
			<td>Hcv</td>
			<td>1.00</td>
			<td><?= $dataReader[0][hcv_od] ?></td>
			<td><?php
					if($dataReader[0][hcv_result] === '0'){
						echo "Reactive  (+)";
					}
					else if($dataReader[0][hcv_result] === '1'){
						echo "Non Reactive  (-)";
					}
				?></td>
		</tr>
	</table>

	<?php
		}
		else if($dataReader[0][lab_table_name] === 'lab_renal_ft')
		{ // 15
	?>

	<div class="box">
		<h1>RENAL FUNCTION TEST</h1>
	</div>
	
	<table style="width:100%;border: none;">
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
			<td><?= $dataReader[0][su_si_result] ?></td>
			<td>3.3-6.7mmol/l</td>
			<td><?= $dataReader[0][su_cu_result] ?></td>
			<td>20-40mg/dl</td>
		</tr>
		<tr>
			<td>Serum Creatinine</td>
			<td><?= $dataReader[0][sc_si_result] ?></td>
			<td>Male 69-114mmol/l<br>Female 53-104 mmol/l</td>
			<td><?= $dataReader[0][sc_cu_result] ?></td>
			<td>Male 0.9-1.5mg/dl<br>Female 0.7-1.37mg/dl</td>
		</tr>
		<tr>
			<td>Serum Sodium</td>
			<td><?= $dataReader[0][ss_si_result] ?></td>
			<td>136-149mmol/l</td>
			<td><?= $dataReader[0][ss_cu_result] ?></td>
			<td>Same</td>
		</tr>
		<tr>
			<td>Serum Potassium</td>
			<td><?= $dataReader[0][sp_si_result] ?></td>
			<td>3.5-5.0 mmol/l</td>
			<td><?= $dataReader[0][sp_cu_result] ?></td>
			<td>Same</td>
		</tr>
	</table>

	<?php
		}
		else if($dataReader[0][lab_table_name] === 'lab_bt_ct')
		{ //16
	?>

	<div class="box">
		<h1>LABORATORY REPORT:</h1>
	</div>
	
	<div class="result" style="width: 100%;text-align: center;">
		<h3> Bleeding Time: </h3><input class="small" type="text" name="appearance" value="<?= $dataReader[0][bt_m] ?>">&emsp;
		<h3> Minutes: </h3><input class="ex-small" type="text" name="volume" value="<?= $dataReader[0][bt_s] ?>">&emsp;
		<h3> Seconds: </h3><br>
		<h3 style="display: block;"> Normal Value Upto 9 Minute </h3><br>
		<h3> Clotting Time: </h3><input class="small" type="text" name="viscocity" value="<?= $dataReader[0][ct_m] ?>">&emsp;
		<h3> Minutes: </h3><input class="ex-small" type="text" name="sperm-count" value="<?= $dataReader[0][ct_s] ?>">&emsp;
		<h3> Seconds: </h3><br>
		<h3 style="display: block;"> Normal Value Upto 11 Minute </h3>
	</div>

	<?php
		}
		else if($dataReader[0][lab_table_name] === 'lab_asot')
		{ //17
	?>

	<div class="box">
		<h1>LABORATORY REPORT:</h1>
	</div>
	
	<h1 style="text-align: center;">ASOT</h1>
	
	<div class="result" style="width: 82%;margin: 40px auto;">
		<h3> A.S.O.Titer: </h3>&emsp;&emsp;<input class="small" type="text" name="text1" value="<?= $dataReader[0][asotiter] ?>">&emsp;<input class="small" type="text" name="text2" value="<?php
        if($dataReader[0][asotiter_status] === '0'){
            echo 'Postive';
        }
        else if($dataReader[0][asotiter_status] === '1'){
            echo 'Negative';
        }
        else if($dataReader[0][asotiter_status] === '2'){
            echo 'IU/ML';
        }
    ?>">
	</div>
	<h3 style="text-align:center;">Normal Value Less Than 200 IU/M</h3>

	<?php
		}
		else if($dataReader[0][lab_table_name] === 'lab_stool_re')
		{ //18
	?>

	<div class="box">
		<h1>LABORATORY REPORT:</h1>
	</div>
	
	<h1 style="text-align: center;">Stool Examination</h1>
	
	<table style="width:100%;text-align: center;border: none;">
		<tr style="border: none;">
			<th style="border: none;">Physical Examination</th>
			<th style="border: none;"></th>
		</tr>
		<tr style="border: none;">
			<td style="border: none;">Colour:</td>
			<td style="border: none;"><input class="medium" type="text" value="<?= $dataReader[0][color] ?>"></td>
		</tr>
		<tr style="border: none;">
			<td style="border: none;">Consistency:</td>
			<td style="border: none;"><input class="medium" type="text" value="<?= $dataReader[0][consistency] ?>"></td>
		</tr>
		<tr style="border: none;">
			<td style="border: none;">PH:</td>
			<td style="border: none;"><input class="medium" type="text" value="<?= $dataReader[0][ph] ?>"></td>
		</tr>
		<tr style="border: none;">
			<td style="border: none;">Mucous:</td>
			<td style="border: none;"><input class="medium" type="text" value="<?= $dataReader[0][mucous] ?>"></td>
		</tr>
		<tr style="border: none;">
			<td style="border: none;">Blood:</td>
			<td style="border: none;"><input class="medium" type="text" value="<?= $dataReader[0][blood] ?>"></td>
		</tr>
	</table>
	<table style="width:100%;text-align: center;border: none;">
		<tr style="border: none;">
			<th style="border: none;">Microscopic Examination</th>
			<th style="border: none;"></th>
		</tr>
		<tr style="border: none;">
			<td style="border: none;">Cysts:</td>
			<td style="border: none;"><input class="medium" type="text" value="<?= $dataReader[0][cysts] ?>"></td>
		</tr>
		<tr style="border: none;">
			<td style="border: none;">Oya:</td>
			<td style="border: none;"><input class="medium" type="text" value="<?= $dataReader[0][ova] ?>"></td>
		</tr>
		<tr style="border: none;">
			<td style="border: none;">Pus Cells:</td>
			<td style="border: none;"><input class="medium" type="text" value="<?= $dataReader[0][pus_cells] ?>"></td>
		</tr>
		<tr style="border: none;">
			<td style="border: none;">RBC's:</td>
			<td style="border: none;"><input class="medium" type="text" value="<?= $dataReader[0][rbcs] ?>"></td>
		</tr>
	</table>

	<?php
		}
		else if($dataReader[0][lab_table_name] === 'lab_vdrl_test')
		{ //19
	?>

	<div class="box">
		<h1>LABORATORY REPORT:</h1>
	</div>
	
	<div class="result">
		<h3> Blood VDRL: </h3><input class="medium" type="text" name="blood-vdrl" value="<?php
        if($dataReader[0][blood_vdrl] === '0'){
            echo 'Postive';
        }
        else if($dataReader[0][blood_vdrl] === '1'){
            echo 'Negative';
        }
    ?>">
	</div>

	<?php
		}
		else if($dataReader[0][lab_table_name] === 'lab_hepatits_c_t')
		{ //20
	?>

	<div class="box">
		<h1>LABORATORY REPORT:</h1>
	</div>
	<h1 style="text-align:center;">HEPATITIS C TEST</h1>
	
	<div class="result" style="width: 70%;">
		<div> <h3> TEST </h3>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<h3> RESULT </h3></div>
		<h3> Anti HCV: </h3>&emsp;&emsp;<input class="medium" type="text" name="patient" value="<?php
        if($dataReader[0][anti_hcv] === '0'){
            echo 'Reactive';
        }
        else if($dataReader[0][anti_hcv] === '1'){
            echo 'Non Reactive';
        }
    ?>">
	</div>
	<h3 style="text-align:center;">(By immunochromatography)</h3>

	<?php
		}
		else if($dataReader[0][lab_table_name] === 'lab_anti_neuclear_antibodies')
		{ //21
	?>

	<div class="box">
		<h1>LABORATORY REPORT:</h1>
	</div>
	
	<div class="result">
		<h3> Anti Nuclear Antibodies: </h3><input class="medium" type="text" name="anti-nuclear-antibodies" value="<?php
	        if($dataReader[0][anti_neuclear_antibodies] === '0'){
	            echo 'Postive';
	        }
	        else if($dataReader[0][anti_neuclear_antibodies] === '1'){
	            echo 'Negative';
	        }
	    ?>">
	</div>

	<?php
		}
		else if($dataReader[0][lab_table_name] === 'lab_serum_uric_acid')
		{ //22
	?>

	<div class="box">
		<h1>LABORATORY REPORT:</h1>
	</div>
	
	<div class="result">
		<h3> SERUM URID ACID: </h3><input class="medium" type="text" name="blood-vdrl" value="<?= $dataReader[0][serum_uric_acid] ?>">mg/dl
		<h3 style="display: block;text-align: center;">Normal Value (MALE) 3.4 - 7.0 mg/dl</h3>
		<h3 style="display: block;text-align: center;">Normal Value (FEMALE) 2.4- 5.7 mg/dl</h3>
	</div>

	<?php
		}
		else if($dataReader[0][lab_table_name] === 'lab_sputum_afb')
		{ //23
	?>

	<div class="box">
		<h1>LABORATORY REPORT:</h1>
	</div>
	
	<h1 style="text-align: center;">SPUTUM AFB</h1>
	
	<div class="result" style="margin: 30px auto;width: 65%;">
		<h3> Mycobacterium Tuberculosis: </h3> <input class="medium" type="text" name="mycobacterium-tuberculosis" value="<?php
        if($dataReader[0][mycobacterium_tuberculosis] === '0'){
            echo 'Seen';
        }
        else if($dataReader[0][mycobacterium_tuberculosis] === '1'){
            echo 'Not Seen';
        }
    ?>">
	</div>

	<?php
		}
		else if($dataReader[0][lab_table_name] === 'lab_serum_calcium')
		{ //24
	?>

	<div class="box">
		<h1>LABORATORY REPORT:</h1>
	</div>
	
	<div class="result">
		<h3> SERUM CALCIUM: </h3><input class="medium" type="text" name="blood-vdrl" value="<?= $dataReader[0][serum_calcium] ?>">mg/dl
		<h3 style="display: block;text-align: center;">(Normal Value 8.8 - 10.2 mg/dl)</h3>
	</div>

	<?php
		}
		else if($dataReader[0][lab_table_name] === 'lab_fluid_re')
		{ //25
	?>

	<div class="box">
		<h1>LABORATORY REPORT:</h1>
	</div>
	
	<table style="width:100%;border: none;">
		<tr style="border: none;">
			<td style="border: none;">Appearance:</td>
			<td style="border: none;"><input class="large" type="text" value="<?= $dataReader[0][appearanceone] ?>"></td>
			<td style="border: none;">Deposit:</td>
			<td style="border: none;"></td>
		</tr>
		<tr style="border: none;">
			<td style="border: none;"></td>
			<td style="border: none;"><input class="large" type="text" value="<?= $dataReader[0][appearancetwo] ?>"></td>
			<td style="border: none;"></td>
			<td style="border: none;"></td>
		</tr>
		<tr style="border: none;">
			<td style="border: none;">Rivalta Test:</td>
			<td style="border: none;"><input class="large" type="text" value="<?= $dataReader[0][riv_test] ?>"></td>
			<td style="border: none;">Leshman:</td>
			<td style="border: none;"><input class="large" type="text" value="<?= $dataReader[0][lesh_man] ?>"></td>
		</tr>
		<tr style="border: none;">
			<td style="border: none;">Specific Gravity:</td>
			<td style="border: none;"><input class="large" type="text" value="<?= $dataReader[0][spec_gra] ?>"></td>
			<td style="border: none;">Gram Stain:</td>
			<td style="border: none;"><input class="large" type="text" value="<?= $dataReader[0][gram_st] ?>"></td>
		</tr>
		<tr style="border: none;">
			<td style="border: none;">Total Cell Count:</td>
			<td style="border: none;"><input class="large" type="text" value="<?= $dataReader[0][total_cc] ?>"></td>
			<td style="border: none;">Z N Stain:</td>
			<td style="border: none;"><input class="large" type="text" value="<?= $dataReader[0][zn_stain] ?>"></td>
		</tr>
	</table>
	
	<div class="result" style="width: 82%;margin: 20px auto;text-align: center;">
		<h3> Protein: 56 g/l</h3>&emsp;&emsp;<h3> 20 - 40 g/l</h3><br>
		<h3> Protein: 56 g/l</h3>&emsp;&emsp;<h3> 20 - 40 g/l</h3><br>
	</div>

	<?php
		}
		else if($dataReader[0][lab_table_name] === 'lab_cardiac_enzymes')
		{ //26
	?>

	<div class="box">
		<h1>CARDIAC ENZYMES:</h1>
	</div>
	
	<!-- <div class="result">
		<h3> Anti Nuclear Antibodies: </h3><input class="medium" type="text" name="anti-nuclear-antibodies">
	</div> -->
	
	<table style="width:100%">
		<tr>
			<th>Investigation</th>
			<th>Result</th> 
			<th>Normal Value</th>
		</tr>
		<tr>
			<td>Serum ASAT(GOT)</td>
			<td><?= $dataReader[0][serum_asat_got] ?>U/L</td>
			<td>MEN ....UP TO 37 U/L<br>WOMEN ....UP TO 31 U/L</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Serum L.D.H</td>
			<td><?= $dataReader[0][serum_ldh] ?>U/L</td>
			<td>230....460 U/L</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Serum C.P.K</td>
			<td><?= $dataReader[0][serum_cpk] ?>U/L</td>
			<td>Up to 165 U/L</td>
		</tr>
	</table>

	<?php
		}
		else if($dataReader[0][lab_table_name] === 'lab_blood_cp')
		{ //27
	?>

	<div class="box">
		<h1>Blood Complete Picture</h1>
	</div>
	
	<table style="width:100%;border: none;">
		<tr>
			<td>TLC:</td>
			<td><input type="text" class="ex-large" value="<?= $dataReader[0][tlc] ?>"></td>
			<td>10<sup>^3</sup>/mm<sup>^3</sup></td>
			<td style="width: 13%;">(4.5-10.5)</td>
			<td>MCV:</td>
			<td><input type="text" class="ex-large" value="<?= $dataReader[0][mcv] ?>"></td>
			<td>fl</td>
			<td style="width: 13%;">(76-96)</td>
		</tr>
		<tr>
			<td>RBC:</td>
			<td><input type="text" class="ex-large" value="<?= $dataReader[0][rbc] ?>"></td>
			<td>10<sup>^6</sup>/mm<sup>^3</sup></td>
			<td>(3.80-6.50)</td>
			<td>MCH:</td>
			<td><input type="text" class="ex-large" value="<?= $dataReader[0][mch] ?>"></td>
			<td>p g</td>
			<td>(27.0-32.0)</td>
		</tr>
		<tr>
			<td>HB:</td>
			<td><input type="text" class="ex-large" value="<?= $dataReader[0][hb] ?>"></td>
			<td>g/dl</td>
			<td>(11.5-17.5)</td>
			<td>MCHC:</td>
			<td><input type="text" class="ex-large" value="<?= $dataReader[0][mchc] ?>"></td>
			<td>g/dl</td>
			<td>(30.0-35.0)</td>
		</tr>
		<tr>
			<td>HCT:</td>
			<td><input type="text" class="ex-large" value="<?= $dataReader[0][hct] ?>"></td>
			<td>%</td>
			<td>(36.0-52.0)</td>
			<td>RDWc:</td>
			<td><input type="text" class="ex-large" value="<?= $dataReader[0][rdwc] ?>"></td>
			<td>%</td>
			<td></td>
		</tr>
		<tr>
			<td>PLT:</td>
			<td><input type="text" class="ex-large" value="<?= $dataReader[0][plt] ?>"></td>
			<td>10<sup>^3</sup>/mm<sup>^3</sup></td>
			<td>(150-450)</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</table>
	<div>
		<div class="result-left" style="margin: 30px;padding: 5px 30px;border: 1px solid black;">
			<h3 style="margin: 0;">Differential Leucocyte Count</h3>
		</div>
		<div class="result-right" style="margin: 30px;padding: 5px 30px;border: 1px solid black;">
			<h3 style="margin: 0;">Absolute</h3>
		</div>
		<div class="clear-both"></div>
	</div>
	<table style="width:100%;border: none;">
		<tr>
			<td>NEU:</td>
			<td><input type="text" class="ex-large" value="<?= $dataReader[0][dll_neu] ?>"></td>
			<td>%</td>
			<td style="width: 13%;">(40.0-70.0)</td>
			<td>#NEU:</td>
			<td><input type="text" class="ex-large" value="<?= $dataReader[0][ab_neu] ?>"></td>
			<td>10<sup>^3</sup>/mm<sup>^3</sup></td>
			<td style="width: 13%;">(1.5-7.5)</td>
		</tr>
		<tr>
			<td>LYM:</td>
			<td><input type="text" class="ex-large" value="<?= $dataReader[0][dll_lym] ?>"></td>
			<td>%</td>
			<td>(20.0-40.0)</td>
			<td>#LYM:</td>
			<td><input type="text" class="ex-large" value="<?= $dataReader[0][ab_lym] ?>"></td>
			<td>10<sup>^3</sup>/mm<sup>^3</sup></td>
			<td>(0.8-4.4)</td>
		</tr>
		<tr>
			<td>EOS:</td>
			<td><input type="text" class="ex-large" value="<?= $dataReader[0][dll_eos] ?>"></td>
			<td>%</td>
			<td>(1.0-5.0)</td>
			<td>#EOS:</td>
			<td><input type="text" class="ex-large" value="<?= $dataReader[0][ab_eos] ?>"></td>
			<td>10<sup>^3</sup>/mm<sup>^3</sup></td>
			<td>(0.04-0.4)</td>
		</tr>
		<tr>
			<td>MON:</td>
			<td><input type="text" class="ex-large" value="<?= $dataReader[0][dll_mon] ?>"></td>
			<td>%</td>
			<td>(2.0-8.0)</td>
			<td>#MON:</td>
			<td><input type="text" class="ex-large" value="<?= $dataReader[0][ab_mon] ?>"></td>
			<td>10<sup>^3</sup>/mm<sup>^3</sup></td>
			<td>(0.1-0.9)</td>
		</tr>
	</table>
	<p>Results Generated From DIATRON [Fully automated Haematology Anlyzer]</p>
	<p style="display: inline-block;">ESR </p>
	<input class="ex-small" style="display: inline-block;" type="text" value="<?= $dataReader[0][esr] ?>">
	<p style="display: inline-block;">mm/1st hour.(WESTERGREN) [ Male 1-14 Female 3--20]</p>

	<?php
		}
		else if($dataReader[0][lab_table_name] === 'lab_serum_amylase')
		{ //28
	?>

	<div class="box">
		<h1>LABORATORY REPORT:</h1>
	</div>
	
	<h1 style="text-align: center;">SERUM AMYLASE</h1>
	
	<table style="width:100%">
		<tr>
			<th>Test</th>
			<th>Result</th> 
			<th>Ref. Value</th>
		</tr>
		<tr>
			<td>Serum Amylase</td>
			<td><?= $dataReader[0][serum_amylase] ?>U/L</td>
			<td>UP TO 90 U/L</td>
		</tr>
	</table>

	<?php
		}
		else if($dataReader[0][lab_table_name] === 'lab_prothronbin_time')
		{ //29
	?>

	<div class="box">
		<h1>LABORATORY REPORT:</h1>
	</div>
	<h1 style="text-align:center;">Prothronbin Time</h1>
	
	<div class="result">
		<h3> Patient: </h3><input class="medium" type="text" name="patient" value="<?= $dataReader[0][patient] ?>">SECONDS<br>
		<h3> Control: </h3><input class="medium" type="text" name="control" value="<?= $dataReader[0][control] ?>">SECONDS<br>
		<h3> INR: </h3><input class="medium" type="text" name="control" value="<?= $dataReader[0][inr] ?>">SI UNIT
	</div>

	<?php
		}
		else if($dataReader[0][lab_table_name] === 'lab_widal_reaction')
		{ //30
	?>

	<div class="box">
		<h1>LABORATORY REPORT:</h1>
	</div>
	<h1 style="text-align: center;">WIDAL REACTION</h1>
	
	<div class="result">
		<h3> TO: &emsp;&emsp;</h3><input class="medium" type="text" name="TO" value="<?= $dataReader[0][w_to] ?>"><br>
		<h3> TH: &emsp;&emsp;</h3><input class="medium" type="text" name="TH" value="<?= $dataReader[0][w_th] ?>"><br>
		<h3> AO: &emsp;&emsp;</h3><input class="medium" type="text" name="AO" value="<?= $dataReader[0][w_ao] ?>"><br>
		<h3> BO: &emsp;&emsp;</h3><input class="medium" type="text" name="BO" value="<?= $dataReader[0][w_bo] ?>">
	</div>

	<?php
		}
		else if($dataReader[0][lab_table_name] === '')
		{ //31
	?>

	<?php
		}
		else if($dataReader[0][lab_table_name] === '')
		{//32

		}
	?>
	
	<div class="footer" style="margin-top: 400px;">
		<p style="float: left;">REMARKS</p>
		<div class="clear-both"></div>
	</div>
	

  </section>

</body>

</html>
