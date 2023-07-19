<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\SiUnit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="si-unit-form">

    <?php $form = ActiveForm::begin([
        'id' => 'form',
        'enableAjaxValidation' => true,
        'validationUrl' => ($model->isNewRecord) ?Yii::$app->homeUrl.'si-unit/validate':Yii::$app->homeUrl.'si-unit/validate?id='.$model->id.'',
        'options' => [
            'class' => 'm-form m-form--state',
            'autocomplete'=>'off'
        ],
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'form-control-label '],
            /*'horizontalCssClasses' => [
                'error' => 'form-control-feedback',
            ],*/
        ],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'base_value')->textInput(['maxlength' => true]) ?>

    <?=
            $form->field($model, 'unit_id')
            ->dropDownList(
                    ArrayHelper::map(app\models\SiUnit::find()->asArray()->all(), 'id', 'name'), ['prompt' => 'Select Unit']
    );
    ?> 


    <?= $form->field($model, 'opration')->dropDownList(['*' => '*', '/' => '/', '+' => '+', '-' => '-',], ['prompt' => 'Select Operation']) ?>

    <?= $form->field($model, 'status')->dropDownList(['1'=>'Active','0'=>'InActive', ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
