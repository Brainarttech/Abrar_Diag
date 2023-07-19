<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ReferredReport */

$this->title = Yii::t('app', 'Create Referred Report');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Referred Reports'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="referred-report-create">

<!--    <h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
