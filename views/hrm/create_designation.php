<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Department */

$this->title = 'Create Designation';
$this->params['breadcrumbs'][] = ['label' => 'Designation', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-create">

    <!--<h1><?/*= Html::encode($this->title) */?></h1>-->

    <?= $this->render('_form_designation', [
        'model' => $model,
        //'departmentdropdown' => $departmentdropdown,
    ]) ?>

</div>
