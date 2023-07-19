<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ItemName */

$this->title = 'Update Transaction';
//$this->params['breadcrumbs'][] = ['label' => 'Account Names', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->account_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="item-name-update">

    <!--<h1><?/*= Html::encode($this->title) */?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'data' => $data,
        'data2' => $data2,
        'value'=> $value,
    ]) ?>

</div>
