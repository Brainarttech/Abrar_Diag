<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\ItemName */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">
    <div class="row">
        <?php
        $form = ActiveForm::begin([
                    'id' => 'form',
                    'enableAjaxValidation' => true,
                    'validationUrl' => ($model->isNewRecord) ? Yii::$app->homeUrl . 'product/validate' : Yii::$app->homeUrl . 'product/validate?id=' . $model->id . '',
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
        <div class="col-md-6">
            <?= Html::dropDownList('root_id', '', ArrayHelper::map(\app\models\Category::find()->roots()->all(), 'id', 'name'), ['id' => 'root', 'prompt' => 'Select Parent Category']) ?>

            <div class="form-group field-inventory-product_id">
                <?php ?>
                <div class="input-group">
                    <?php
                    echo DepDrop::widget([//subcat
                        'name' => 'sub_category_id',
                        'type' => DepDrop::TYPE_SELECT2,
                        //'data'=>[0 => 'Tablets'],
                        //'data'=>$a,
                        'data' => $data2,
                        //'data'=>'{"output":{"Income":[{"id":"134","name":"Income & Bonuses","accountGroup":null}]},"selected":""}',
                        'options' => ['id' => 'category_id', 'placeholder' => 'Select Sub Category'],
                        'pluginOptions' => [
                            'depends' => ['root'],
                            /* 'placeholder'=>'Select Account...', */
                            'url' => Url::to(['/category/get-sub-category'])
                        ]
                    ]);
                    ?>
                </div>
            </div>

            <div class="form-group field-inventory-product_id">
                <?php ?>
                <div class="input-group">
                    <?php
                    echo DepDrop::widget([//subcat
                        'name' => 'category_id',
                        'type' => DepDrop::TYPE_SELECT2,
                        //'data'=>[0 => 'Tablets'],
                        //'data'=>$a,
                        'data' => $data2,
                        //'data'=>'{"output":{"Income":[{"id":"134","name":"Income & Bonuses","accountGroup":null}]},"selected":""}',
                        'options' => ['id' => 'item_id', 'placeholder' => 'Select Sub Category'],
                        'pluginOptions' => [
                            'depends' => ['category_id'],
                            /* 'placeholder'=>'Select Account...', */
                            'url' => Url::to(['/category/get-sub-category'])
                        ]
                    ]);
                    ?>
                </div>
            </div>

            <?= $form->field($model, 'brand_id')->dropDownList(ArrayHelper::map(\app\models\Brand::find()->all(), 'id', 'name'), ['prompt' => 'Select Brand Name']) ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'code')->textInput() ?>

            <?= $form->field($model, 'description')->textInput() ?>

            <?php
            if (Yii::$app->user->identity->role == "Admin") {
                echo $form->field($model, 'status')->dropDownList(['1' => 'Active', '0' => 'InActive',]);
            } else {
                echo $form->field($model, 'status')->hiddenInput(['value' => '1'])->label(false);
            }
            ?>
            
            <?php //echo $form->field($model, 'created_on')->textInput()  ?>

            <?php //echo $form->field($model, 'created_by')->textInput()   ?>

            <?php //echo $form->field($model, 'updated_on')->textInput()   ?>

            <?php //echo $form->field($model, 'updated_by')->textInput()   ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>