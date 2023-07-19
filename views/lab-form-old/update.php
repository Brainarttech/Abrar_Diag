<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LabForm */

$this->title = 'Update Lab Form: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Lab Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lab-form-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
