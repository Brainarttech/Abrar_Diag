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
        'id' => 'accountform_update',
        'enableAjaxValidation' => true,
        'validationUrl' => ($model->isNewRecord) ?Yii::$app->homeUrl.'accounts/validate':Yii::$app->homeUrl.'accounts/validate?id='.$model->id.'',
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
        <div class="col-md-12">
            <?= $form->field($model, 'account_group_id')->dropDownList(ArrayHelper::map(\app\models\AccountGroup::find()->all(), 'id', 'account_name'),['prompt' => 'Select Category']) ?>
            <?= $form->field($model, 'account_name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'account_code')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'account_description')->textarea(['rows' => '3']) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Done', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>