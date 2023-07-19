<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LeaveType */

$this->title = Yii::t('app', 'Create Leave');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Leaves'), 'url' => ['leaves']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leave-create">

    <?= $this->render('_form_leave', [
        'model' => $model,
    ]) ?>

</div>
