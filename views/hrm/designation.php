<?php

use yii\helpers\Html;
use app\helpers\Helper;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DepartmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Designation';
$this->params['breadcrumbs'][] = $this->title;

//if(\Yii::$app->user->can('hrm/department')){
if(true){
    $create = Html::a('<i class="fa fa-plus"></i> ' . Yii::t('app', 'Add New Designation'), [
        'create-designation'
    ], ['data-pjax' => 0,'onclick'=>'addnew(event,this)',
        'class' => 'btn btn-primary btn-sm'
    ]);
}

?>
<div class="department-index">

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
            'heading' => '<h5 class="card-title"><i class="fa fa-th-list"></i> '.Yii::t ( 'app', 'Designation' ).' </h5>',
            'before'=>$create,
            'after' => '</form>'.Html::a ( '<i class="fa fa-repeat"></i> '.Yii::t ( 'app', 'Reset List' ), [
                    'designation'
                ], [
                    'class' => 'btn btn-info  btn-sm'
                ] ),
            'showFooter' => false,
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'designation_name',
            //'phone_no',
            //'department.name',
            //[
                //'attribute' => 'department',
                //'value' => 'department.name'
            //],
            /*[
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'department',
                'value'=> function($model){
                    return $model->department->name;
                    //echo "<pre>";
                    //echo print_r($model->department->name);
                    //echo "</pre>";
                    //return $model->department;
                },
                'filter' => true,

            ],*/
            [
                //'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'status',
                'format'=>'raw',
                //'filter' => false,
                'value'=> function($model){
                    return Helper::statusLabel($model->status);
                },
                'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                'filter' => [
                    0 => 'Inactive',
                    1 => 'Active',
                ],
                'filterWidgetOptions' => [
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ],
                'filterInputOptions' => ['placeholder' => 'All...'],

            ],
            'created_on',
            //'created_by',
            [
                //'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'created_by',
                'format'=>'raw',
                'value'=> function($model){
                	return Helper::getUser($model->created_by);
                },

            ],
            [
                'class' => '\kartik\grid\ActionColumn',
                'template' => '{update}',
                'contentOptions' => ['style' => 'width:50px;'],
                'buttons' => [
                    'update' => function ($url, $model)
                    {
                        return '<a href="#"><span class="fa fa-pencil"  onclick="updateRecord('.$model->id.',\'hrm\',\'Update Designation\',event,\'update-designation\')"></span></a>';
                    },
                ]
            ] ,
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
