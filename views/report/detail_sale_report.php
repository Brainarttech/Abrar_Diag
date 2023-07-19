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



$this->title = 'Detail Sale Report';
$this->params['breadcrumbs'][] = $this->title;


?>

<style>
    .table-sm td, .table-sm th{
        padding: .rem;
    }
</style>



<div class="sales-index">

    <?php Pjax::begin(['timeout' => '30000']); ?>
    <?php  echo $this->render('_detail_sale_search', ['model' => $searchModel]); ?>




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
            'heading' => '<h5 class="card-title"><i class="fa fa-th-list"></i> '.Yii::t ( 'app', 'Detail Sale Report :  '.$searchModel->created_on).' </h5>',
            'before'=>Html::a ( '<i class="fa fa-repeat"></i> '.Yii::t ( 'app', 'Reset List' ), [

                    'detail-sale-report'

                ], [

                    'class' => 'btn btn-info'

                ] ).'&nbsp;&nbsp;<a class="btn btn-success"  target=_blank href="'.Yii::$app->homeUrl.'report/detail-sale-report?type=print&'.$_SERVER['QUERY_STRING'].'"><i class="fa fa-print">  Print</i></a>',

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

