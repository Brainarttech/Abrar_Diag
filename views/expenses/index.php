<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ExpensesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Expenses');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
$create = Html::a('<i class="fa fa-plus"></i> ' . Yii::t('app', 'Add Expense'), [
            'create'
                ], ['data-pjax' => 0, 'onclick' => 'addWithAttachment(event,this)',
            'class' => 'btn btn-primary btn-sm'
        ]);
?>
<div class="expenses-index">
    <?php Pjax::begin(['timeout' => '30000']); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<h5 class="card-title"><i class="fa fa-th-list"></i> ' . Yii::t('app', 'List') . ' </h5>',
            'before' => $create,
            'after' => Html::a('<i class="fa fa-repeat"></i> ' . Yii::t('app', 'Reset List'), [

                'index'
                    ], [

                'class' => 'btn btn-info  btn-sm'
            ]),
            'showFooter' => false,
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            [
                'headerOptions' => ['style' => 'width:20%'],
                //'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'note',
            ],
            'amount',
            [
                'headerOptions' => ['style' => 'width:15%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'attachment',
                'format' => 'raw',
                'value' => function($model) {

            //return $model->attachment;
            return Html::a(Yii::t('app', $model->attachment), Url::to(app\helpers\Helper::getBaseUrl() . 'files/expenses/' . $model->attachment, true), ['data-pjax' => 0, 'target' => '_blank'
            ]);
        },
            //'filter'=>false
            ],
            'cat_id',
            [
                'headerOptions' => ['style' => 'width:10%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'created_on',
                'value' => function($model) {
            return date("d/m/Y", strtotime($model->created_on));
        },
            //'filter'=>false
            ],
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
                'template' => '{update}',
                'contentOptions' => ['style' => 'width:50px;'],
                'buttons' => [

                    'update' => function ($url, $model) {
                        return '<a href="#"><span class="fa fa-pencil"  onclick="updateRecord(' . $model->id . ',\'expenses\',\'Update Expenses\',event)"></span></a>';
                    },
                ]
            ]
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
