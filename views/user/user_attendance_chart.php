<?php

use app\models\User;
use app\models\Attendance;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use app\helpers\datetime;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\dropdown\DropdownX;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */



$this->title = 'Attendance Chart';
$this->params['breadcrumbs'][] = $this->title;


?>

<style>
    .table-sm td, .table-sm th{
        padding: .rem;
    }
</style>



<div class="sales-index">
	
	<?php  echo $this->render('_user_attendance_chart_search', ['model' => $searchModel]); ?>

	<!-- begin:: Page -->
	<div class="m-grid m-grid--hor m-grid--root m-page">
		<!-- BEGIN: Header -->
		<!-- END: Header -->		
	<!-- begin::Body -->
		<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop">
			<!-- BEGIN: Left Aside -->
			<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
				<i class="la la-close"></i>
			</button>
			<!-- END: Left Aside -->
			<div class="m-grid__item m-grid__item--fluid">
				
				<div class="m-content">
					<div class="row">
						<div class="col-lg-12">
							<!--begin::Portlet-->
							<div class="m-portlet m-portlet--tab">
								<div class="m-portlet__head">
									<div class="m-portlet__head-caption">
										<div class="m-portlet__head-title">
											<span class="m-portlet__head-icon m--hide">
												<i class="la la-gear"></i>
											</span>
											<h3 class="m-portlet__head-text">
												Attendance Chart : <?= \app\helpers\Helper::getUser($_GET['id']); ?>
												(Year <?= isset($_GET['attendance_date'])?$_GET['attendance_date']:date("Y"); ?>)
											</h3>
										</div>
									</div>
								</div>
								<div class="m-portlet__body">
									<div id="m_morris_1" style="height:100%;"></div>
								</div>
							</div>
							<!--end::Portlet-->
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<!-- end:: Body -->
	</div>
	<!-- end:: Page -->

</div>
<script>
var MorrisChartsDemo = {
    init: function() {
        return new Morris.Bar({
            element: "m_morris_1",
            data: <?php echo $MorrisBarChart; ?>/*[{
                y: "JANUARY",
                a: <?= datetime::countDays(2018, 1, array(0)); ?>,
                b: <?= Attendance::find()->where(['status' => '1', 'user_id'=>$id])->andWhere(['between', 'attendance_date', "2017-12-31", "2018-02-01" ])->count() ?>
            }, {
                y: "FEBRUARY",
                a: <?= datetime::countDays(2018, 2, array(0)); ?>,
                b: 65
            }, {
                y: "MARCH",
                a: <?= datetime::countDays(2018, 3, array(0)); ?>,
                b: 40
            }, {
                y: "APRIL",
                a: <?= datetime::countDays(2018, 4, array(0)); ?>,
                b: 65
            }, {
                y: "MAY",
                a: <?= datetime::countDays(2018, 5, array(0)); ?>,
                b: 40
            }, {
                y: "JUNE",
                a: <?= datetime::countDays(2018, 6, array(0)); ?>,
                b: 65
            }, {
                y: "JULY",
                a: <?= datetime::countDays(2018, 7, array(0)); ?>,
                b: 90
            }, {
                y: "AUGUST",
                a: <?= datetime::countDays(2018, 8, array(0)); ?>,
                b: 90
            }, {
                y: "SEPTEMBER",
                a: <?= datetime::countDays(2018, 9, array(0)); ?>,
                b: 90
            }, {
                y: "OCTOBER",
                a: <?= datetime::countDays(2018, 10, array(0)); ?>,
                b: 90
            }, {
                y: "NOVEMBER",
                a: <?= datetime::countDays(2018, 11, array(0)); ?>,
                b: 90
            }, {
                y: "DECEMBER",
                a: <?= datetime::countDays(2018, 12, array(0)); ?>,
                b: <?= Attendance::find()->where(['status' => '1', 'user_id'=>$_GET['id']])->andWhere(['between', 'attendance_date', "2018-11-30", "2018-12-31" ])->count(); ?>
            }]*/,
            xkey: "y",
            ykeys: ["a", "b"],
            labels: ["Total Attendance", "Present Attendance"],
			barColors:['#1192f6','#34bfa3'],
			xLabelAngle: '50',
        })
    }
};

jQuery(document).ready(function() {
    var bar = MorrisChartsDemo.init();
	$(window).on('resize', function(){
		//console.log("resize");
		bar.redraw();
	});
});
</script>

