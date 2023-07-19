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

$this->title = 'Department Wise Report';
$this->params['breadcrumbs'][] = $this->title;



?>
<div class="sales-index">


    <?php Pjax::begin(['timeout' => '30000']); ?>
    <?php  echo $this->render('_department_sale_search', ['model' => $searchModel]); ?>




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
        'hover' => false,
        'condensed' => true,
        'floatHeader' => false,
        'bordered'=>true,
        'striped'=>false,


        'showPageSummary' => true,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<h5 class="card-title"><i class="fa fa-th-list"></i> '.Yii::t ( 'app', 'Department Sale Report :  '.$searchModel->created_on).' </h5>',
            'before'=>Html::a ( '<i class="fa fa-repeat"></i> '.Yii::t ( 'app', 'Reset List' ), [

                    'department-sale-report'

                ], [

                    'class' => 'btn btn-info'

                ] ).'&nbsp;&nbsp;<a class="btn btn-success"  target=_blank href="'.Yii::$app->homeUrl.'report/detail-sale-report?type=print&'.$_SERVER['QUERY_STRING'].'"><i class="fa fa-print">  Print</i></a>',

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

