<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ExpensesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Expense Report');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php



?>
<div class="expenses-index">
    <?php Pjax::begin(['timeout' => '30000']); ?>
    <?php  echo $this->render('_expense_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<h5 class="card-title"><i class="fa fa-th-list"></i> '.Yii::t ( 'app', 'Generated Report' ).' </h5>',
            'after' => Html::a ( '<i class="fa fa-repeat"></i> '.Yii::t ( 'app', 'Reset List' ), [

                    'index'

                ], [

                    'class' => 'btn btn-info  btn-sm'

                ] ),
            'before'=>'<a class="btn btn-success margin-right"  target=_blank href="#"><i class="fa fa-print">  Print</i></a>',

            'showFooter' => true,

        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'headerOptions' => ['style' => 'width:30%'],
                //'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'note',

            ],
            'amount',

            [

                //'contentOptions' => ['class' => 'text-center'],
                'attribute' => 'cat_id',
                'value'=>'cat.name',

            ],
            [
                'headerOptions' => ['style' => 'width:20%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'attribute' =>  'created_on',
                'value' => function($model){
                    return date("d/m/Y H:i: A", strtotime($model->created_on));
                },
                //'filter'=>false

            ],
            [
                'headerOptions' => ['style' => 'width:20%','class' => 'text-center'],
                'attribute' => 'created_by',
                'contentOptions' => ['class' => 'text-center'],
                'value'=>'user.username'

            ],
            //'updated_on',
            //'updated_by',
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
