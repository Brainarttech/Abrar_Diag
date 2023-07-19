<?php

use kartik\daterange\DateRangePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SalesSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    Advanced Ledger
                </h3>
            </div>
        </div>
    </div>
    <div class="sales-search">

        <?php

        $form = ActiveForm::begin([
            'action' => ['ledger'],
            'method' => 'get',
        ]);


        ?>



    <div class="m-portlet__body">
        <!--begin: Search Form -->
        <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
            <div class="row align-items-center">
                <div class="col-xl-12 order-2 order-xl-1">
                    <div class="form-group m-form__group row">

                        <div class="col-md-2">
                            <?= $form->field($model, 'id') ?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($model, 'charts_of_accounts_id')->label('Account Name') ?>
                        </div>

                            <div class="col-md-2">
                                <?=

                                $form->field($model, 'debit')->widget(Select2::classname(), [
                                    //'initValueText' => $country, // set the initial display text
                                    'options' => ['placeholder' => ''],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                        'minimumInputLength' => 1,
                                        'language' => [
                                            'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                                        ],
                                        'ajax' => [
                                            'url' => \yii\helpers\Url::to(['ajax/patient-list']),
                                            'dataType' => 'json',
                                            'data' => new JsExpression('function(params) { return {q:params.term}; }')
                                        ],
                                        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                        'templateResult' => new JsExpression('function(city) { return city.text; }'),
                                        'templateSelection' => new JsExpression('function (city) { return city.text; }'),
                                    ],
                                ]);



                                ?>
                            </div>

                        <div class="col-md-2">
                            <?php

                            // Normal select with ActiveForm & model
                            echo $form->field($model, 'credit')->widget(Select2::classname(), [
                                'data' => array("1"=>"Complete","2"=>"Refund"),
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
