<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PatientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Patients';
$this->params['breadcrumbs'][] = $this->title;
$create = '';

if(\Yii::$app->user->can('patient/create')){
    $create = Html::a('<i class="fa fa-plus"></i> ' . Yii::t('app', 'Add New Patient'), [
        'create'
    ], ['data-pjax' => 0,'onclick'=>'addnew(event,this)',
        'class' => 'btn btn-primary btn-sm'
    ]);
}



?>
<div class="patient-index">


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
            'heading' => '<h5 class="card-title"><i class="fa fa-th-list"></i> '.Yii::t ( 'app', 'Patient List' ).' </h5>',
            'before'=>$create.'&nbsp;&nbsp;'.Html::a('<i class="fa fa-sync"></i> '.Yii::t ( 'app', 'Reset List' ), ['index'], ['class' => 'btn btn-info btn-sm']).' ',
            'showFooter' => 'false',

        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'reg_no',
            'name',
            //'cnic',
            'phone_no',
            //'reg_no',
            //'email:email',
            'gender',
            'age',
            'relationship',
            'whatsapp_no',
            'city',
            'country',
            //'address',
            //'referred_by_id',
            //'panel_id',
            [
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'status',
                'format'=>'raw',
                'value'=> function($model){
                    if($model->status=="1")
                        return '<span class="m-badge m-badge--success m-badge--wide">Active</span>';
                    else
                        return '<span class="m-badge m-badge--danger m-badge--wide">In Active</span>';

                },

            ],
            'created_on',
            //'created_by',
            //'updated_on',
            //'updated_by',
            [

                //'attribute' =>  'created_on',
                'header'=>'Last Update',
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'format'=>'raw',
                'visible'=> \Yii::$app->user->can('patient/last-update'),
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
                        return '<a href="'.$url.'" onclick="viewmodal(this,event)" ><span class="fa fa-eye""></span></a>	&nbsp;';


                    } ,

                    'update' => function ($url, $model)

                    {
                        return '<a href="#"><span class="fa fa-pencil"  onclick="updateRecord('.$model->id.',\'patient\',\'Update Patient\',event)"></span></a>';


                    } ,


                ]



            ] ,
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
