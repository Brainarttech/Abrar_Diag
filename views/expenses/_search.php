<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PatientSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    Search Expense
                </h3>
            </div>
        </div>
    </div>

    <div class="patient-search">

        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'options' => [
                'data-pjax' => 1
            ],
        ]); ?>
        <div class="m-portlet__body">
            <!--begin: Search Form -->
            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                <div class="row align-items-center">
                    <div class="col-xl-12 order-2 order-xl-1">
                        <div class="form-group m-form__group row">

                            <div class="col-md-3">
                                <?= $form->field($model, 'amount') ?>

                            </div>
                            <div class="col-md-3">

                                <?= $form->field($model, 'note') ?>

                            </div>

                            <div class="col-md-3">
                                <?php

                                echo $form->field($model, 'cat_id')->widget(Select2::classname(), [
                                    'data' => ArrayHelper::map(\app\models\ExpenseCategory::find()->all(),'id','name'),
                                    //'theme' => Select2::THEME_BOOTSTRAP,
                                    'options' => ['placeholder' => ''],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]);

                                ?>
                            </div>
                            
                            
                            <div class="col-md-3">
                                <?php

                                // Normal select with ActiveForm & model
                                echo $form->field($model, 'created_by')->widget(Select2::classname(), [
                                    'data' => ArrayHelper::map(\app\models\User::find()->where(['role'=>'reception'])->all(),'id','username'),
                                    //'theme' => Select2::THEME_BOOTSTRAP,
                                    'options' => ['placeholder' => ''],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]);




                                ?>

                            </div>

                        </div>



                        <div class="form-group">
                            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                            <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end: Search Form -->

</div>


