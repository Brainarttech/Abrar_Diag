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

$this->title = 'Sales';
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


        'showPageSummary' => true,

        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<h5 class="card-title"><i class="fa fa-th-list"></i> '.Yii::t ( 'app', 'Daily Sale Report : '.$myFormatForView).' </h5>',
            'after' => '</form>'.Html::a ( '<i class="fa fa-repeat"></i> '.Yii::t ( 'app', 'Reset List' ), [

                    'index'

                ], [

                    'class' => 'btn btn-info  btn-sm'

                ] ),
            'before'=>'<div class="row" style="margin-left: 0px;"><a class="btn btn-success btn-sm" href="'.Yii::$app->homeUrl.'sales/dailysalereport?day='.$previous.'"><i class="icon-android-arrow-back"></i> Previous</a>	&nbsp;<a class="btn btn-primary btn-sm" href="'.Yii::$app->homeUrl.'sales/dailysalereport?day='.$next.'"><i class="icon-android-arrow-forward"></i> Next</a>&nbsp;<a class="btn btn-warning" data-pjax ="0" href="'.Yii::$app->homeUrl.'sales/custom-sale-report?summary=true"><i class="icon-android-arrow-back"></i>Advanced Search</a>	&nbsp;<a class="btn btn-default btn-sm" target=_blank href="'.Yii::$app->homeUrl.'sales/print-dailysalereport?day='.$day.'&from='.$from.'&to='.$to.'"><i class="icon-android-arrow-forward"></i>Print</a>',

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
                'headerOptions' => ['style' => 'width:15%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'created_on',
                'format'=>'raw',
                'value' => function($model){
                    return \app\helpers\datetime::saleDateTime($model->created_on);
                },
                'filter'=>false,
                'pageSummary' => 'Grand Total',

            ],
            [
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'invoice_no',

            ],
            [
                'headerOptions' => ['style' => 'width:15%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'patient_id',
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
                'headerOptions' => ['style' => 'width:15%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'referred_doctor_id',
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
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'discount',
                'value'=> function($model){
                    if($model->discount==0)
                        return '';
                    else
                        return $model->discount;
                },
                'format' => ['decimal', 2],
                'pageSummary' => true


            ],
            [
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'grand_total',
                'format' => ['decimal', 2],
                'pageSummary' => true

            ],

            [
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'paid_amount',
                'format' => ['decimal', 2],
                'pageSummary' => true

            ],
            [
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'sale_status',
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

            ],
            [
                'headerOptions' => ['style' => 'width:12%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                //'filter'=>array("1"=>"open","2"=>"in progress","3"=>"closed"),
                'attribute' =>  'payment_status',
                'format'=>'raw',
                'value'=> function($model){

                    if($model->payment_status=="1")
                        return '<span class="m-badge m-badge--success m-badge--wide">Paid</span>';
                    else if($model->payment_status=="2")
                        return '<span class="m-badge m-badge--info m-badge--wide">Partial</span>';
                    else{
                        return '<span class="m-badge m-badge--danger m-badge--wide">Due</span>';

                    }
                },
                'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                'filter' => [
                    1 => 'Paid',
                    2 => 'Partial',
                    3 => 'Due'
                ],
                'filterWidgetOptions' => [
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ],
                'filterInputOptions' => ['placeholder' => 'All...'],

            ],
            [
                'headerOptions' => ['style' => 'width:15%','class' => 'text-center'],
                'attribute' => 'created_by',
                'contentOptions' => ['class' => 'text-center'],
                'value'=>'user.username',
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

