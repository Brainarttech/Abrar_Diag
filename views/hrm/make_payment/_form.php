<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Payroll */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
	.datepicker {
		z-index: 1151 !important;
	}
	
</style>

<div class="payroll-form">
    <?php
		$form = ActiveForm::begin([
			'id' => 'form',
			'enableAjaxValidation' => true,
			'validationUrl' => ($model->isNewRecord) ?Yii::$app->homeUrl.'hrm/payroll-validate':Yii::$app->homeUrl.'hrm/payroll-validate?payroll-id='.$model->id.'',
			//'errorCssClass' => 'has-danger',
			'options' => [
				'class' => 'm-form m-form--state',
				'enctype' => 'multipart/form-data'
			],
			// 'fieldConfig' => [
				// 'template' => "{label}\n{input}\n{error}",
				// 'labelOptions' => ['class' => 'form-control-label '],
				// 'horizontalCssClasses' => [
					// 'error' => 'form-control-feedback',
				// ],
			// ],
		]);
    ?>
	
	<div class="row">
		<div class="col-md-6">
			<?php
				echo $form->field($model, 'payment_month')->widget(DatePicker::classname(), [
					'options' => [
                        'placeholder' => 'Select Date ...',
                        'autocomplete' => 'off'
                    ],
					'type' => DatePicker::TYPE_INPUT,
					'pluginOptions' => [
						'format' => 'yyyy-mm',
						'autoclose' => true,
						'minViewMode' => 1,
					]
                ]);
			?>
		</div>
		<div class="col-md-6">
			<!-- <?= $form->field($model, 'payment_date')->textInput(['maxlength' => true]) ?> -->
			<?= $form->field($model, 'monthly_salary')->textInput(['readonly'=> true, 'maxlength' => true]) ?>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-6">
			<?= $form->field($model, 'actual_salary')->textInput(['readonly'=> true, 'maxlength' => true]) ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'paid_salary')->textInput(['maxlength' => true]) ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<?= $form->field($model, 'no_days_month')->textInput(['readonly'=> true]) ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'no_days_present')->textInput(['readonly'=> true,'maxlength' => true]) ?>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-6">
			<?= $form->field($model, 'no_days_absent')->textInput(['readonly'=> true]) ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'overtime_salary')->textInput(['maxlength' => true]) ?>
		</div>
	</div>
	
	<!-- <div class="row">
		<div class="col-md-6">
			<?= $form->field($model, 'payment_type')->dropDownList([ 'Cash Payment' => 'Cash Payment', 'Bank Payment' => 'Bank Payment', 'Cheque Payment' => 'Cheque Payment', ], ['prompt' => '']) ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'status')->dropDownList([ '0'=>'Active', '1'=>'InActive', ], ['prompt' => '']) ?>
		</div>
	</div> -->
	
	<?= $form->field($model, 'user_id')->hiddenInput()->label(false); ?>
	
	<?= $form->field($model, 'payment_type')->dropDownList([ 'Cash Payment' => 'Cash Payment', 'Bank Payment' => 'Bank Payment', 'Cheque Payment' => 'Cheque Payment', ], ['prompt' => '']) ?>
    

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
    //the dropdown list id; This doesn't have to be a dropdown it can be any field type.
    $("#payroll-payment_month").on("change", function() {
        //the dropdown list selected locations id
        var id = '<?php echo $model->user_id ;?>';//$(this).val();
        var monthly_salary = '<?php echo $model->monthly_salary ;?>';

		var date = $(this).val();
		//console.log(id);
        //call the action we created above in the conrller
        $.get("<?= Url::to(['user/attendance-count']); ?>", {id: id, date: date}, function(data) {
            //get the JSON data from the action
            var data = $.parseJSON(data);
            //check if the system found any data            
            if (data !== null) {
                //if yes fill the form field with the ids address,city, state & zip.
                //we use .blur because yii will fire validation for those field after they are filled
				//console.log(data);
				var no_of_days_absent = data[1]-data[0];
				no_of_days_absent = no_of_days_absent<0 ? 0 : no_of_days_absent;
                $("#payroll-no_days_present").val(data[0]);
                $("#payroll-no_days_month").val(data[1]);
                $("#payroll-no_days_absent").val(no_of_days_absent);
                var UnitSalary = monthly_salary/data[1];
                var ActualSalary = monthly_salary-(UnitSalary*(no_of_days_absent));
                $("#payroll-actual_salary").val(Math.round(ActualSalary));
                $("#payroll-paid_salary").val(Math.round(ActualSalary));

                // $("#user-locations-state").val(data.state).blur();
                // $("#user-locations-zip").val(data.zip).blur();
            } else {
                //if data wasn't found the alert.
                alert('We\'re sorry but we couldn\'t load the the location data!');
            }
        });
    });
</script>