<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use app\helpers\datetime;
use kartik\export\ExportMenu;

$csrftoken = Yii::$app->request->getCsrfToken();
Yii::$app->view->registerJs('var csrftoken = "'.$csrftoken.'"',  \yii\web\View::POS_HEAD);
/* @var $this yii\web\View */
\app\assets\AccountAsset::register($this);

$this->title = 'Ledger';
$this->params['breadcrumbs'][] = "Accounts Ledger";//$this->title;

?>
<div class="item-name-index">
<?php
/*$amount = 0;

if (!empty($dataProvider->getModels())) {
    foreach ($dataProvider->getModels() as $key => $val) {
        //echo $val->credit;
        //echo "<pre>";
        //echo print_r($val[debit]);
        //echo "</pre>";
        echo $key."<br>";
        $amount += $val[debit];
    }
}
*/
$varTest = 0;
$total_debit = 0;
$total_credit = 0;
$total = 0;
foreach($dataProvider->models as $m)
{
    //$total += $m['credit'];
    //echo $m['credit']."<br>";
    //echo $m['debit']."<br>";
   $total += $m['debit']-$m['credit'];
   $total_debit += $m['debit'];
   $total_credit += $m['credit'];
}
//echo $total;
//exit();
echo $this->render('_search', ['model' => $searchModel]);

//echo $varTest;
Pjax::begin();


echo GridView::widget([
    'dataProvider'=> $dataProvider,
    //'filterModel' => $searchModel,
    'toolbar' =>  [
        '{export}',
        '{toggleData}',
    ],
    'showFooter' => true,
    // set export properties
    'export' => [
        'fontAwesome' => true
    ],

    'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'before'=>false,
        'heading' => '<h5 class="card-title"><i class="fa fa-th-list"></i> '.Yii::t ( 'app', 'Account Detail' ).' </h5>',
        /*'after' => '</form>'.Html::a ( '<i class="fa fa-repeat"></i> '.Yii::t ( 'app', 'Reset List' ), [
                'index'
            ], [
                'class' => 'btn btn-info  btn-sm'
            ] ),*/
        'showFooter' => true,
    ],

    'columns' => [
        //['class' => 'yii\grid\SerialColumn'],
        [
            'headerOptions' => ['style' => 'width:20%','class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'attribute' =>  'charts_of_accounts_id',
            'header' => '<a href="#" data-sort="accounts">Accounts</a>',
            'value'=>'chartsOfAccounts.account_name',
        ],
        [
            'headerOptions' => ['style' => 'width:15%','class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'attribute' =>  'Date',
            'value' => function($model){
                return datetime::getDate($model->created_on);
            },
        ],
        [
            'headerOptions' => ['style' => 'width:40%','class' => 'text-center'],
            'attribute' => 'description',
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'headerOptions' => ['style' => 'width:15%','class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'attribute' =>  'Expense',
            'value'=>function($model, $key, $index, $column)
            {
                return $model->debit;
            },
            'footer' => $total_debit,
        ],
        [
            'headerOptions' => ['style' => 'width:15%','class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'attribute' =>  'Income',
            'value' => function($model){
                return $model->credit;
            },
            'footer' => $total_credit,
        ],
        [
            'headerOptions' => ['style' => 'width:15%','class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'attribute' =>  'Balance',
            'value'=>function($model, $key, $index, $column) use (&$varTest)
            {
                $varTest += $model['debit']-$model['credit'];
                return $varTest;
            },
            'footer' => $total,
        ],
    ],
    //'showPageSummary' => true,
]);


// Generate a bootstrap responsive striped table with row highlighted on hover
/*echo GridView::widget([
    'dataProvider'=> $dataProvider,
    //'filterModel' => $searchModel,
    'showFooter' => true,
    'toolbar' =>  [
        '{export}',
        '{toggleData}',
    ],
    // set export properties
    'export' => [
        'fontAwesome' => true
    ],

    'panel' => [
        'type' => GridView::TYPE_DEFAULT,
        'before'=>false,
        'heading' => '<h5 class="card-title"><i class="fa fa-th-list"></i> '.Yii::t ( 'app', 'Account Ledger' ).' </h5>',
        'after' => '</form>'.Html::a ( '<i class="fa fa-repeat"></i> '.Yii::t ( 'app', 'Reset List' ), [
                'index'
            ], [
                'class' => 'btn btn-info  btn-sm'
            ] ),
        'showFooter' => true,
    ],

    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'headerOptions' => ['style' => 'width:20%','class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'attribute' =>  'charts_of_accounts_id',
            'header' => '<a href="#" data-sort="accounts">Accounts</a>',
            'value'=>'chartsOfAccounts.account_name',
        ],
        [
            'headerOptions' => ['style' => 'width:15%','class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'attribute' =>  'Date',
            'value' => function($model){
                return datetime::getDate($model->created_on);
            },
        ],
        [
            'headerOptions' => ['style' => 'width:40%','class' => 'text-center'],
            'attribute' => 'description',
            'contentOptions' => ['class' => 'text-center'],
        ],
        [
            'headerOptions' => ['style' => 'width:15%','class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'attribute' =>  'Expense',
            'value'=>function($model, $key, $index, $column)
            {
                return $model->debit;
            },
            'footer' => $total_debit,
        ],
        [
            'headerOptions' => ['style' => 'width:15%','class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'attribute' =>  'Income',
            'value' => function($model){
                return $model->credit;
            },
            'footer' => $total_credit,
        ],
        [
            'headerOptions' => ['style' => 'width:15%','class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'attribute' =>  'Balance',
            'value'=>function($model, $key, $index, $column) use (&$varTest)
            {
                $varTest += $model['debit']-$model['credit'];
                return $varTest;
            },
            'footer' => $total,
        ],
    ],
]);*/

Pjax::end();

?>

</div>