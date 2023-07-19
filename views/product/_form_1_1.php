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
    <div class="container">
        <div class="row" style="display:block">
            <?php
            $form = ActiveForm::begin();
            ?>
            <div class="col-md-6"> 
                <?php Pjax::begin(); ?>
                <div class="form-group field-inventory-product_id">
                    <?php
                    echo '<label class="control-label">Category Name</label>';
                    ?>
                    <div class="input-group">
                        <?php
                        echo Select2::widget([
                            'name' => 'root_id',
                            'data' => ArrayHelper::map(\app\models\Category::find()->roots()->all(), 'id', 'name'),
                            'options' => [
                                'placeholder' => 'Select Category',
                                'multiple' => false
                            ],
                        ]);
                        ?>
                        <div class="input-group-append" style="height: 34px;">
                            <a class="btn btn-primary" href="<?php echo $baseUrl . '../category/create'; ?>" data-pjax="0" onclick="addnew1(event, this)" >
                                Add Category 
                            </a>
                        </div>
                    </div>
                </div>


                <div class="form-group field-inventory-product_id" id="sub" style="display:none">
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
                                'depends' => ['w1'],
                                'placeholder' => 'Select Sub Category',
                                'url' => Url::to(['/category/get-sub-category'])
                            ],
                            'pluginEvents' => [
                                'change' => "function() {  if($('#category_id option').length != 1 ) $('#sub').show(); else $('#sub').hide(); } ",
                            ]
                        ]);
                        ?>
                    </div>
                </div>

                <div class="form-group field-inventory-product_id" id="sub-sub" style="display:none">
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
                                'placeholder' => 'Select sub sub category',
                                'url' => Url::to(['/category/get-sub-category'])
                            ],
                            'pluginEvents' => [
                                'change' => "function() {  if($('#item_id option').length != 1 ) $('#sub-sub').show(); else $('#sub-sub').hide(); } ",
                            ]
                        ]);
                        ?>
                    </div>
                </div>
                <?php Pjax::end(); ?>

                <?php Pjax::begin(); ?>
                <div class="form-group field-inventory-brand_id">
                    <?php
                    echo '<label class="control-label">Variant Name</label>';
                    ?>
                    <div class="input-group">
                        <?php
                        echo Select2::widget([
                            'name' => 'variant_id',
                            'data' => ArrayHelper::map(\app\models\Variant::find()->all(), 'id', 'name'),
                            'size' => Select2::MEDIUM,
                            'options' => [
                                'placeholder' => 'Select Variant',
                                'multiple' => true
                            ],
                        ]);
                        ?>
                        <div class="input-group-append" >
                            <a class="btn btn-primary" href="<?php echo $baseUrl . '../variant/create'; ?>" data-pjax="0" onclick="addnew1(event, this)" >
                                Add Variant 
                            </a>
                        </div>
                    </div>
                </div>
                <?php Pjax::end(); ?>

                <?php Pjax::begin(); ?>
                <div class="form-group field-inventory-brand_id">
                    <?php
                    echo '<label class="control-label">Brand Name</label>';
                    ?>
                    <div class="input-group">
                        <?php
                        echo Select2::widget([
                            'name' => 'Product[brand_id]',
                            'data' => ArrayHelper::map(\app\models\Brand::find()->all(), 'id', 'name'),
                            'options' => [
                                'placeholder' => 'Select Brand',
                                'multiple' => false
                            ],
                        ]);
                        ?>
                        <div class="input-group-append" style="height: 34px;">
                            <a class="btn btn-primary" href="<?php echo $baseUrl . '../brand/create'; ?>" data-pjax="0" onclick="addnew1(event, this)" >
                                Add Brand 
                            </a>
                        </div>
                    </div>
                </div>
                <?php Pjax::end(); ?>

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

                <?php //echo $form->field($model, 'created_on')->textInput()    ?>

                <?php //echo $form->field($model, 'created_by')->textInput()     ?>

                <?php //echo $form->field($model, 'updated_on')->textInput()     ?>

                <?php //echo $form->field($model, 'updated_by')->textInput()     ?>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>