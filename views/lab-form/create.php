<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LabForm */

$this->title = 'Create Lab Form';
$this->params['breadcrumbs'][] = ['label' => 'Lab Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lab-form-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
