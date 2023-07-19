<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ReferredDoctor */

$this->title = 'Create Referred Doctor';
$this->params['breadcrumbs'][] = ['label' => 'Referred Doctors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="referred-doctor-create">

    <!--<h1><?/*= Html::encode($this->title) */?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
