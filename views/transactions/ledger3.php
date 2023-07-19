<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;

$csrftoken = Yii::$app->request->getCsrfToken();
Yii::$app->view->registerJs('var csrftoken = "'.$csrftoken.'"',  \yii\web\View::POS_HEAD);
/* @var $this yii\web\View */
\app\assets\AccountAsset::register($this);

$this->title = 'Ledger';
$this->params['breadcrumbs'][] = "Accounts Ledger";//$this->title;

// Create a panel layout for your GridView widget
echo GridView::widget([
    'dataProvider'=> $dataProvider,
    'filterModel' => $searchModel,
    //'columns' => $gridColumns,
    'panel' => [
        'heading'=>false,
        'before'=>false,
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> Countries</h3>',
        'type'=>'warning',
        //'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
        'after'=>Html::a('<i class="fas fa-redo"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        'footer'=>false
    ],
]);
?>