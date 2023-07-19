<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemNameSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Purchases';
$this->params['breadcrumbs'][] = $this->title;
$create = '';

if(\Yii::$app->user->can('item-name/create')){
    $create = Html::a('<i class="fa fa-plus"></i> ' . Yii::t('app', 'Add New Purchase'), [
        '/inventory/create'
    ], ['class' => 'btn btn-primary btn-sm'
    ]);
}



?>
<div class="purchase-index">


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
            'heading' => '<h5 class="card-title"><i class="fa fa-th-list"></i> '.Yii::t ( 'app', 'Purchase List' ).' </h5>',
            'before'=>$create.'&nbsp;&nbsp;'.Html::a('<i class="fa fa-sync"></i> '.Yii::t ( 'app', 'Reset List' ), ['index'], ['class' => 'btn btn-info btn-sm']).' ',
            'showFooter' => 'false',

        ],

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'headerOptions' => ['style' => 'width:20%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'paid',

            ],

            'total',
            /*[
                'headerOptions' => ['style' => 'width:6%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'balance',

                //'filter'=>false

            ],*/
            [
                'headerOptions' => ['style' => 'width:6%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'due_date',
                'value' => function($model){
                    return date("d/m/Y", strtotime($model->due_date));
                },
                //'filter'=>false

            ],
            [
                'headerOptions' => ['style' => 'width:6%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'supplier_id',
                'value' => 'supplier.name'
                //'filter'=>false

            ],

            
            
            [
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'status',
                'format'=>'raw',
                'value'=>function($model)
                {
                    if ($model->status == 'Paid') {
                        return '<span class="btn btn-success btn-sm">Completed</span>';
                    } elseif ($model->status == 'Payment Pending') {
                        return '<span  class="btn btn-warning btn-sm">Pending</span>';
                    } elseif ($model->status == 'Partially Paid') {
                        return '<span  class="btn btn-primary btn-sm">Partial Transfer</span>';
                    } else {
                        return '<span  class="btn btn-danger btn-sm">Returned</span>';
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

            [

                'class' => '\kartik\grid\ActionColumn',

                'template' => '{update}',
                'contentOptions' => ['style' => 'width:50px;'],
                'buttons' => [

                    'update' => function ($url, $model)

                    {
                        return '<a href="#"><span class="fa fa-pencil"  onclick="updateRecord('.$model->id.',\'purchase\',\'Update Purchase\',event)"></span></a>';
                    } ,
                ]
            ]
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
