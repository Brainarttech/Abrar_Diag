<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ReferredReportingDoc */

$this->title = Yii::t('app', 'Create Referred Reporting Doc');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Referred Reporting Docs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="referred-reporting-doc-create">

<!--<h1><?//Html::encode($this->title) ?></h1>-->

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
