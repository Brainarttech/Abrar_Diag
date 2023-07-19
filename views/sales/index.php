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


$title = "Sales";
if (isset($_GET['get'])) {
    $title = ucwords(str_replace('-', " ", $_GET['get'])) . ' Sales';
}




$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="sales-index">



    <?php
    if (Yii::$app->controller->action->id == 'index') {
        echo $this->render('_index_search', ['model' => $searchModel]);
    } else {
        echo $this->render('_complete_search', ['model' => $searchModel]);
    }
    ?>

<!--<p>
    <?/*= Html::a('Create Sales', ['create'], ['class' => 'btn btn-success']) */?>
</p>-->



    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'toolbar' => [
            '{export}',
            '{toggleData}',
        ],
        // set export properties
        'export' => [
            'fontAwesome' => true
        ],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<h5 class="card-title"><i class="fa fa-th-list"></i> ' . Yii::t('app', 'Sales:  ' . $searchModel->created_on) . ' </h5>',
            //'heading' => '<h5 class="card-title"><i class="fa fa-th-list"></i> ' . Yii::t('app', $title) . ' </h5>',
            'before' => Html::a('<i class="fa fa-repeat"></i> ' . Yii::t('app', 'Reset List'), [
                'index'
                    ], [
                'class' => 'btn btn-info  btn-sm'
            ]),
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
                'headerOptions' => ['style' => 'width:15%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'created_on',
                'format' => 'raw',
                'value' => function($model) {
            return \app\helpers\datetime::saleDateTime($model->created_on);
        },
            ],
            [
                'headerOptions' => ['style' => 'width:10%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'invoice_no',
            ],
            [
                'headerOptions' => ['style' => 'width:15%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'patient_id',
                'value' => 'patient.name',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(\app\models\Patient::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                    'options' => ['multiple' => false]
                ],
                'filterInputOptions' => ['placeholder' => 'Patient Name'],
                'format' => 'raw'
            ],
            [
                'headerOptions' => ['style' => 'width:15%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'referred_doctor_id',
                'value' => 'referred.name',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(\app\models\ReferredDoctor::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                    'options' => ['multiple' => false]
                ],
                'filterInputOptions' => ['placeholder' => 'Referred Name'],
                'format' => 'raw'
            ],
            [
                'headerOptions' => ['style' => 'width:10%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'grand_total',
            ],
            [
                'headerOptions' => ['style' => 'width:10%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'paid_amount',
            ],
            [
                'header' => 'Detail',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{myButton}', // the default buttons + your custom button
                'buttons' => [
                    'myButton' => function ($url, $model) {
                        $options = []; // you forgot to initialize this
                        $label = '<span class="far fa-plus-square"></span>';
                        $url = Yii::$app->homeUrl . 'sales/view?id=' . $model->id;
                        $options['class'] = 'view-modal';
                        //$options['target'] = '_blank';

                        return Html::a($label, $url, $options) . PHP_EOL;
                    }
                        ]
                    ],
//            [
//                'class' => 'kartik\grid\ExpandRowColumn',
//                'width' => '80px',
//                'header' => 'Detail',
//                //'enableRowClick'=>true,
//                'value' => function ($model, $key, $index, $column) {
//                    return GridView::ROW_COLLAPSED;
//                },
//                'detail' => function ($model, $key, $index, $column) {
//                    return Yii::$app->controller->renderPartial('view', ['model' => $model]);
//                },
//                'expandOneOnly' => true,
//                'mergeHeader' => false,
//            ],
                    [
                        'headerOptions' => ['style' => 'width:10%', 'class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-center'],
                        'attribute' => 'sale_status',
                        'format' => 'raw',
                        'value' => function($model) {
                    if ($model->sale_status == "1")
                        return '<span class="m-badge m-badge--success m-badge--wide">Completed</span>';
                    else if ($model->sale_status == "2")
                        return '<span class="m-badge m-badge--danger m-badge--wide">Refund</span>';
                    else
                        return '<span class="m-badge m-badge--danger m-badge--wide">Partial Refund</span>';
                },
                    ],
                    [
                        'headerOptions' => ['style' => 'width:12%', 'class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-center'],
                        'filter' => array("1" => "Paid", "2" => "Partial", "3" => "Due"),
                        'attribute' => 'payment_status',
                        'format' => 'raw',
                        'value' => function($model) {

                    if ($model->payment_status == "1")
                        return '<span class="m-badge m-badge--success m-badge--wide">Paid</span>';
                    else if ($model->payment_status == "2")
                        return '<span class="m-badge m-badge--info m-badge--wide">Partial</span>';
                    else {
                        return '<span class="m-badge m-badge--danger m-badge--wide">Due</span>';
                    }
                }
                    ],
                    [
                        'headerOptions' => ['style' => 'width:15%', 'class' => 'text-center'],
                        'attribute' => 'created_by',
                        'contentOptions' => ['class' => 'text-center'],
                        'value' => 'user.username'
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
                        'dropdown' => true,
                        'dropdownOptions' => ['class' => 'pull-right dropdown'],
                        'template' => '{add_payment}{refund_payment}{edit_sale}{duplicate_bill}{view_referred}{view_patient}{view_payment}',
                        'buttons' => [
                            'view_patient' => function ($url, $model) {
                                $title = Yii::t('app', 'View Patient');
                                $options = []; // you forgot to initialize this
                                $icon = '<span class="fa fa-user-o"></span>';
                                $label = $icon . ' ' . $title;
                                $url = Yii::$app->homeUrl . 'patient/view?id=' . $model->patient_id;
                                $options['class'] = 'view-modal';
                                return '<li>' . Html::a($label, $url, $options) . '</li>' . PHP_EOL;
                            },
                                    'view_referred' => function ($url, $model) {
                                $title = Yii::t('app', 'View Referred');
                                $options = []; // you forgot to initialize this
                                $icon = '<span class="fa fa-user-md"></span>';
                                $label = $icon . ' ' . $title;
                                $url = Yii::$app->homeUrl . 'referred-doctor/view?id=' . $model->referred_doctor_id;
                                $options['class'] = 'view-modal';
                                return '<li>' . Html::a($label, $url, $options) . '</li>' . PHP_EOL;
                            },
                                    'duplicate_bill' => function ($url, $model) {
                                $title = Yii::t('app', 'Print Receipt');
                                $options = []; // you forgot to initialize this
                                $icon = '<span class="fa fa-print"></span>';
                                $label = $icon . ' ' . $title;
                                $url = Yii::$app->homeUrl . 'site/print-bill?id=' . $model->id;
                                $options['target'] = '_blank';
                                return '<li>' . Html::a($label, $url, $options) . '</li>' . PHP_EOL;
                            },
                                    'add_payment' => function ($url, $model) {
                                $title = Yii::t('app', 'Add Payment');
                                $options = []; // you forgot to initialize this
                                $icon = '<span class="flaticon-add-circular-button"></span>';
                                $label = $icon . ' ' . $title;
                                $url = Yii::$app->homeUrl . 'payments/create?id=' . $model->id;
                                $options['class'] = 'add-payment';
                                if ($model->payment_status == 0 || $model->payment_status == 2)
                                    return '<li>' . Html::a($label, $url, $options) . '</li>' . PHP_EOL;
                            },
                                    'view_payment' => function ($url, $model) {
                                $title = Yii::t('app', 'View Payment');
                                $options = []; // you forgot to initialize this
                                $icon = '<span class="fa fa-money"></span>';
                                $label = $icon . ' ' . $title;
                                $url = Yii::$app->homeUrl . 'payments/view?id=' . $model->id;
                                $options['class'] = 'view-modal';
                                //$options['target'] = '_blank';

                                return '<li>' . Html::a($label, $url, $options) . '</li>' . PHP_EOL;
                            },
                                    'refund_payment' => function ($url, $model) {
                                $title = Yii::t('app', 'Refund');
                                $options = []; // you forgot to initialize this
                                $icon = '<span class="fa fa-mail-reply"></span>';
                                $label = $icon . ' ' . $title;
                                $url = Yii::$app->homeUrl . 'site/refund-bill?id=' . $model->id;
                                //$options['class'] = 'view-modal';
                                $options['target'] = '_blank';

                                if (Yii::$app->user->can('site/refund-bill')) {
                                    if ($model->sale_status == 1 || $model->sale_status == 3) {


                                        return '<li>' . Html::a($label, $url, $options) . '</li>' . PHP_EOL;
                                    }
                                }
                            },
                                    'edit_sale' => function ($url, $model) {
                                $title = Yii::t('app', 'Edit Sale');
                                $options = []; // you forgot to initialize this
                                $icon = '<span class="fa fa-mail-reply"></span>';
                                $label = $icon . ' ' . $title;
                                $url = Yii::$app->homeUrl . 'site/pos?sale_id=' . $model->id;
                                //$options['class'] = 'view-modal';
                                $options['target'] = '_blank';

                                if (Yii::$app->user->can('site/refund-bill')) {
                                    return '<li>' . Html::a($label, $url, $options) . '</li>' . PHP_EOL;
                                }
                            },
                                ],
                                'headerOptions' => ['class' => 'kartik-sheet-style'],
                            ],
                        ],
                    ]);
                    ?>

</div>
