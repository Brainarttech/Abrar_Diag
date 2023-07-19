<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\models\AccountTransactionsSearch;

$csrftoken = Yii::$app->request->getCsrfToken();
Yii::$app->view->registerJs('var csrftoken = "'.$csrftoken.'"',  \yii\web\View::POS_HEAD);
/* @var $this yii\web\View */
\app\assets\AccountAsset::register($this);

$this->title = 'Accounts';
$this->params['breadcrumbs'][] = "Accounts Detail";//$this->title;

?>
<div class="item-name-index">
    <p>
        <?= Html::a('Add Income', ['income-account'], ['class' => 'btn btn-success pull-right add-new-income']) ?>
    </p>
    <p>
        <?php echo  Html::a('Add Expense', ['expense-account'], ['class' => 'btn btn-success pull-right add-new-expense']) ?>
    </p>
<?php

/*$grid_columns=[         
    [
        'attribute' => 'debit',
        'footer'=>AccountTransactionsSearch::pageTotal($dataProvider->models,'debit'),
    ]
];*/
//$grid_columns123=AccountTransactionsSearch::pageTotal($dataProvider->models,'debit');

/*echo "<pre>";
echo print_r($grid_columns);
echo "</pre>";*/

Pjax::begin();
$abc=AccountTransactionsSearch::pageTotal($dataProvider->models,'debit');

// Generate a bootstrap responsive striped table with row highlighted on hover
echo GridView::widget([
    'dataProvider'=> $dataProvider,
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
        'heading' => '<h5 class="card-title"><i class="fa fa-th-list"></i> '.Yii::t ( 'app', 'Account Detail' ).' </h5>',
        'after' => '</form>'.Html::a ( '<i class="fa fa-repeat"></i> '.Yii::t ( 'app', 'Reset List' ), [

                'index'

            ], [

                'class' => 'btn btn-info  btn-sm'

            ] ),

        'showFooter' => true,

    ],

    'columns' => [
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
            'attribute' =>  'debit',
            //'pageSummary' => true,
            //'footer'=>AccountTransactionsSearch::pageTotal($dataProvider->models,'debit'),
            'footer'=>$abc,
        ],
        [
            'headerOptions' => ['style' => 'width:15%','class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'attribute' =>  'credit',
            //'pageSummary' => true,
        ],
        [
            'headerOptions' => ['style' => 'width:40%','class' => 'text-center'],
            'attribute' => 'description',
            'contentOptions' => ['class' => 'text-center'],
        ],
        [

            'class' => '\kartik\grid\ActionColumn',

            'template' => '{update}',
            'contentOptions' => ['style' => 'width:10%'],
            'buttons' => [

                'update' => function ($url, $model)

                {
                    return '<a href="#"><span class="fa fa-pencil"  onclick="updateTransaction('.$model->id.',\'transactions\',\'update\',event)"></span></a>';
                },
            ]
        ]
    ],
    //'showPageSummary' => true,
    'showFooter' => true,
]);

Pjax::end();

?>

</div>