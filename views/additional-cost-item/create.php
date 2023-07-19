<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AdditionalCostItem */

$this->title = 'Add New Product';
$this->params['breadcrumbs'][] = ['label' => 'Additional Cost Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="additional-cost-item-create">

    <!--<h1><?/*= Html::encode($this->title) */?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
