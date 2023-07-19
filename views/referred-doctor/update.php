<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ReferredDoctor */

$this->title = 'Update Referred Doctor: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Referred Doctors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="referred-doctor-update">

    <!--<h1><?/*= Html::encode($this->title) */?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
