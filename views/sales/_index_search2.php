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
<div class="m-portlet m-portlet--collapsed m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_7">

    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon">
                    <i class="flaticon-search"></i>
                </span>
                <h3 class="m-portlet__head-text">
                    Search
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">

                <li class="m-portlet__nav-item">
                    <a href="#"  m-portlet-tool="toggle" class="m-portlet__nav-link m-portlet__nav-link--icon">
                        <i class="la la-angle-down"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="m-portlet__body">

        <div class="sales-search">

            <?php
            $form = ActiveForm::begin([
                        'action' => ['index'],
                        'method' => 'get',
            ]);
            ?>
            <div class="m-portlet__body">
                <!--begin: Search Form -->
                <div class="m-form m-form--label-align-right">
                    <div class="row align-items-center">
                        <div class="col-xl-12 order-2 order-xl-1">
                            <div class="form-group m-form__group row">

                                <div class="col-md-2">
                                    <?= $form->field($model, 'invoice_no') ?>

                                </div>
                                <div class="col-md-2">
                                    <?=
                                    $form->field($model, 'patient_id')->widget(Select2::classname(), [
                                        'initValueText' => $model->patient->name, // set the initial display text
                                        'options' => ['placeholder' => ''],
                                        'theme' => Select2::THEME_BOOTSTRAP,
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
                                    <?=
                                    $form->field($model, 'referred_doctor_id')->widget(Select2::classname(), [
                                        'initValueText' => $model->referred->name,
                                        'options' => ['placeholder' => ''],
                                        'theme' => Select2::THEME_BOOTSTRAP,
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                            'minimumInputLength' => 1,
                                            'language' => [
                                                'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                                            ],
                                            'ajax' => [
                                                'url' => \yii\helpers\Url::to(['ajax/reffered-list']),
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

                                <?php
                                if (!isset($_GET['get'])) {
                                    ?>

                                    <div class="col-md-2">
                                        <?php
                                        // Normal select with ActiveForm & model
                                        echo $form->field($model, 'sale_status')->widget(Select2::classname(), [
                                            'data' => array("1" => "Complete", "2" => "Refund"),
                                            'theme' => Select2::THEME_BOOTSTRAP,
                                            'options' => ['placeholder' => ''],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]);
                                        ?>

                                    </div>
                                    <div class="col-md-2">
                                        <?php
                                        // Normal select with ActiveForm & model
                                        echo $form->field($model, 'payment_status')->widget(Select2::classname(), [
                                            'data' => array("1" => "Paid", "2" => "Partial", "3" => "Due"),
                                            'theme' => Select2::THEME_BOOTSTRAP,
                                            'options' => ['placeholder' => ''],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]);
                                        ?>
                                    </div>

                                <?php } ?>
                                <div class="col-md-2">
                                    <?php
                                    // Normal select with ActiveForm & model
                                    echo $form->field($model, 'created_by')->widget(Select2::classname(), [
                                        'data' => ArrayHelper::map(\app\models\User::find()->where(['role' => 'reception'])->all(), 'id', 'username'),
                                        'theme' => Select2::THEME_BOOTSTRAP,
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

    </div>
</div>
