<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\widgets\Pjax;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Inventory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inventory-form">
    <div class="row">
        <div class="col-md-6">
            <?php $form = ActiveForm::begin(); ?>

            <?php Pjax::begin(); ?>
            <div class="form-group field-inventory-product_id">
                <?php
                echo '<label class="control-label">Product Name</label>';
                ?>
                <div class="input-group">
                    <?php
                    echo Select2::widget([
                        'name' => 'Inventory[product_id]',
                        'data' => ArrayHelper::map(\app\models\Product::find()->all(), 'id', 'name'),
                        'options' => [
                            'placeholder' => 'Select Product',
                            'multiple' => false
                        ],
                    ]);
                    ?>
                    <div class="input-group-append" style="height: 34px;">
                        <a class="btn btn-primary" href="<?php echo $baseUrl . '../product/create'; ?>" data-pjax="0" onclick="addnew1(event, this)" >
                            + 
                        </a>
                    </div>
                </div>
            </div>
            <?php Pjax::end(); ?>

            <?php Pjax::begin(); ?>
            <div class="form-group field-inventory-product_id">
                <?php
                ?>
                <div class="input-group">
                    <?php
                    echo $form->field($model, 'variant_id')->widget(DepDrop::classname(), [//subcat
                        'type' => DepDrop::TYPE_SELECT2,
                        //'data'=>[0 => 'Tablets'],
                        //'data'=>$a,
                        'data' => $data2,
                        //'data'=>'{"output":{"Income":[{"id":"134","name":"Income & Bonuses","accountGroup":null}]},"selected":""}',
                        'options' => ['id' => 'variant_id', 'placeholder' => 'Select Variant'],
                        'pluginOptions' => [
                            'depends' => ['w1'],
                            /* 'placeholder'=>'Select Account...', */
                            'url' => Url::to(['/variant/get-variant'])
                        ]
                    ]);
                    ?>
                    <div class="input-group-append" style="height: 34px;">
                        <a class="btn btn-primary" href="<?php echo $baseUrl . '../variant/create'; ?>" data-pjax="0" onclick="addnew1(event, this)" >
                            + 
                        </a>
                    </div>
                </div>
            </div>
            <?php Pjax::end(); ?>

            <?php Pjax::begin(); ?>
            <div class="form-group field-inventory-purchase_id">


                <?php
                echo '<label class="control-label">Purchased Invoice</label>';
                ?>


                <div class="input-group">

                    <?php
                    echo Select2::widget([
                        'name' => 'Inventory[purchase_id]',
                        'data' => ArrayHelper::map(\app\models\Purchase::find()->all(), 'id', 'invoice_number'),
                        'options' => [
                            'placeholder' => 'Select Purchase',
                            'multiple' => false
                        ],
                    ]);
                    ?>

                    <div class="input-group-append" style="height: 34px;">
                        <a class="btn btn-primary" href="<?php echo $baseUrl . '../purchase/create'; ?>" data-pjax="0" onclick="addnew1(event, this)">
                            add 
                        </a>
                    </div>
                </div>
            </div>
            <?php Pjax::end(); ?>

            <?php Pjax::begin(); ?>
            <div class="form-group field-inventory-purchase_id">


                <?php
                echo '<label class="control-label">Purchase Unit</label>';
                ?>


                <div class="input-group">

                    <?php
                    echo Select2::widget([
                        'name' => 'Inventory[unit_id]',
                        'data' => ArrayHelper::map(\app\models\SiUnit::find()->all(), 'id', 'name'),
                        'options' => [
                            'placeholder' => 'Select Unit',
                            'multiple' => false
                        ],
                    ]);
                    ?>

                    <div class="input-group-append" style="height: 34px;">
                        <a class="btn btn-primary" href="<?php echo $baseUrl . '../si-unit/create'; ?>" data-pjax="0" onclick="addnew1(event, this)">
                            add 
                        </a>
                    </div>
                </div>
            </div>
            <?php Pjax::end(); ?>

            <?php Pjax::begin(); ?>
            <div class="form-group field-inventory-purchase_id">


                <?php
                echo '<label class="control-label">Sale Unit</label>';
                ?>


                <div class="input-group">

                    <?php
                    echo Select2::widget([
                        'name' => 'Inventory[sale_unit_id]',
                        'data' => ArrayHelper::map(\app\models\SiUnit::find()->all(), 'id', 'name'),
                        'options' => [
                            'placeholder' => 'Select Unit',
                            'multiple' => false
                        ],
                    ]);
                    ?>

                    <div class="input-group-append" style="height: 34px;">
                        <a class="btn btn-primary" href="<?php echo $baseUrl . '../si-unit/create'; ?>" data-pjax="0" onclick="addnew1(event, this)">
                            add 
                        </a>
                    </div>
                </div>
            </div>
            <?php Pjax::end(); ?>

            <?= $form->field($model, 'cost_price')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'sale_price')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'quantity')->textInput() ?>

            <?= $form->field($model, 'discount')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'tax')->textInput(['maxlength' => true]) ?>

            <?php
            if (Yii::$app->user->identity->role == "Admin") {
                echo $form->field($model, 'status')->dropDownList(['1' => 'Active', '0' => 'InActive',]);
            } else {
                echo $form->field($model, 'status')->hiddenInput(['value' => '1'])->label(false);
            }
            ?> 
            
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
