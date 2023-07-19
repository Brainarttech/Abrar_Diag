<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Patient */

$this->title = 'Create Account';
$this->params['breadcrumbs'][] = ['label' => 'Account', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
