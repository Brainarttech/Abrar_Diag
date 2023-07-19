<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Patient */

$this->title = 'Create Tansaction';
$this->params['breadcrumbs'][] = ['label' => 'Tansaction', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-create">

    <?= $this->render('_form', [
        'model' => $model,
        'data' => $data,
        'data2' => $data2,
        'value'=> $value,
    ]) ?>

</div>
