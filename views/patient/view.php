<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Patient */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-view">

    <!--<h1><?/*= Html::encode($this->title) */?></h1>

    <p>
        <?/*= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) */?>
        <?/*= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */?>
    </p>-->

    <div class="row">
        <div class="col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    //'id',
                    'reg_no',
                    'cnic',
                    'email:email',
                    'age',
                    'whatsapp_no',
                    'address',
                    // 'referred_by_id',
                    //'panel_id',
                    //'status',
                    [                      // the owner name of the model
                        'label' => 'Added On',
                        'value' => \app\helpers\datetime::printBill($model->created_on)
                    ],
                    //'updated_on',
                    //'updated_by',
                ],
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [

                    'name',
                    'phone_no',
                    'gender',
                    'relationship',
                    'city',
                    'country',
                    // 'referred_by_id',
                    //'panel_id',
                    //'status',
                    [                      // the owner name of the model
                        'label' => 'Added By',
                        'value' => $model->user->username,
                    ],
                    //'updated_on',
                    //'updated_by',
                ],
            ]) ?>
        </div>
    </div>


</div>
