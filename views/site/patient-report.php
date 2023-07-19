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

$this->title = 'Download Patient Reports';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="department-index">


    <!-- <h1><?/*= Html::encode($this->title) */?></h1>-->
    <?php echo $this->render('patient_report_search', ['model' => $searchModel]); ?>


<!--<p>
    <?//= Html::a('Create Sales', ['create'], ['class' => 'btn btn-success']) ?>
</p>-->
<?php if ($dataProvider->totalCount > 0) { ?>
    <?php Pjax::begin(); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
      //  'filterModel' => $searchModel,
        'toolbar' => [
           // '{export}',
           // '{toggleData}',
        ],
        // set export properties
        // 'export' => [
        //     'fontAwesome' => true
        // ],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<h5 class="card-title">
			<i class="fa fa-th-list"></i> ' . 
			Yii::t('app', 'Download Patient Report') .
			' </h5>',
           
            //'showFooter' => false,
        ],
        'columns' => [
            [
                'class' => 'kartik\grid\SerialColumn',
                'contentOptions' => ['class' => 'kartik-sheet-style'],
                'width' => '36px',
                'header' => '',
                'headerOptions' => ['class' => 'kartik-sheet-style']
            ],
          //  'id',
            //'hospital_id',
            [
                'headerOptions' => ['style' => 'width:10%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'patient_invoice',
                'header' => 'Receipt No',
                //'attribute' =>  'sale.invoice_no',
                'value' => 'sale.invoice_no',
                'group' => true,
            ],
			[
                'headerOptions' => ['style' => 'width:10%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'patient_invoice',
                'header' => 'Patient Id',
                //'attribute' =>  'sale.invoice_no',
                'value' => 'sale.patient.reg_no',
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
           /* [
                'headerOptions' => ['style' => 'width:10%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'item_id',
                'header' => 'Department',
                'value' => 'item.category.department.name'
            ],*/
            [ 
                'headerOptions' => ['style' => 'width:15%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'item_name',
				'header' => 'Test Name',
            ],
          /*  [
                'headerOptions' => ['style' => 'width:10%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'item_price',
            ],*/
            [
                'headerOptions' => ['style' => 'width:15%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'created_on',
				'header' => 'Entry Date / Time',
                'format' => 'raw',
                'value' => function($model) {
                    return \app\helpers\datetime::saleDateTime($model->created_on);
                },
            //'group'=>true,
            ],
            /*[
                'headerOptions' => ['style' => 'width:10%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'test_status',
                'format' => 'raw',
                'value' => function($model) {
                   
                    if ($model->test_status == "2"){
                        return '<span class="m-badge m-badge--success m-badge--wide">Complete</span>';
                    }
                        if ($model->test_status == "1"){
                        return '<span class="m-badge m-badge--primary m-badge--wide">Pending</span>';
                        }
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
                'value' => 'update.username',
				'header' => 'Preformed By',
            ],*/
          /*  [
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
            ],*/
            [
                'class' => 'kartik\grid\ActionColumn',
                'dropdown' => false,
                //'dropdownOptions' => ['class' => 'pull-right dropup'],
                'template' => '{print_report}',
                'buttons' => [
                    'print_report' => function ($url, $model) {
                        $title = Yii::t('app', 'Download');
                     //   $options = []; // you forgot to initialize this
                        //$icon = '<span class="fa fa"></span>';
                        $label = $title;
                        $url = Yii::$app->homeUrl . 'site/patient-lab-form-print-pdf?id=' . $model->id;
                        // $options['target'] = '_blank';
                        $options = ['data-pjax' => 0, 'onclick' => "generateReport(event,this)",'class' =>'btn btn-danger btn-download-report'];
                            return  Html::a($label, $url, $options)  . PHP_EOL;
                    
                    },
                    
                ],
                'headerOptions' => ['class' => 'kartik-sheet-style'],
            ],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
<?php }else{
    if( Yii::$app->request->get('SalesItemSearch') != ''){
    ?>
    
    <div classs="text-center">No records available</div>
<?php } }?>

<script>
    setInterval(() => {
        $("button:contains('Send')").remove();
        $("button:contains('Remarks')").remove();
    }, 100);
    
    $('.card-header').removeClass('bg-primary').css('background-color', '#A34850');
    $('.btn-download-report').css('background-color', '#A34850');
    </script>
