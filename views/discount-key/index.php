<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\HospitalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Discount Key';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hospital-index">

    <!--<h1><?/*= Html::encode($this->title) */?></h1>-->

    <p>
        <?php echo  Html::a('Add New Discount Key', ['create'], ['class' => 'btn btn-success pull-right add-new']) ?>
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
            'heading' => '<h5 class="card-title"><i class="fa fa-th-list"></i> '.Yii::t ( 'app', 'Keys' ).' </h5>',
            'after' => '</form>'.Html::a ( '<i class="fa fa-repeat"></i> '.Yii::t ( 'app', 'Reset List' ), [

                    'index'

                ], [

                    'class' => 'btn btn-info  btn-sm'

                ] ),

            'showFooter' => false,

        ],


        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',

            ],
            //'id',
            'key_name',
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
            'created_on',
            'created_by',
            //'updated_on',
            //'updated_by',


        ],

    ]); ?>
    <?php Pjax::end(); ?>
</div>

