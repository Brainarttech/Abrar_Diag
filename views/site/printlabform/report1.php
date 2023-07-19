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
  <title></title>

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
	<table style="width:100%;border: none;">
		<tr>
			<td><b>Patient Name</b></td>
			<td><?= $query->sale->patient->name ?></td>
			<td><b>Patient ID</b></td>
			<td><?= $query->sale->invoice_no?></td>
		</tr>
		<tr>
			<td><b>AGE</b></td>
			<td><?= $query->sale->patient->age?>/<?= $query->sale->patient->age_type?></td>
			<td><b>Sex</b></td>
			<td><?= $query->sale->patient->gender?></td>
		</tr>
		<tr>
			<td><b>DATE & TIME</b></td>
			<td><?= \app\helpers\datetime::saleItemDateTime($query->created_on)?></td>
			<td><b>Lab ID</b></td>
			<td><?= $query->sale->invoice_no ?></td>
		</tr>
		<tr>
			<td><b>TEST REQUIRED</b></td>
			<td><?= $query->item_name ?></td>
			<td><b>Referred By</b></td>
			<td><?= $query->sale->referred->name ?></td>
		</tr>
	</table>

	<div class="box">
		<h1><?= $query->labFormSubmit->lab_form_name ?></h1>
	</div>
	
	<table style="width:100%;border: none;">
		<thead>
			<tr  style="text-align: left;">
				<th>
					Test Name
				</th>
				<th> <!-- style="text-align: center;" -->
					Result
				</th>
				<th>
					Unit
				</th>
				<th>
					Reference Range
				</th>
			</tr>
		</thead>
		<tbody>

			<?php
				foreach ($query->labFormSubmit->labFormFieldSubmit as $key => $temp)
				{
					if($query->labFormSubmit->labFormFieldSubmit[$key-1]->header_name !== $query->labFormSubmit->labFormFieldSubmit[$key]->header_name){
						echo '<tr><td><b>'.$temp->header_name.'</b></td></tr>';
					}
					echo '<tr>';
						echo '<td>'.$temp->name.'</td>';
						echo '<td>'.$temp->result.'</td>';
						echo '<td>'.$temp->unit.'</td>';
						echo '<td>'.$temp->reference_range.'</td>';
					echo '</tr>';
				}
			?>

		</tbody>

	</table>
	
	<div class="footer" style="margin-top: 400px;">
		<p style="float: left;">REMARKS</p>
		<div class="clear-both"></div>
	</div>
	

  </section>

</body>

</html>
