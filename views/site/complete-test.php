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

$this->title = 'Complete Dignostics Tests';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="department-index">


    <!-- <h1><?/*= Html::encode($this->title) */?></h1>-->
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>


<!--<p>
    <?/*= Html::a('Create Sales', ['create'], ['class' => 'btn btn-success']) */?>
</p>-->


    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
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
            'heading' => '<h5 class="card-title"><i class="fa fa-th-list"></i> ' . Yii::t('app', 'Complete Dignostics Tests') . ' </h5>',
            'after' => '</form>' . Html::a('<i class="fa fa-repeat"></i> ' . Yii::t('app', 'Reset List'), [
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
                'headerOptions' => ['style' => 'width:10%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'patient_invoice',
                'header' => 'Patient Id',
                //'attribute' =>  'sale.invoice_no',
                'value' => 'sale.invoice_no',
                'group' => true,
            ],
            //[
            //'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
            //'contentOptions' => ['class' => 'text-center'],
            //'attribute' =>  'sale_id',
            //'header'=>'Patient Id',
            //'attribute' =>  'sale.invoice_no',
            //'value'=>'sale.invoice_no',
            //'group'=>true,
            //],
            [
                'headerOptions' => ['style' => 'width:15%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'patient_name',
                'value' => 'sale.patient.name',
                //'filterType' => GridView::FILTER_SELECT2,
                //'filter' => ArrayHelper::map(\app\models\Patient::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                //'filterWidgetOptions' => [
                //'pluginOptions' => ['allowClear' => true],
                //'options' => ['multiple' => true]
                //],
                //'filterInputOptions' => ['placeholder' => 'Patient Name'],
                'format' => 'raw',
            //'group'=>true,  // enable grouping
            //'subGroupOf'=>1
            // 'group'=>true,
            ],
            [
                'headerOptions' => ['style' => 'width:10%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'item_id',
                'header' => 'Department',
                'value' => 'item.category.department.name'
            ],
            [
                'headerOptions' => ['style' => 'width:15%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'item_name',
            ],
            [
                'headerOptions' => ['style' => 'width:10%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'item_price',
            ],
            [
                'headerOptions' => ['style' => 'width:15%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'created_on',
                'format' => 'raw',
                'value' => function($model) {
                    return \app\helpers\datetime::saleDateTime($model->created_on);
                },
            //'group'=>true,
            ],
            [
                'headerOptions' => ['style' => 'width:10%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'test_status',
                'format' => 'raw',
                'value' => function($model) {
                    if ($model->test_status == "2")
                        return '<span class="m-badge m-badge--success m-badge--wide">Complete</span>';
                },
                'filter' => false,
            ],
            [
                'headerOptions' => ['style' => 'width:15%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                //'header'=>'Complete Date',
                'attribute' => 'updated_on',
                'format' => 'raw',
                'value' => function($model) {
                    return \app\helpers\datetime::saleDateTime($model->updated_on);
                },
            //'group'=>true,
            ],
            [
                'headerOptions' => ['style' => 'width:15%', 'class' => 'text-center'],
                'attribute' => 'updated_by',
                'contentOptions' => ['class' => 'text-center'],
                'value' => 'update.username'
            ],
            [
                'headerOptions' => ['style' => 'width:15%', 'class' => 'text-center'],
                'attribute' => 'Referred Reporting Doctor',
                'contentOptions' => ['class' => 'text-center'],
                'value' => 'referredReport.doc.name'
            ],
            [
                'headerOptions' => ['style' => 'width:15%', 'class' => 'text-center'],
                'attribute' => 'Referred Reporting Status',
                'contentOptions' => ['class' => 'text-center'],
                'value' => 'referredReport.status'
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'dropdown' => true,
                'dropdownOptions' => ['class' => 'pull-right dropup'],
                'template' => '{edit_test}{view_extra}{print_report}{reporting_doc}{send_pdf}',
                'buttons' => [
                    'edit_test' => function ($url, $model) {
                        if($model->item->category->department->id == 10){
                        $title = Yii::t('app', 'Edit Test');
                        $options = []; // you forgot to initialize this
                        $icon = '<span class="fa fa-edit"></span>';
                        $label = $icon . ' ' . $title;
                        $url = Yii::$app->homeUrl . 'site/edit-sale-item?id=' . $model->id;
                        // $options['target'] = '_blank';
                        return '<li>' . Html::a($label, $url, $options) . '</li>' . PHP_EOL;
                        }
                    },
                    'view_extra' => function ($url, $model) {
                        $title = Yii::t('app', 'View Report');
                        $options = []; // you forgot to initialize this
                        $icon = '<span class="fa fa-eye"></span>';
                        $label = $icon . ' ' . $title;
                        $url = Yii::$app->homeUrl . 'site/view-sale-item?id=' . $model->id;
                        // $options['target'] = '_blank';
                        return '<li>' . Html::a($label, $url, $options) . '</li>' . PHP_EOL;
                    },
                    'print_report' => function ($url, $model) {
                        $title = Yii::t('app', 'Print Report');
                        $options = []; // you forgot to initialize this
                        $icon = '<span class="fa fa-print"></span>';
                        $label = $icon . ' ' . $title;
                        $url = Yii::$app->homeUrl . 'site/lab-form-print?id=' . $model->id;
                        // $options['target'] = '_blank';
                        $options = ['data-pjax' => 0, 'target' => "_blank"];
                        $departmentIds = [10, 5, 6, 1, 8, 9];

if (in_array(Yii::$app->user->identity->assign_department, $departmentIds)) {
    return '<li>' . Html::a($label, $url, $options) . '</li>' . PHP_EOL;
}
                    },
                    'reporting_doc' => function ($url, $model) {
                        $title = Yii::t('app', 'Reporting Doc.');
                        $options = []; // you forgot to initialize this
                        $icon = '<span class="fa fa-user-md"></span>';
                        $label = $icon . ' ' . $title;
                        $url = Yii::$app->homeUrl . 'referred-report/create?id=' . $model->id;
                        // $options['target'] = '_blank';
                        $options = ['data-pjax' => 0, 'onclick' => "addnew(event,this)"];

                        return '<li>' . Html::a($label, $url, $options) . '</li>' . PHP_EOL;
                    },
                    'send_pdf' => function ($url, $model) {
                        //Title
                        $title = Yii::t('app', 'View & Send Report');
                        $options = []; // you forgot to initialize this
                        $icon = '<span class="fa fa-envelope"></span>';
                        $label = $icon . ' ' . $title;
                        $url = Yii::$app->homeUrl . 'site/lab-form-print-pdf?id=' . $model->id;
                        // $options['target'] = '_blank';
                                          // $options['target'] = '_blank';
                        $options = ['data-pjax' => 0, 'onclick' => "generateReport(event,this)"];
                        $departmentIds = [10, 5, 6, 1, 8, 9];

if (in_array(Yii::$app->user->identity->assign_department, $departmentIds)) {
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

