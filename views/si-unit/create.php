<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SiUnit */

$this->title = Yii::t('app', 'Create Si Unit');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Si Units'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="si-unit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
