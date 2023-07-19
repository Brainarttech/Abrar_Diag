<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ReferredDoctor */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Referred Doctors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="referred-doctor-view">

    <div class="row">
        <div class="col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'name',
                    'email:email',
                    [                      // the owner name of the model
                        'label' => 'Added On',
                        'value' => \app\helpers\datetime::printBill($model->created_on)
                    ],
                ],
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'phone_no',
                    'address',
                    [                      // the owner name of the model
                        'label' => 'Added By',
                        'value' => $model->user->username,
                    ],
                ],
            ]) ?>
        </div>
    </div>
    

</div>
