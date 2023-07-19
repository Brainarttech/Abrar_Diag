<?php

use app\helpers\Helper;
use app\helpers\datetime;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Attendance';
$this->params['breadcrumbs'][] = $this->title;

?>
<style>

    .project-people, .project-actions{
        text-align: right;
        vertical-align: middle;
    }

    .project-people img{
        width: 32px;
        height: 32px;
    }

    .label-primary, .badge-primary{
        background-color: #1ab394;
        color: #FFFFFF;
        padding: 3px 6px;
    }


</style>
<div class="user-index">
    <?php Pjax::begin(); ?>
	<?php  echo $this->render('_attendance_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsiveWrap' => false,
        'toolbar' =>  [
            //'{export}',
            '{toggleData}',
        ],

        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<h5 class="card-title"><i class="fa fa-th-list"></i> '.Yii::t ( 'app', 'Attendance' ).' </h5>',
            'after' => '</form>'.Html::a('<i class="fa fa-sync"></i> ' . Yii::t('app', 'Reset List'), [
                    'index'
                ], [
                    'class' => 'btn btn-primary btn-sm'
                ]),
            'showFooter' => false,
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
			//'profilename.id',
			[
				'header' => 'Name',
                'attribute' => 'profilename.id',
                //'format' => 'raw',
                'value' => function ($model, $key, $index, $widget)
                {
					return \app\helpers\Helper::getUser($model->profilename->id);
					//return $model->profilename->id;
                },
                'filter'=>true,
            ],
            'attendance_date',
            [
                'attribute' => 'day',
                //'format' => 'raw',
                'value' => function ($model, $key, $index, $widget)
                {
                    return date('l', strtotime($model->attendance_date));
                },
                'filter'=>true,
            ],
            [
                'attribute' => 'stay_time',
                //'format' => 'raw',
                'value' => function ($model, $key, $index, $widget)
                {
                    return $model->stay_time;
                    //return date('l', strtotime($model->check_in_time));
                    //return datetime::HourMinuteSeconds($model->check_in_time, $model->check_out_time);
                },
                'filter'=>true,
            ],
            'check_in_date',
            //'check_in_time',
			[
                'attribute' => 'check_in_time',
                //'format' => 'raw',
                'value' => function ($model, $key, $index, $widget)
                {
					return Yii::$app->formatter->asTime($model->check_in_time);
                },
                'filter'=>true,
            ],
            'check_out_date',
			//'check_out_time',
			[
                'attribute' => 'check_out_time',
                //'format' => 'raw',
                'value' => function ($model, $key, $index, $widget)
                {
					return Yii::$app->formatter->asTime($model->check_out_time);
                },
                'filter'=>true,
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>