<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Patient */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-form">

    <?php
    $form = ActiveForm::begin([
        'id' => 'form',
        'enableAjaxValidation' => true,
        'validationUrl' => ($model->isNewRecord) ?Yii::$app->homeUrl.'patient/validate':Yii::$app->homeUrl.'patient/validate?id='.$model->id.'',
        'options' => [
            'class' => 'm-form m-form--state',
            'autocomplete'=>'off'
        ],
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'form-control-label '],
            'horizontalCssClasses' => [
                'error' => 'form-control-feedback',
            ],
        ],
    ]);
    ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'reg_no')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'age')->textInput() ?>

            <?= $form->field($model, 'whatsapp_no')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'phone_no')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'cnic')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'gender')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'relationship')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>


        </div>
    </div>
    
    <?= $form->field($model, 'status')->dropDownList(['1'=>'Active','0'=>'InActive', ]) ?>

    <?php //echo $form->field($model, 'created_on')->textInput() ?>

    <?php //echo $form->field($model, 'created_by')->textInput() ?>

    <?php //echo $form->field($model, 'updated_on')->textInput() ?>

    <?php //echo $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
