<?php

use yii\helpers\Html;
use kartik\grid\GridView;

//use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemNameSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inventory';
$this->params['breadcrumbs'][] = $this->title;
$create = '';

if (\Yii::$app->user->can('item-name/create')) {
    $create = Html::a('<i class="fa fa-plus"></i> ' . Yii::t('app', 'Add New Inventory'), [
                'create'
                    ], [
                'class' => 'btn btn-primary btn-sm'
    ]);
}
?>
<div class="inventory-index">

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>


    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'toolbar' => [
            '{export}',
            '{toggleData}',
        ],
        // set export properties
        'export' => [
            'fontAwesome' => true
        ],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<h5 class="card-title"><i class="fa fa-th-list"></i> ' . Yii::t('app', 'Inventory List') . ' </h5>',
            'before' => $create . '&nbsp;&nbsp;' . Html::a('<i class="fa fa-sync"></i> ' . Yii::t('app', 'Reset List'), ['index'], ['class' => 'btn btn-info btn-sm']) . ' ',
            'showFooter' => 'false',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'label' => 'Product Name',
                'headerOptions' => ['style' => 'width:20%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'product_id',
                'value' => 'product.name'
            ],
            [
                'label' => 'Variant Name',
                'headerOptions' => ['style' => 'width:20%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'variant_id',
                'value' => 'variant.name'
            ],
            [
                'label' => 'Purchase Unit Name',
                'headerOptions' => ['style' => 'width:20%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'unit_id',
                'value' => 'unit.name'
            ],
            [
                'label' => 'Sale Unit Name',
                'headerOptions' => ['style' => 'width:20%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'sale_unit_id',
                'value' => 'saleUnit.name'
            ],
            [
                'label' => 'Invoice Number',
                'headerOptions' => ['style' => 'width:20%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'purchase_id',
                'value' => 'purchase.invoice_number'
            ],
            'quantity',
            'expiry_date',
            //'price',
            [
                'headerOptions' => ['style' => 'width:6%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'cost_price',
            //'filter'=>false
            ],
            'tax',
            [
                'headerOptions' => ['style' => 'width:10%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($model) {
                    if ($model->status == 1) {
                        return '<span class="btn btn-success btn-sm">Active</span>';
                    } else {
                        return '<span  class="btn btn-danger btn-sm">InActive</span>';
                    }
                }
            ],
            //'status',
            //'created_on',
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
            [
                //'attribute' =>  'created_on',
                'header' => 'Last Update',
                'headerOptions' => ['style' => 'width:10%', 'class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'format' => 'raw',
                'visible' => \Yii::$app->user->can('item-name/last-update'),
                'value' => function($model) {
                    if ($model->updated_by) {
                        return date("d/m/Y h:i A", strtotime($model->updated_on)) . '<br>' . \app\helpers\Helper::getUser($model->updated_by);
                    } else {
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
                    'update' => function ($url, $model) {
                        return "<a href='update?id=$model->id'><span class='fa fa-pencil' ></span></a>";
                    },
                ]
            ]
        ],
    ]);
    ?>
</div>
