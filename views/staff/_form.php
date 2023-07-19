<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Staff */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-form">

    <?php
    $form = ActiveForm::begin([
                'id' => 'form',
                'enableAjaxValidation' => true,
                'validationUrl' => ($model->isNewRecord) ? Yii::$app->homeUrl . 'staff/validate' : Yii::$app->homeUrl . 'staff/validate?id=' . $model->id . '',
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

    <?= $form->field($model, 'department_id')->dropDownList(ArrayHelper::map(\app\models\Department::find()->all(), 'id', 'name'), ['prompt' => 'Select Department']) ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone_no')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'staff_type')->textInput(['maxlength' => true]) ?>


        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'cnic')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

            <?php
            if (Yii::$app->user->identity->role == "Admin") {
                echo $form->field($model, 'status')->dropDownList(['1' => 'Active', '0' => 'InActive',]);
            } else {
                echo $form->field($model, 'status')->hiddenInput(['value' => '1'])->label(false);
            }
            ?>
            
            <?php //$form->field($model, 'image')->textInput(['maxlength' => true]) ?>

        </div>
    </div>



    <?php //echo $form->field($model, 'created_on')->textInput()  ?>

    <?php //echo $form->field($model, 'created_by')->textInput()  ?>

    <?php //echo $form->field($model, 'updated_on')->textInput()  ?>

    <?php //echo $form->field($model, 'updated_by')->textInput()  ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
