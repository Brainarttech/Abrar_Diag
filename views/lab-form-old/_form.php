<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\LabForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lab-form-form mateen">

    <?php
    $form = ActiveForm::begin([
        'id' => 'form',
        'enableAjaxValidation' => true,
        'validationUrl' => ($model->isNewRecord) ?Yii::$app->homeUrl.'lab-form/validate':Yii::$app->homeUrl.'lab-form/validate?id='.$model->id.'',
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


    <?= $form->field($model, 'form_name')->textInput(['maxlength' => true]) ?>

    <?php

    // Normal select with ActiveForm & model
    echo $form->field($model, 'item_name_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\ItemName::find()->all(), 'id', 'name'),
        'theme' => Select2::THEME_BOOTSTRAP,
        'options' => ['placeholder' => ''],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);




    ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    $('#labform-item_name_id').parents('.bootbox').removeAttr('tabindex');
</script>
