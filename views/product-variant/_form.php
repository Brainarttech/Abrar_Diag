<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\ProductVariant */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-variant-form">

    <?php
    $form = ActiveForm::begin([
                'id' => 'form',
                'enableAjaxValidation' => true,
                'validationUrl' => ($model->isNewRecord) ? Yii::$app->homeUrl . 'product-variant/validate' : Yii::$app->homeUrl . 'product-variant/validate?id=' . $model->id . '',
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

    <?= $form->field($model, 'product_id')->dropDownList(ArrayHelper::map(\app\models\Product::find()->all(), 'id', 'name'), ['prompt' => 'Select Product Name']) ?>

    <?= $form->field($model, 'variant_id')->dropDownList(ArrayHelper::map(\app\models\Variant::find()->all(), 'id', 'name'), ['prompt' => 'Select Variant Name']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
