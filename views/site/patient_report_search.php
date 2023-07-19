<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\ItemNameSearch */
/* @var $form yii\widgets\ActiveForm */


?>
<!--  Code Start -->

<!DOCTYPE html>
<html lang="en-US"
	prefix="og: https://ogp.me/ns#" >

<!-- Mirrored from www.abrarsurgery.com.pk/report/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 16 Aug 2021 14:35:19 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
        
        <!-- main css file -->
<link rel="stylesheet" href="<?= Url::base(true) . '/css/abrarcss.css' ?>">	
<link rel='dns-prefetch' href='http://fonts.googleapis.com/' />
<!-- <link rel="alternate" type="application/rss+xml" title=" Abrar Surgery &raquo; Feed" href="https://www.abrarsurgery.com.pk/feed/" />
<link rel="alternate" type="application/rss+xml" title=" Abrar Surgery &raquo; Comments Feed" href="https://www.abrarsurgery.com.pk/comments/feed/" />


<link rel='stylesheet' id='ls-google-fonts-css'  href='https://fonts.googleapis.com/css?family=Fira+Sans:300%7CArimo:regular&amp;subset=latin%2Clatin-ext' type='text/css' media='all' />
<link rel='stylesheet' id='saveo-font-google_fonts-css'  href='https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C700%7CSanchez%3A400%2C400italic&amp;subset=latin%2Clatin-ext&amp;ver=5.8' type='text/css' media='all' />
<link rel='stylesheet' id='google-fonts-1-css'  href='https://fonts.googleapis.com/css?family=Roboto%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7CRoboto+Slab%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic&amp;display=auto&amp;ver=5.8' type='text/css' media='all' /> -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

</head>

<!-- =============================== -->
<body>

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="<?php echo Yii::$app->homeUrl?>images/logo-png.png" id="icon" alt="User Icon" />
    </div>
    <div><p style="font-family: Bookman, URW Bookman L, serif; font-size: 20px; color: #C8C5C5; letter-spacing: 2px;">Online Reports</p></div>

    <!-- Login Form -->
    <?php
		$form = ActiveForm::begin([
					'action' => ['patient-report'],
					'method' => 'get',
					'options' => [
						'data-pjax' => 1
					],
		]);
		?>
        
        <div>
			<i class="fas fa-receipt"></i>
			<input type="text" id="salesitemsearch-receipt_no" class="fadeIn second" name="SalesItemSearch[receipt_no]" placeholder="Receipt I'd">
		</div>
		
		<div>
			<i class="fas fa-user"></i>
			<input type="text" id="patient_name" class="fadeIn third" name="SalesItemSearch[patient_name]" placeholder="Patient I'd">
      	</div>

      	<input type="submit" class="fadeIn fourth" value="Download Report">
	<?php ActiveForm::end(); ?>


  </div>
<script>
	setInterval(()=>
	{
		$('footer').remove(); //
	} , 500);
</script>
  <div id="poweredby">
    <p>Powered By :  <span style="color: #2EA8D2;"> BAM</span></p>
  </div>
  
</div>

</body>

</html>

<!--  Code End -->