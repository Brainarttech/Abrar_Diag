<?php

use kartik\daterange\DateRangePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\SalesSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="m-portlet m-portlet--collapsed m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_7">

    <div class="m-portlet__head">
		<div class="m-portlet__head-caption">
			<div class="m-portlet__head-title">
				<span class="m-portlet__head-icon">
					<i class="flaticon-search"></i>
				</span>
				<h3 class="m-portlet__head-text">
					Search
				</h3>
			</div>
		</div>
		<div class="m-portlet__head-tools">
			<ul class="m-portlet__nav">
				<li class="m-portlet__nav-item">
					<a href="#"  m-portlet-tool="toggle" class="m-portlet__nav-link m-portlet__nav-link--icon">
						<i class="la la-angle-down"></i>
					</a>
				</li>
			</ul>
		</div>
    </div>
    <div class="m-portlet__body">
        <div class="sales-search">
            <?php
				$form = ActiveForm::begin([
					'action' => ['attendance', 'id' => $_GET['id']],
					'method' => 'get',
				]);
            ?>
			<!--begin: Search Form -->
			<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
				<div class="row align-items-center">
					<div class="col-xl-12 order-2 order-xl-1">
						<div class="form-group m-form__group row">
							<div class="col-md-2">
								<div class="form-group">
									<?php
										echo '<label class="control-label" for="attendancesearch-attendance_date">Attendance Date</label>';
										echo DatePicker::widget([
											'name' => 'attendance_date',
											'type' => DatePicker::TYPE_INPUT,
											'value' => isset($_GET['attendance_date'])?$_GET['attendance_date']:date("m/Y"),
											'pluginOptions' => [
												'format' => 'mm/yyyy',
												'autoclose' => true,
												'minViewMode' => 1,
												// 'autoclose'=>true,
												// //'minViewMode' => 0,
												// 'startView'=>'year',
												// 'minViewMode'=>'month',
												// 'format' => 'yyyy'
											]
										]);
									?>
								</div>
							</div>
						</div>
						<div class="form-group">
							<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
							<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
						</div>
						<?php ActiveForm::end(); ?>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>
