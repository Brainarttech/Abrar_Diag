<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lab Form';
$this->params['breadcrumbs'][] = $this->title;
$create = '';


$create = Html::a('<i class="fa fa-plus"></i> ' . Yii::t('app', 'Add New Lab Form'), [
            'create'
                ], ['data-pjax' => 0, 'onclick' => 'addnew(event,this)',
            'class' => 'btn btn-primary btn-sm'
        ]);
?>
<div class="lab-form-index">

    <?php Pjax::begin(['timeout' => '30000']); ?>


    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<h5 class="card-title"><i class="fa fa-th-list"></i> ' . Yii::t('app', 'Lab Form') . ' </h5>',
            'before' => $create . '&nbsp;&nbsp;' . Html::a('<i class="fa fa-sync"></i> ' . Yii::t('app', 'Reset List'), ['index'], ['class' => 'btn btn-info btn-sm']) . ' ',
            'showFooter' => 'false',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'form_name',
            'title',
           
            ['attribute' => 'Test Names',
                'value' => function($model) {

                    $items = [];
                   // print_r($model->itemNames);
                    //return 1;
                    foreach ($model->itemNames as $name) {

                        $items[] = $name->name;
                    }
                    return implode(', ', $items);
                }],
            [
                'headerOptions' => ['style' => 'width:10%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'created_on',
                'value' => function($model) {
                    return date("d/m/Y", strtotime($model->created_on));
                },
            //'filter'=>false
            ],
            //'created_by',
            [
                'headerOptions' => ['style' => 'width:10%', 'class' => 'text-center'],
                'attribute' => 'created_by',
                'contentOptions' => ['class' => 'text-center'],
                'value' => 'user.username'
            ],
            //'updated_on',
            //'updated_by',
            [
                'class' => '\kartik\grid\ActionColumn',
                'template' => '{view} {update}',
                'contentOptions' => ['style' => 'width:50px;'],
                'buttons' => [
                    'view' => function ($url, $model) {
                        return '<a href="' . $url . '"><span class="fa fa-eye"></span></a><a href="#"><span class="fa fa-pencil"  onclick="updateRecord(' . $model->id . ',\'lab-form\',\'Update Lab Form\',event)"></span></a>';
                    },
                ]
            ]
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
