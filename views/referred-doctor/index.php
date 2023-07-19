<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ReferredDoctorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Referred Doctors';
$this->params['breadcrumbs'][] = $this->title;
$create = '';

if(\Yii::$app->user->can('referred-doctor/create')){
    $create = Html::a('<i class="fa fa-plus"></i> ' . Yii::t('app', 'Add New Referred'), [
        'create'
    ], ['data-pjax' => 0,'onclick'=>'addnew(event,this)',
        'class' => 'btn btn-primary btn-sm'
    ]);
}
?>
<div class="referred-doctor-index">


    <?php  Pjax::begin(['timeout' => '30000']); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>


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
            'heading' => '<h5 class="card-title"><i class="fa fa-th-list"></i> '.Yii::t ( 'app', 'Referred List' ).' </h5>',
            'before'=>$create.'&nbsp;&nbsp;'.Html::a('<i class="fa fa-sync"></i> '.Yii::t ( 'app', 'Reset List' ), ['index'], ['class' => 'btn btn-info btn-sm']).' ',
            'showFooter' => 'false',

        ],

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'hospital_name',
            'cnic',
            'phone_no',
            'email:email',
            'address',
            //'commission',
            //'status',
            //'created_on',
            //'created_by',
            //'updated_by',
            //'updated_on',
            [

                //'attribute' =>  'created_on',
                'header'=>'Last Update',
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'format'=>'raw',
                'visible'=> \Yii::$app->user->can('referred-doctor/last-update'),
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

            [

                'class' => '\kartik\grid\ActionColumn',

                'template' => '{view}{update}',
                'contentOptions' => ['style' => 'width:50px;'],
                'buttons' => [
                    'view' => function ($url, $model)

                    {
                        return '<a href="'.$url.'" class="view-modal"><span class="fa fa-eye""></span></a>	&nbsp;';


                    } ,

                    'update' => function ($url, $model)

                    {
                        return '<a href="#"><span class="fa fa-pencil"  onclick="updateRecord('.$model->id.',\'referred-doctor\',\'Update Referred\',event)"></span></a>';


                    } ,


                ]



            ] ,
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
