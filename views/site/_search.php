<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\ItemNameSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
if (Yii::$app->request->queryParams) {
    echo '<div data-pjax = 0 class="m-portlet m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_7">';
} else {
    ?>

    <div class="m-portlet m-portlet--collapsed m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_7">

    <?php } ?>
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
                    <a href="#" data-pjax = 0  m-portlet-tool="toggle" class="m-portlet__nav-link m-portlet__nav-link--icon">
                        <i class="la la-angle-down"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="m-portlet__body">
        <div class="item-name-search">

            <?php
            $form = ActiveForm::begin([
                        'action' => ['complete-test'],
                        'method' => 'get',
                        'options' => [
                            'data-pjax' => 1
                        ],
            ]);
            ?>

            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">


                <div class="row">
                    <!--                    <div class="col-md-2">
                                            
                                        </div>-->
                    <div class="col-md-2">
                        <?php
                        // Normal select with ActiveForm & model
                        echo $form->field($model, 'sale_id')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(\app\models\Sales::find()->all(), 'id', 'invoice_no'),
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
                        echo $form->field($model, 'item_id')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(\app\models\ItemName::find()->all(), 'id', 'name'),
                            'theme' => Select2::THEME_BOOTSTRAP,
                            'options' => ['placeholder' => ''],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($model, 'item_price') ?>
                    </div>

                    <div class="col-md-2">
                        <?= $form->field($model, 'item_name') ?>
                    </div>

                    <div class="col-md-2">
                        <?php
// usage without model

                        echo $form->field($model, 'created_on')->widget(DatePicker::className(), [
                            'type' => DatePicker::TYPE_INPUT,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd'
                            ]
                        ]);
                        ?>
                    </div>
                    <div class="col-md-2">
                        <?php
// usage without model

                        echo $form->field($model, 'updated_on')->widget(DatePicker::className(), [
                            'type' => DatePicker::TYPE_INPUT,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd'
                            ]
                        ]);
                        ?>
                    </div>
                    <!--<div class="col-md-2">
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
            </div>
                    -->



                    <?php // echo $form->field($model, 'created_by')  ?>

                    <?php // echo $form->field($model, 'created_on')  ?>

                    <?php // echo $form->field($model, 'updated_by')  ?>

                    <?php // echo $form->field($model, 'updated_on')   ?>

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