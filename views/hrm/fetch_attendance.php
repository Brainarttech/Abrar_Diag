<?php

use yii\helpers\Html;
use app\helpers\Helper;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DepartmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fetch Attendance';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
<div class="col-xl-12 col-lg-12">
	<!--Begin::Portlet-->
	<div class="m-portlet m-portlet--full-height ">
		<div class="m-portlet__head">
			<div class="m-portlet__head-caption">
				<div class="m-portlet__head-title">
					<h3 class="m-portlet__head-text">
						Fetch Attendance Record
					</h3>
				</div>
			</div>
		</div>
		<div class="m-portlet__body" style="padding: 0.2rem 2.2rem;">
			<?php
				$form = ActiveForm::begin([
					'action' => ['fetch-attendance', 'id' => $_GET['id']],
					'method' => 'get',
				]);
            ?>
			<!--begin: Search Form -->
			<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
				<div class="row align-items-center">
					<div class="col-xl-12 order-2 order-xl-1">
						<div class="form-group m-form__group row">
							<div class="col-md-3">
								<div class="form-group">
									<?php
										echo '<label class="control-label" for="attendance_start_date">Start Date</label>';
										echo DatePicker::widget([
											'name' => 'attendance_start_date',
											'type' => DatePicker::TYPE_INPUT,
											'value' => date("Y-m-d"),
											'pluginOptions' => [
												'format' => 'yyyy-mm-dd',
												'autoclose' => true,
											]
										]);
									?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<?php
										echo '<label class="control-label" for="attendance_end_date">End Date</label>';
										echo DatePicker::widget([
											'name' => 'attendance_end_date',
											'type' => DatePicker::TYPE_INPUT,
											'value' => date("Y-m-d"),
											'pluginOptions' => [
												'format' => 'yyyy-mm-dd',
												'autoclose' => true,
											]
										]);
									?>
								</div>
							</div>
						</div>
						<?php
							if(isset($attendance_date)){
								$attendance_date = explode("-",$attendance_date)
						?>
						<!--begin::Widget 29-->
						<div class="m-widget29">
							<div class="m-widget_content" style="padding-top: 0;">
								<h3 class="m-widget_content-title">
									Result
								</h3>
								<div class="m-widget_content-items">
									<div class="m-widget_content-item">
										<span>
											Number of New Records
										</span>
										<span class="m--font-accent">
											<?= $attendance_date[1]; ?>
										</span>
									</div>
									<div class="m-widget_content-item">
										<span>
											Number of Already Exist Records
										</span>
										<span class="m--font-metal">
											<?= $attendance_date[0]; ?>
										</span>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
						<!--end::Widget 29-->
						<div class="form-group">
							<?= Html::submitButton('Fetch Attendance', ['class' => 'btn btn-outline-success m-btn m-btn--outline-2x']) ?>
						</div>
						<?php ActiveForm::end(); ?>
					</div>
				</div>
			</div>
			<!--End: Search Form -->
		</div>
	</div>
	<!--End::Portlet-->
</div>
</div>
