<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ItemName */

$this->title = 'Update Transaction: ' . $model->account_name;
$this->params['breadcrumbs'][] = ['label' => 'Transaction', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->account_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="item-name-update">

    <!--<h1><?/*= Html::encode($this->title) */?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
