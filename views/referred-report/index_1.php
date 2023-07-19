<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemNameSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Referred Reports';
$this->params['breadcrumbs'][] = $this->title;
$create = '';

if(\Yii::$app->user->can('item-name/create')){
    $create = Html::a('<i class="fa fa-plus"></i> ' . Yii::t('app', 'Add New Test'), [
        'create'
    ], ['data-pjax' => 0,'onclick'=>'addnew(event,this)',
        'class' => 'btn btn-primary btn-sm'
    ]);
}



?>
<div class="item-name-index">


    <?php  Pjax::begin(['timeout' => '30000']); ?>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>


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
            'heading' => '<h5 class="card-title"><i class="fa fa-th-list"></i> '.Yii::t ( 'app', 'Test List' ).' </h5>',
            'showFooter' => 'false',

        ],

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            [
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'films_issued',
                'format'=>'raw',
                'value'=>function($model)
                {
                    if($model->films_issued==1)
                    {
                        return 'Yes';

                    }else {
                        return 'No';
                    }
                }


            ],
            [
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'report_issued',
                'format'=>'raw',
                'value'=>function($model)
                {
                    if($model->report_issued==1)
                    {
                        return 'Yes';

                    }else {
                        return 'No';
                    }
                }
            ],
            [
                'headerOptions' => ['style' => 'width:20%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'referred_reporting_doc_id',
                'value'=>'doc.name'

            ],
            [
                'headerOptions' => ['style' => 'width:20%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'sale_item_id',
                'value'=>'saleItem.sale.invoice_no'

            ],
            
            [
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'status',
                'format'=>'raw',
                'value'=>function($model)
                {
                    if($model->status=='Sent')
                    {
                        return 'Sent';

                    }elseif($model->status=='Received') {
                        return 'Received';
                    }elseif($model->status=='Delivered')
                    {
                        return 'Delivered';
                    }
                }


            ],
            //'status',
            //'created_on',
            [
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'created_on',
                'value' => function($model){
                    return date("d/m/Y", strtotime($model->created_on));
                },
                //'filter'=>false

            ],
            //'created_by',
            [
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'attribute' => 'created_by',
                'contentOptions' => ['class' => 'text-center'],
                'value'=>'user.username'

            ],
            [

                //'attribute' =>  'created_on',
                'header'=>'Last Update',
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'format'=>'raw',
                'visible'=> \Yii::$app->user->can('item-name/last-update'),
                'value' => function($model){
                    if($model->updated_by)
                    {
                        return date("d/m/Y h:i A", strtotime($model->updated_on)).'<br>'.\app\helpers\Helper::getUser($model->updated_by);

                    }else
                    {
                        return '';
                    }
                },
                //'filter'=>false

            ],
            //'updated_by',
            //'updated_on',

//            [
//
//                'class' => '\kartik\grid\ActionColumn',
//
//                'template' => '{update}',
//                'contentOptions' => ['style' => 'width:50px;'],
//                'buttons' => [
//
//                    'update' => function ($url, $model)
//
//                    {
//                        return '<a href="#"><span class="fa fa-pencil"  onclick="updateRecord('.$model->id.',\'item-name\',\'Update Test\',event)"></span></a>';
//                    } ,
//                ]
//            ]
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
