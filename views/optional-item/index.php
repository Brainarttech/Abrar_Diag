<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemNameSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Optional Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-name-index">

    <p>
        <?php echo  Html::a('Add New Product', ['create'], ['class' => 'btn btn-success pull-right add-new']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


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
            'heading' => '<h5 class="card-title"><i class="fa fa-th-list"></i> '.Yii::t ( 'app', 'Optional Products' ).' </h5>',
            'after' => '</form>'.Html::a ( '<i class="fa fa-repeat"></i> '.Yii::t ( 'app', 'Reset List' ), [

                    'index'

                ], [

                    'class' => 'btn btn-info  btn-sm'

                ] ),

            'showFooter' => false,

        ],

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'product_name',
            [
                'headerOptions' => ['style' => 'width:20%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'cat_id',
                'value'=>'category.name'

            ],

            [
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'status',
                'format'=>'raw',
                'value'=>function($model)
                {
                    if($model->status==1)
                    {
                        return '<span class="btn btn-success btn-sm">Active</span>';

                    }else {
                        return '<span  class="btn btn-danger btn-sm">InActive</span>';
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
            //'updated_by',
            //'updated_on',

            [

                'class' => '\kartik\grid\ActionColumn',

                'template' => '{update}',
                'contentOptions' => ['style' => 'width:50px;'],
                'buttons' => [

                    'update' => function ($url, $model)

                    {
                        return '<a href="#"><span class="fa fa-pencil"  onclick="updateRecord('.$model->id.',\'optional-item\',\'Update Product\',event)"></span></a>';
                    } ,
                ]
            ]
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
