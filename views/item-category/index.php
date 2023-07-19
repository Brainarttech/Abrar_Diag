<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Item Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-category-index">

    <p>
        <?php echo  Html::a('Add New Category', ['create'], ['class' => 'btn btn-success pull-right add-new']) ?>
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
            'heading' => '<h5 class="card-title"><i class="fa fa-th-list"></i> '.Yii::t ( 'app', 'Category' ).' </h5>',
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
            'name',
            [
                'attribute' => 'department_id',
                'value'=>'department.name'

            ],
            
            'status',
            'created_on',
            'created_by',
            
            //'updated_by',
            //'updated_on',

            [

                'class' => '\kartik\grid\ActionColumn',

                'template' => '{update}',
                'contentOptions' => ['style' => 'width:50px;'],
                'buttons' => [

                    'update' => function ($url, $model)

                    {
                        return '<a href="#"><span class="fa fa-pencil"  onclick="updateRecord('.$model->id.',\'item-category\',\'Update Category\',event)"></span></a>';


                    } ,


                ]



            ]
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
