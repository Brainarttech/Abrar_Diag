<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LeaveType */

$this->title = Yii::t('app', 'Create Leave Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Leave Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leave-type-create">

    <?= $this->render('_form_leave_type', [
        'model' => $model,
    ]) ?>

</div>
