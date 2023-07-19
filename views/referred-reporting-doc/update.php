<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ReferredReportingDoc */

$this->title = Yii::t('app', 'Update Referred Reporting Doc: ' . $model->name, [
    'nameAttribute' => '' . $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Referred Reporting Docs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="referred-reporting-doc-update">

<!--    <h1><? Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
