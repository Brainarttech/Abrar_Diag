<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Update Salary: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Update Salary', 'url' => ['employee-salary-list']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
