<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\ReferredReport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="referred-report-form">

    <?php
    $form = ActiveForm::begin([
                'id' => 'form',
                'enableAjaxValidation' => true,
                'validationUrl' => ($model->isNewRecord) ? Yii::$app->homeUrl . 'referred-report/validate' : Yii::$app->homeUrl . 'referred-report/validate?id=' . $model->id . '',
                'options' => [
                    'class' => 'm-form m-form--state',
                    'autocomplete' => 'off'
                ],
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'form-control-label '],
//                    'horizontalCssClasses' => [
//                        'error' => 'form-control-feedback',
//                    ],
                ],
    ]);
    ?>

    <?= $form->field($model, 'referred_reporting_doc_id')->dropDownList(ArrayHelper::map(\app\models\ReferredReportingDoc::find()->all(), 'id', 'name'), ['prompt' => 'Select Reporting Doc']) ?>

    <?= $form->field($model, 'films_issued')->radioList([1 => 'Yes', 0 => 'No']); ?>

    <?= $form->field($model, 'report_issued')->radioList([1 => 'Yes', 0 => 'No']); ?>

    <?= $form->field($model, 'sale_item_id')->hiddenInput()->label(false) ?>

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
