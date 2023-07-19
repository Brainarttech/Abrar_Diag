<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Expenses */

$this->title = Yii::t('app', 'Add Expenses');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Expenses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
	.bootbox .modal-header {
		flex-direction: row-reverse;
	}
</style>
<div class="expenses-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
