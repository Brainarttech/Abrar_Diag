<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AdditionalCostItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="additional-cost-item-form">

    <?php
    $form = ActiveForm::begin([
                'id' => 'form',
                'enableAjaxValidation' => true,
                'validationUrl' => ($model->isNewRecord) ? Yii::$app->homeUrl . 'additional-cost-item/validate' : Yii::$app->homeUrl . 'additional-cost-item/validate?id=' . $model->id . '',
                'options' => [
                    'class' => 'm-form m-form--state',
                    'autocomplete' => 'off'
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

    <?= $form->field($model, 'product')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rate')->textInput() ?>

    <?= $form->field($model, 'cat_id')->dropDownList(ArrayHelper::map(\app\models\ItemCategory::find()->where(['status' => '1'])->all(), 'id', 'name'), ['prompt' => 'Select Category']) ?>


    <?php
    if (Yii::$app->user->identity->role == "Admin") {
        echo $form->field($model, 'status')->dropDownList(['1' => 'Active', '0' => 'InActive',]);
    } else {
        echo $form->field($model, 'status')->hiddenInput(['value' => '1'])->label(false);
    }
    ?>

    <?php //echo $form->field($model, 'created_on')->textInput()  ?>

    <?php //echo $form->field($model, 'created_by')->textInput()  ?>

    <?php //echo $form->field($model, 'updated_on')->textInput()  ?>

    <?php //echo $form->field($model, 'updated_by')->textInput()  ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
