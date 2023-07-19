<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ItemName */

$this->title = 'Create Item Name';
$this->params['breadcrumbs'][] = ['label' => 'Item Names', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-name-create">

    <!--<h1><?/*= Html::encode($this->title) */?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
