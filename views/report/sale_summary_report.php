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

$this->title = 'Sale Summary Report';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="sales-index">

    <?php Pjax::begin(['timeout' => '30000']); ?>

    <?php  echo $this->render('_sale_summary_search', ['model' => $searchModel]); ?>


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
            'heading' => '<h5 class="card-title"><i class="fa fa-th-list"></i> '.Yii::t ( 'app', 'Sale Summary Report :  '.$searchModel->created_on).' </h5>',
            'before'=>Html::a ( '<i class="fa fa-repeat"></i> '.Yii::t ( 'app', 'Reset List' ), [

                'sale-summary'

            ], [

                'class' => 'btn btn-info'

            ] ).'&nbsp;&nbsp;<a class="btn btn-success"  target=_blank href="'.Yii::$app->homeUrl.'report/sale-summary?type=print&'.$_SERVER['QUERY_STRING'].'"><i class="fa fa-print">  Print</i></a>',

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
                'headerOptions' => ['style' => 'width:5%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'paid_amount',
                'label'=>'Paid',
                'format' => ['decimal', 2],
                'pageSummary' => true

            ],
            [
                'headerOptions' => ['style' => 'width:5%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'label' =>  'Remaining',
                'format' => ['decimal', 2],
                'value'=> function($model)
                {
                    return $model->grand_total - $model->paid_amount;
                },
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
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
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

