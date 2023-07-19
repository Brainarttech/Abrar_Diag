<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PurchasePayment */

$this->title = Yii::t('app', 'Create Purchase Payment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Purchase Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-payment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
