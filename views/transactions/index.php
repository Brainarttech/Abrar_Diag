<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

$csrftoken = Yii::$app->request->getCsrfToken();
Yii::$app->view->registerJs('var csrftoken = "'.$csrftoken.'"',  \yii\web\View::POS_HEAD);
/* @var $this yii\web\View */
\app\assets\AccountAsset::register($this);

use kartik\icons\Icon;
// Icon::map($this);
Icon::map($this, Icon::FA);

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

Pjax::begin();

// Generate a bootstrap responsive striped table with row highlighted on hover
echo GridView::widget([
    'dataProvider'=> $dataProvider,
    'filterModel' => $searchModel,
	// set your toolbar
    'toolbar' => [
        // [
			// 'content'=>
				// Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'Add Book', 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
				// Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>'Reset Grid'])
        // ],
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
        'after' => '</form>'.Html::a ( '<i class="fas fa-redo"></i> '.Yii::t ( 'app', 'Reset List' ), [
            'index'
        ], [
            'class' => 'btn btn-info  btn-sm'
        ] ),
        'showFooter' => true,
    ],

    'columns' => [
        //['class' => 'yii\grid\SerialColumn'],
        //'id',
        /*[
            'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'attribute' => 'id',
            //'value'=>'chartsOfAccounts.account_name'

        ],*/
        //'price',
        [
            'headerOptions' => ['style' => 'width:20%','class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            //'attribute' =>  'charts_of_accounts_id',
            'attribute' =>  'charts_of_accounts_id',
            'header' => '<a href="#" data-sort="accounts">Accounts</a>',
            'value'=>'chartsOfAccounts.account_name',
            //'content' => 'blah'
            //'attribute' =>  'charts_of_accounts_id',
            //'filter'=>false
        ],
        [
            'headerOptions' => ['style' => 'width:15%','class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'attribute' =>  'debit',
            'pageSummary' => true,
            //'format'=>'raw',
            //'value'=>function($model)
            //{
                //if($model->status==1)
                //{
                    //return '<span class="btn btn-success btn-sm">Active</span>';

                //}else {
                    //return '<span  class="btn btn-danger btn-sm">InActive</span>';
                //}
            //}


        ],
        //'status',
        //'created_on',
        [
            'headerOptions' => ['style' => 'width:15%','class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'attribute' =>  'credit',
            'pageSummary' => true,
            //'value' => function($model){
                //return date("d/m/Y", strtotime($model->created_on));
            //},
            //'filter'=>false

        ],
        //'created_by',
        [
            'headerOptions' => ['style' => 'width:40%','class' => 'text-center'],
            'attribute' => 'description',
            'contentOptions' => ['class' => 'text-center'],
            //'value'=>'user.username'

        ],
        //'updated_by',
        //'updated_on',

        [

            'class' => '\kartik\grid\ActionColumn',

            'template' => '{update}',
            'contentOptions' => ['style' => 'width:10%'],
            'buttons' => [

                'update' => function ($url, $model)

                {//fas fa-pencil-alt
                    return '<a href="#"><span class="fa fa-pencil-alt"  onclick="updateTransaction('.$model->id.',\'transactions\',\'update\',event)"></span></a>';
                },
            ]
        ]
    ],
    'showPageSummary' => true,
    //'floatHeader'=>true,
    //'floatHeaderOptions'=>['scrollingTop'=>'1']
    /*'columns' => $gridColumns,*/
    /*'responsive'=>true,
    'hover'=>true*/
]);

Pjax::end();

?>

</div>