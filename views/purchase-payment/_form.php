<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use dosamigos\fileupload\FileUpload;
use kartik\form\ActiveForm;
use kartik\builder\TabularForm;
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\Purchase */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="purchase-form">

    <?php
    $form = ActiveForm::begin([
                'id' => 'form',
                'enableAjaxValidation' => true,
                'options' => ['enctype' => 'multipart/form-data'],
                'validationUrl' => ($model->isNewRecord) ? Yii::$app->homeUrl . 'purchase/validate' : Yii::$app->homeUrl . 'purchase/validate?id=' . $model->id . '',
                'options' => [
                    'class' => 'm-form m-form--state',
                    'autocomplete' => 'off'
                ],
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'form-control-label '],
                /* 'horizontalCssClasses' => [
                  'error' => 'form-control-feedback',
                  ], */
                ],
    ]);
    ?>

    <?= $form->field($model, 'purchase_id')->dropDownList(ArrayHelper::map(\app\models\Purchase::find()->all(), 'id', 'invoice_number'), ['prompt' => 'Select Purchase']) ?>

    <?= $form->field($model, 'paid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'balance')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mop_id')->dropDownList(ArrayHelper::map(\app\models\Mop::find()->all(), 'id', 'name'), ['prompt' => 'Select Payment Method']) ?>

    <?php //$form->field($model, 'file')->fileInput()   ?>


    <div id="errors">

    </div>

    <?= $form->field($model, 'attachment')->hiddenInput(['id' => 'attachment'])->label(false); ?>

    <?php
    if (Yii::$app->user->identity->role == "Admin") {
        echo $form->field($model, 'status')->dropDownList(['1' => 'Active', '0' => 'InActive',]);
    } else {
        echo $form->field($model, 'status')->hiddenInput(['value' => '1'])->label(false);
    }
    ?>
    
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
