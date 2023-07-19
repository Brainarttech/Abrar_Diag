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

$this->title = 'Sales';
$this->params['breadcrumbs'][] = $this->title;
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



        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<h5 class="card-title"><i class="fa fa-th-list"></i> '.Yii::t ( 'app', 'Pending Department Bill' ).' </h5>',
            'after' => '</form>'.Html::a ( '<i class="fa fa-repeat"></i> '.Yii::t ( 'app', 'Reset List' ), [

                    'index'

                ], [

                    'class' => 'btn btn-info  btn-sm'

                ] ),

            'showFooter' => false,

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
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(\app\models\Patient::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'filterWidgetOptions' => [
                    //'pluginOptions' => ['allowClear' => true],
                    'options' => ['multiple' => true]
                ],
                //'filterInputOptions' => ['placeholder' => 'Patient Name'],
                'format' => 'raw'

            ],
            [
                'headerOptions' => ['style' => 'width:15%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'referred_doctor_id',
                'value'=>'referred.name',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(\app\models\ReferredDoctor::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'filterWidgetOptions' => [
                    //'pluginOptions' => ['allowClear' => true],
                    'options' => ['multiple' => true]
                ],
                //'filterInputOptions' => ['placeholder' => 'Patient Name'],
                'format' => 'raw'

            ],
            [
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'extra_charges',
            ],
            [
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'grand_total',

            ],

            [
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'paid_amount',

            ],
            [
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'sale_status',
                'format'=>'raw',
                'value'=> function($model){
                    if($model->sale_status=="1")
                        return '<span class="m-badge m-badge--success m-badge--wide">Sale</span>';
                    else
                        return '<span class="m-badge m-badge--danger m-badge--wide">Refund</span>';

                },

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
                }

            ],
            [
                'headerOptions' => ['style' => 'width:15%','class' => 'text-center'],
                'attribute' => 'created_by',
                'contentOptions' => ['class' => 'text-center'],
                'value'=>'user.username'

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

            [
                'class' => 'kartik\grid\ActionColumn',
                //'dropdown' => true,
                //'dropdownOptions' => ['class' => 'pull-right'],
                'template' => '{add_extra}',
                'buttons' => [
                    'add_extra' => function ($url, $model) {
                        $title = Yii::t('app', 'View');
                        $options = []; // you forgot to initialize this
                        $icon = '<span class="fa fa-eye"></span>';
                        $label = $icon . ' ' . $title;
                        $url = Yii::$app->homeUrl.'site/view-pending-department-bill?id='.$model->id;
                        // $options['target'] = '_blank';
                        return '<button class="btn btn-default">' . Html::a($label, $url, $options) . '</button>' . PHP_EOL;
                    },
                ],
                'headerOptions' => ['class' => 'kartik-sheet-style'],
            ],
        ],
    ]); ?>

</div>

