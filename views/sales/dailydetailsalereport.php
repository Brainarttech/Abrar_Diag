<?php

use app\models\User;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\dropdown\DropdownX;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */




$this->title = 'Advanced Detail Sale Report';
$this->params['breadcrumbs'][] = $this->title;

if(!empty($today))
{
    $time = strtotime($today);

    $myFormatForView = date("d/m/Y", $time);

    if(isset($_GET['day']))
    {
        $day = $_GET['day'];
    }else{
        $day = date('ymd', strtotime($today));

    }
}

if(!empty($from) && !empty($to))
{
    $myFormatForView = $from.' - '. $to;
}


?>

<style>
    .table-sm td, .table-sm th{
        padding: .rem;
    }
</style>



<div class="sales-index">

    <!-- <h1><?/*= Html::encode($this->title) */?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--<p>
        <?/*= Html::a('Create Sales', ['create'], ['class' => 'btn btn-success']) */?>
    </p>-->



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'toolbar' =>  [
            '{export}',
            '{toggleData}',
        ],
        // set export properties
        'export' => [
            'fontAwesome' => true
        ],
        'hover' => false,
        'condensed' => true,
        'floatHeader' => false,
        'bordered'=>true,
        'striped'=>false,


        'showPageSummary' => true,

        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<h5 class="card-title"><i class="fa fa-th-list"></i> '.Yii::t ( 'app', 'Daily Detail Sale Report : '.$myFormatForView).' </h5>',
            'after' => '</form>'.Html::a ( '<i class="fa fa-repeat"></i> '.Yii::t ( 'app', 'Reset List' ), [

                    'dailydetailsalereport'

                ], [

                    'class' => 'btn btn-info  btn-sm'

                ] ),//btn-sm
            'before'=>'<div class="row" style="margin-left: 0px;"><a class="btn btn-success" href="'.Yii::$app->homeUrl.'sales/dailydetailsalereport?day='.$previous.'"><i class="icon-android-arrow-back"></i> Previous</a>	&nbsp;<a class="btn btn-primary" href="'.Yii::$app->homeUrl.'sales/dailydetailsalereport?day='.$next.'"><i class="icon-android-arrow-forward"></i> Next</a>&nbsp;<a class="btn btn-warning" data-pjax ="0" href="'.Yii::$app->homeUrl.'sales/custom-sale-report"><i class="icon-android-arrow-back"></i>Advanced Search</a>	&nbsp;<a class="btn btn-default" target=_blank href="'.Yii::$app->homeUrl.'sales/print-dailydetailsalereport?day='.$day.'&from='.$from.'&to='.$to.'"><i class="icon-android-arrow-forward"></i>Print</a>',
            'showFooter' => true,

        ],
        'columns' => [
            [
                'class' => 'kartik\grid\SerialColumn',
                'contentOptions' => ['class' => 'kartik-sheet-style'],
                'width' => '36px',
                'header' => '',
                'headerOptions' => ['class' => 'kartik-sheet-style']
            ],

            //'id',
            //'hospital_id',
            [
                'headerOptions' => ['style' => 'width:5%','class' => 'text-center'],
                'contentOptions' => ['class' => 'kartik-sheet-style'],
                'attribute' =>  'created_on',
                'format'=>'raw',
                'value' => function($model){
                    return \app\helpers\datetime::saleDateTime($model->created_on);
                },
                'filter'=>false,
                'pageSummary' => 'Grand Total',

            ],
            [
                'headerOptions' => ['style' => 'width:5%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'invoice_no',
                'header'=>'Receipt',

            ],
            [
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'patient_id',
                'header'=>'Patient',
                'value'=>'patient.name',
                'width' => '200px',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(\app\models\Patient::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'filterWidgetOptions' => [
                    'options' => [
                        'placeholder' => Yii::t('app', 'All...')
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ]
                ],
                //'filterInputOptions' => ['placeholder' => 'Patient Name'],
                'format' => 'raw'

            ],
            [
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'referred_doctor_id',
                'header'=>'Referred',
                'value'=>'referred.name',
                'width' => '200px',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(\app\models\ReferredDoctor::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'filterWidgetOptions' => [
                    'options' => [
                        'placeholder' => Yii::t('app', 'All...')
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ]
                ],
                //'filterInputOptions' => ['placeholder' => 'Patient Name'],
                'format' => 'raw'

            ],
            [
                'header'=>'Tests',
                'headerOptions' => ['style' => 'width:45%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'format'=>'raw',

                'value'=> function($model){
                    return Yii::$app->controller->renderPartial('test_detail', ['model' => $model]);
                },


            ],
            [
                'headerOptions' => ['style' => 'width:5%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
               // 'attribute' =>  'total',
                'value'=>function($model)
                {
                    $total_items = 0;
                    foreach ($model->saleitems as $item)
                    {
                        $total_extra = 0;
                        foreach ($item['extra'] as $extra){
                            $total_extra = $total_extra + ($extra->item_quantity * $extra->item_rate);
                        }

                        $total_items = $total_items + ($item->item_price + $total_extra);

                    }



                    return $total_items;
                },
                'header'=>'Total',
                //'format' => ['decimal', 1],
                'pageSummary' => true


            ],
            [
                'headerOptions' => ['style' => 'width:5%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'header'=>'Consultant',
                'value'=> function($model){
                    $consultant_amount = 0;
                    foreach ($model->saleitems as $item)
                    {
                        $consultant_amount = $consultant_amount + $item->consultant_amount;
                    }

                    if($consultant_amount==0)
                    {
                        return '';
                    }else
                    {
                        return $consultant_amount;
                    }

                },
               //'format' => ['decimal', 2],
                'pageSummary' => true


            ],
            [
                'headerOptions' => ['style' => 'width:5%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'discount',
                'header'=>'Discount',
                'value'=> function($model){
                    if($model->discount==0)
                        return '';
                    else
                        return $model->discount;
                },
                //'format' => ['decimal', 2],
                'pageSummary' => true


            ],
            [
                'headerOptions' => ['style' => 'width:5%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'grand_total',
                'header'=>'G.Total',
                //'format' => ['decimal', 2],
                'pageSummary' => true

            ],

            [
                'headerOptions' => ['style' => 'width:5%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'paid_amount',
                'header'=>'Paid',
                //'format' => ['decimal', 2],
                'pageSummary' => true

            ],
            [
                'headerOptions' => ['style' => 'width:5%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                //'attribute' =>  'paid_amount',
                'header'=>'Remaining',
                'value'=> function($model){
                    $tot =  $model->grand_total - $model->paid_amount;
                    if($tot == 0)
                    {
                        return '';
                    }else
                    {
                        return $tot;
                    }
                },
                //'format' => ['decimal', 2],
                'pageSummary' => true

            ],
            /*[
                'headerOptions' => ['style' => 'width:5%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'sale_status',
                'header'=>'Status',
                'format'=>'raw',
                'value'=> function($model){
                    if($model->sale_status=="1")
                        return '<span class="m-badge m-badge--success m-badge--wide">Completed</span>';
                    else
                        return '<span class="m-badge m-badge--danger m-badge--wide">Refund</span>';

                },
                'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                'filter' => [
                    1 => 'Complete',
                    2 => 'Refund',
                ],
                'filterWidgetOptions' => [
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ],
                'filterInputOptions' => ['placeholder' => 'All...'],

            ],*/
            [
                'headerOptions' => ['style' => 'width:15%','class' => 'text-center'],
                'attribute' => 'created_by',
                'contentOptions' => ['class' => 'text-center'],
                'value'=>'user.username',
                'header'=>'Sale By',
                'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(User::find()->all(), 'id', 'username'),
                'filterWidgetOptions' => [
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ],
                'filterInputOptions' => ['placeholder' => 'All...'],
                'format'=>'raw',

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

