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

$this->title = 'Pending Dignostics Tests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-index">

    <!-- <h1><?/*= Html::encode($this->title) */?></h1>-->
    <?php echo $this->render('_pending_search', ['model' => $searchModel]); ?>

    <!--<p>
        <?/*= Html::a('Create Sales', ['create'], ['class' => 'btn btn-success']) */?>
    </p>-->

    <?php Pjax::begin(); ?>

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

        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<h5 class="card-title"><i class="fa fa-th-list"></i> '.Yii::t ( 'app', 'Pending Dignostics Tests' ).' </h5>',
            'after' => '</form>'.Html::a ( '<i class="fa fa-repeat"></i> '.Yii::t ( 'app', 'Reset List' ), [
                'index'
            ],
			['class' => 'btn btn-info  btn-sm']),
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
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
				'attribute' =>  'patient_invoice',
                'header'=>'Patient Id',
                //'attribute' =>  'sale_id',
                'value'=>'sale.invoice_no',
                'group'=>true,

            ],
            [
                'headerOptions' => ['style' => 'width:15%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'patient_name',
                'value'=>'sale.patient.name',
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
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'item_id',
                'value'=>'item.category.department.name'

            ],
            [
                'headerOptions' => ['style' => 'width:15%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'item_name',

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
                'value' => function($model){
                    return \app\helpers\datetime::saleDateTime($model->created_on);
                },
                //'group'=>true,

            ],
            [
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'test_status',
                'format'=>'raw',
                'value'=> function($model){
                    if($model->test_status=="1")
                        return '<span class="m-badge m-badge--danger m-badge--wide">Pending</span>';

                },
                'filter'=>false,

            ],

            [
            'class' => 'kartik\grid\ActionColumn',
            //'dropdown' => true,
            //'dropdownOptions' => ['class' => 'pull-right'],
            'template' => '{add_extra}',
            'buttons' => [
                'add_extra' => function ($url, $model) {
                    $title = Yii::t('app', 'Open');
                    $options = []; // you forgot to initialize this
                    $icon = '<span class="fa fa-check-circle"></span>';
                    $label = $icon . ' ' . $title;
                    $url = Yii::$app->homeUrl.'site/update-sale-item?id='.$model->id;
                   // $options['target'] = '_blank';
                    return '<button class="btn btn-default">' . Html::a($label, $url, $options) . '</button>' . PHP_EOL;
                },
            ],
            'headerOptions' => ['class' => 'kartik-sheet-style'],
        ],
    ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

