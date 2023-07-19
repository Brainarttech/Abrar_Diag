<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Mop */

$this->title = 'Create Mop';
$this->params['breadcrumbs'][] = ['label' => 'Mops', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mop-create">

   <!-- <h1><?/*= Html::encode($this->title) */?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
