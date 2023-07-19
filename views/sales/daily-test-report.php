<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\dropdown\DropdownX;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daily Test Report';
$this->params['breadcrumbs'][] = $this->title;

$time = strtotime($today);

$myFormatForView = date("d/m/Y", $time);

if(isset($_GET['day']))
{
    $day = $_GET['day'];
}else{
    $day = date('ymd', strtotime($today));

}





?>
<div class="sales-index">

    <!-- <h1><?/*= Html::encode($this->title) */?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--<p>
        <?/*= Html::a('Create Sales', ['create'], ['class' => 'btn btn-success']) */?>
    </p>-->



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'toolbar' =>  [
            '{export}',
            '{toggleData}',
        ],
        // set export properties
        'export' => [
            'fontAwesome' => true
        ],


        'showPageSummary' => true,

        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<h5 class="card-title"><i class="fa fa-th-list"></i> '.Yii::t ( 'app', 'Daily Test Report : '.$myFormatForView).' </h5>',
            'after' => '</form>'.Html::a ( '<i class="fa fa-repeat"></i> '.Yii::t ( 'app', 'Reset List' ), [

                    'dailytestreport'

                ], [

                    'class' => 'btn btn-info  btn-sm'

                ] ),
            'before'=>'<a class="btn btn-success btn-sm" href="'.Yii::$app->homeUrl.'sales/dailytestreport?day='.$previous.'"><i class="icon-android-arrow-back"></i> Previous</a>	&nbsp;<a class="btn btn-primary btn-sm" href="'.Yii::$app->homeUrl.'sales/dailytestreport?day='.$next.'"><i class="icon-android-arrow-forward"></i> Next</a>&nbsp;<a class="btn btn-default btn-sm" target=_blank href="'.Yii::$app->homeUrl.'sales/print-dailytestreport?day='.$day.'"><i class="icon-android-arrow-forward"></i>Print</a>',


            'showFooter' => true,

        ],
        'columns' => [

            //'id',
            //'hospital_id',

            [
                'headerOptions' => ['style' => 'width:15%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'item_id',
                'value'=>'item.name',
                'label'=>'Test Name',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(\app\models\ItemName::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                    'options' => ['multiple' => false]
                ],
                'filterInputOptions' => ['placeholder' => 'Select Test'],
                'format' => 'raw',
                'group'=>true,

            ],
            [
                'headerOptions' => ['style' => 'width:15%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'item_category',
                'value'=>'item.category.name',
                //'header'=>'Department',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(\app\models\ItemCategory::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                    'options' => ['multiple' => false]
                ],
                'filterInputOptions' => ['placeholder' => 'Select Department'],
                'format' => 'raw'

            ],
            [
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'patient_id',
                'header'=>'Patient',
                'value'=>'sale.patient.name'

            ],
            [
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'referred_id',
                'header'=>'Referred',
                'value'=>'sale.referred.name'

            ],
            [
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'item_price',

            ],
            [
                'headerOptions' => ['style' => 'width:15%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'created_on',
                'format'=>'raw',
                'header'=>'Time',
                'filter'=>false,
                'value' => function($model){
                    return \app\helpers\datetime::saleTime($model->created_on);
                },

            ],
            [
                'headerOptions' => ['style' => 'width:15%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'test_status',
                'filter'=>array(1=>"Pending",2=>"Complete"),

                'format'=>'raw',
                //'header'=>'Time',
                'value' => function($model){
                   if($model->test_status==1){
                       return '<span class="m-badge m-badge--danger m-badge--wide">Pending</span>';


                   }else if($model->test_status)
                   {
                       return '<span class="m-badge m-badge--success m-badge--wide">Completed</span>';


                   }
                },

            ],


            //'referred_doctor_id',
            // 'grand_total',
            //'paid_amount',
            //'sale_status',
            //'payment_status',
            //'total',
            //'discount',
            //'discount_type',
            //'tax',
            //'grand_total',
            //'payment_status',
            //'total_items',
            //'paid_amount',
            //'refund_charges',
            //'notes',
            //'sale_status',
            //'status',
            //'created_by',
            //'created_on',
            //'updated_by',
            //'updated_on',
        ],
    ]); ?>

</div>

