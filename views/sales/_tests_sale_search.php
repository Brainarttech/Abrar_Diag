<?php

use app\models\ItemName;
use kartik\daterange\DateRangePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

?>
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    Tests Wise Sale Report Search
                </h3>
            </div>
        </div>
    </div>
    <div class="sales-search">
        <?php
        $form = ActiveForm::begin([
            'action' => ['tests-sale-report'],
            'method' => 'get',
        ]);
        ?>
    <div class="m-portlet__body">
        <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
            <div class="row align-items-center">
                <div class="col-xl-12 order-2 order-xl-1">
                    <div class="form-group m-form__group row">
                        <div class="col-md-6">
                            <?php
                            echo $form->field($model, 'department')->widget(Select2::classname(), [
                                'data' => ArrayHelper::map(\app\models\ItemCategory::find()->all(),'id','name'),
                                'options' => ['placeholder' => ''],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
                            ?>
                        </div>
                        <div class="col-md-6">
                            <?php
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
                                echo '</div>'; 
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