<?php

use kartik\password\PasswordInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="user-form">

    <?php

    $form = ActiveForm::begin([
        'id' => 'form',
        'enableAjaxValidation' => true,
        'validationUrl' => ($model->isNewRecord) ?Yii::$app->homeUrl.'user/validate':Yii::$app->homeUrl.'user/validate?id='.$model->id.'&change-password=true',
        'options' => [
            'class' => 'm-form m-form--state'
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
            <?php
            echo $form->field($model, 'password')->widget(
                PasswordInput::classname()
            );

            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            echo $form->field($model, 'repeat_password')->widget(
                PasswordInput::classname()
            );

            ?>
        </div>
    </div>



    <div class="form-group">
        <?= Html::submitButton('Change Password', ['class' => 'btn btn-info']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
