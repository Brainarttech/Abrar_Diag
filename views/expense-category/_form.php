<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ExpenseCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="expense-category-form">

    
    <?php
    $form = ActiveForm::begin([
        'id' => 'form',
        'enableAjaxValidation' => true,
        'validationUrl' => ($model->isNewRecord) ?Yii::$app->homeUrl.'expense-category/validate':Yii::$app->homeUrl.'expense-category/validate?id='.$model->id.'',
        'options' => [
            'class' => 'm-form m-form--state',
            'autocomplete'=>'off'
        ],
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'form-control-label '],
//            'horizontalCssClasses' => [
//                'error' => 'form-control-feedback',
//            ],
        ],
    ]);
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
