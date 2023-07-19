<?php

use app\models\ItemName;
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
                    Advanced Detail Sale Search
                </h3>
            </div>
        </div>
    </div>
    <div class="sales-search">

        <?php

        $form = ActiveForm::begin([
            'action' => ['custom-sale-report'],
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
                            <?= $form->field($model, 'invoice_no') ?>

                        </div>
                            <div class="col-md-2">
                                <?=

                                $form->field($model, 'patient_id')->widget(Select2::classname(), [
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
                                <?=

                                $form->field($model, 'referred_doctor_id')->widget(Select2::classname(), [
                                    //'initValueText' => $country, // set the initial display text
                                    'options' => ['placeholder' => ''],
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

                        <div class="col-md-2">
                            <?php

                            // Normal select with ActiveForm & model
                            echo $form->field($model, 'sale_status')->widget(Select2::classname(), [
                                'data' => array("1"=>"Complete","2"=>"Refund"),
                                //'theme' => Select2::THEME_BOOTSTRAP,
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
                                'data' => array("1"=>"Paid","2"=>"Partial","3"=>"Due"),
                                //'theme' => Select2::THEME_BOOTSTRAP,
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



                        <div class="col-md-2">
                            <?php
                            // Get the initial saved city data (note $model->city is an array of city ids)
                            $dataList = ItemName::find()->andWhere(['id' => $model->test])->all();
                            $data = ArrayHelper::map($dataList, 'id', 'name');
                            echo $form->field($model, 'test')->widget(Select2::classname(), [
                               
                                //'initValueText' => $country, // set the initial display text
                                'data' => $data,
                                'options' => ['placeholder' => 'Search Referred'],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'minimumInputLength' => 1,
                                    'language' => [
                                        'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                                    ],
                                    'ajax' => [
                                        'url' => \yii\helpers\Url::to(['ajax/test-list']),
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
                            echo $form->field($model, 'department')->widget(Select2::classname(), [
                                'data' => ArrayHelper::map(\app\models\ItemCategory::find()->all(),'id','name'),
                                //'theme' => Select2::THEME_BOOTSTRAP,
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
                            echo $form->field($model, 'test_status')->widget(Select2::classname(), [
                                'data' => array(1=>"Pending",2=>"Complete"),
                                //'theme' => Select2::THEME_BOOTSTRAP,
                                'options' => ['placeholder' => ''],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);




                            ?>
                        </div>



                       <div class="col-md-6">
                            <?php /*echo $form->field($model, 'sale_status') */?>
                        </div>

                 
                        
                        <div class="col-md-6">

                            <?php
                                    $addon = <<< HTML
        <span class="input-group-addon">
            <i class="glyphicon glyphicon-calendar"></i>
        </span>
HTML;



                            echo '<label class="control-label">Date Range</label>';
                            echo '<div class="drp-container">';
                            echo DateRangePicker::widget([
                                'model'=>$model,
                                'attribute'=>'created_on',

                                'convertFormat'=>true,

                                'pluginOptions'=>[
                                    'opens'=>'left',
                                    'ranges' => [

                                        "Today" => ["moment().startOf('day')", "moment()"],
                                        "Yesterday" => ["moment().startOf('day').subtract(1,'days')", "moment().endOf('day').subtract(1,'days')"],
                                        "Last 7 Days" => ["moment().startOf('day').subtract(6, 'days')", "moment()"],
                                        "This Month" => ["moment().startOf('month')", "moment().endOf('month')"],
                                        "Last Month" => ["moment().subtract(1, 'month').startOf('month')", "moment().subtract(1, 'month').endOf('month')"],

                                    ],

                                    'timePicker'=>true,
                                    'timePickerIncrement'=>05,
                                    'locale'=>['format'=>'d/m/Y h:i A']
                                ],
                                'presetDropdown'=>false,
                                'hideInput'=>true
                            ]);
                            echo '</div>'; ?>
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
