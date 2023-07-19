<?php

use kartik\file\FileInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Expenses */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="expenses-form">

    <?php
    $form = ActiveForm::begin([
        'id' => 'form',
        'enableAjaxValidation' => true,
        'validationUrl' => ($model->isNewRecord) ?Yii::$app->homeUrl.'expenses/validate':Yii::$app->homeUrl.'expenses/validate?id='.$model->id.'',
        'options' => [
            'class' => 'm-form m-form--state',
            'autocomplete'=>'off',
            'enctype' => 'multipart/form-data'
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


    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'cat_id')->dropDownList(ArrayHelper::map(\app\models\ExpenseCategory::find()->all(), 'id', 'name'),['prompt' => 'Select Category']) ?>


    <?= $form->field($model, 'note')->textarea(['maxlength' => true]) ?>

    <?php



    echo $form->field($model, 'attachment')->widget(FileInput::classname(), [
        'options' => ['multiple' => false, 'accept' => 'image/*'],
        'pluginEvents' => [
            //'change' => 'function() { showImage(); }',
        ],
        'pluginOptions' => [
            'allowedFileExtensions'=>['jpg', 'gif', 'png', 'bmp'],
            'showPreview' => false,
            'showCaption' => true,
            'showRemove' => false,
            'showCancel' => false,
            'showUpload' => false,
            'initialCaption'=> $model->attachment,


        ]
    ]);


    ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
