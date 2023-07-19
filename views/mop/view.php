<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Mop */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mops', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mop-view">

   <!-- <h1><?/*= Html::encode($this->title) */?></h1>-->

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'status',
            'created_by',
            'created_on',
            'updated_by',
            'updated_on',
        ],
    ]) ?>

</div>
