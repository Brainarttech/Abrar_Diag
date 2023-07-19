<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Payments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payments-form">

    <?php
    $form = ActiveForm::begin([
        'id' => 'form',
        'enableAjaxValidation' => true,
        'validationUrl' => ($model->isNewRecord) ?Yii::$app->homeUrl.'payments/validate?sale_id='.$model->sale_id:Yii::$app->homeUrl.'payments/validate?id='.$model->id.'',
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

    <style>
        .m-widget5 .m-widget5__item .m-widget5__content{
            padding-left: 0.0rem !important;
        }
    </style>


    <div class="m-widget5">
        <div class="m-widget5__item">
            <div class="m-widget5__content">
                <h4 class="m-widget5__title">
                    <?= $sale->patient->name?>
                </h4>
															<span class="m-widget5__desc">
																0<?= $sale->patient->phone_no ?>
															</span>
                <div class="m-widget5__info">
																<span class="m-widget5__info-label">
																	Receipt No:
																</span>
																<span class="m-widget5__info-date m--font-info">
																	<?= $sale->invoice_no?>
																</span>
                </div>
            </div>


            <div class="m-widget5__stats1">
															<span class="m-widget5__number">
																<?= number_format($sale->grand_total)?>
															</span>
                <br>
															<span class="m-widget5__sales">
																Total
															</span>
            </div>
            <div class="m-widget5__stats1">
															<span class="m-widget5__number">
																<?= number_format($sale->paid_amount)?>

															</span>
                <br>
															<span class="m-widget5__sales">
																Paid
															</span>
            </div>
            <div class="m-widget5__stats2">
															<span class="m-widget5__number">
																<?= number_format($sale->grand_total - $sale->paid_amount)?>
															</span>
                <br>
															<span class="m-widget5__votes">
																Remaining
															</span>
            </div>



        </div>

    </div>

   <!-- <div class="row">
        <div class="col-md-4">
            <?/*= $form->field($model, 'discount')->textInput() */?>

        </div>
        <div class="col-md-8">
            <?/*= $form->field($model, 'discount_reason')->textInput() */?>

        </div>
    </div>
-->

    <hr>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'amount')->textInput() ?>

        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'mop_id')->dropDownList(ArrayHelper::map(\app\models\Mop::find()->all(),'id','name'),
                ['prompt' => 'Select']) ?>

        </div>
    </div>


    <?php // $form->field($model, 'sale_id')->textInput()->hiddenInput() ?>

    <?php // $form->field($model, 'reference_no')->textInput(['maxlength' => true])->hiddenInput() ?>



    <?php // $form->field($model, 'pos_paid')->textInput()->hiddenInput() ?>

    <?php // $form->field($model, 'pos_balance')->textInput()->hiddenInput() ?>

    <?= $form->field($model, 'note')->textarea(['maxlength' => true]) ?>

    <?php //  $form->field($model, 'payment_status')->dropDownList([ '0', '1', '2', ], ['prompt' => '']) ?>

    <?php // $form->field($model, 'status')->dropDownList([ '0', '1', ], ['prompt' => ''])->hiddenInput() ?>


    <?php //echo $form->field($model, 'created_on')->textInput() ?>

    <?php //echo $form->field($model, 'created_by')->textInput() ?>

    <?php //echo $form->field($model, 'updated_on')->textInput() ?>

    <?php //echo $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
