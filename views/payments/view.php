<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Payments */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payments-view">

    <table class="table table-bordered m-table">
        <thead>
        <tr>
            <th>
                #
            </th>
            <th>
               Reference No
            </th>
            <th>
                Amount
            </th>
            <th>
               Payment Method
            </th>
            <th>
                Note
            </th>
            <th>
                Time
            </th>
        </tr>
        </thead>
        <tbody>
        <?php
        $i=0;
        foreach ($model as $data)
        {
            $i++;



        ?>
        <tr>
            <th scope="row">
                <?= $i ?>
            </th>
            <td>
                <?= $data->reference_no?>
            </td>
            <td>
                <?= $data->amount ?>
            </td>
            <td>
                <?= $data->mop->name ?>
            </td>
            <td>
                <?= $data->note ?>
            </td>
            <td>
                <?= \app\helpers\datetime::saleDateTime($data->created_on )?>
            </td>
        </tr>

        <?php } ?>

        </tbody>
    </table>

</div>
