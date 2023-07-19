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
<style>
    .select2.select2-container.select2-container--krajee-bs4{
        width:auto !important;
    }

</style>
<div class="product-form">
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
                        'id' => 'id_select',
                        'placeholder' => 'Select Variant',
                        'multiple' => true
                    ],
                ]);
                ?>
                <div class="input-group-append" >
                    <a class="btn btn-primary" href="<?php echo $baseUrl . '../variant/create'; ?>" data-pjax="0" onclick="addnew1(event, this)" >
                        Add Variant 
                    </a>
                    <?php
                    echo Html::a('<i class="fa fa-check" ></i> Send', null, [
                        'class' => 'btn btn-primary',
                        'title' => Yii::t('yii', 'Enviar'),
                        'onclick' => "
            $('#hidden_warehouse').show();
            var id_select = $('#id_select').val();
            if(id_select == '')
            {
               $('#hidden_warehouse').hide();
            }
            text_select = [];
            $('#id_select option:selected').each(function () {
                var \$this = $(this);
                if (\$this.length) {
                  text_select.push(\$this.text());
                }
             });
             
            $.each(text_select, function (index, value) {
                
                $('#warehouse').append('<div class=\"form-row\" id=\"'+id_select[index]+'-'+value+'\"><div class=\"col-md-2 mb-3\"><span> '+value+'</span></div><div class=\"col-md-2 mb-3\"><input id=\"quantity\" type=\"number\" class=\"form-control \" placeholder=\"Variant Quantity\" value=\"0\" min=\"0\" required name=\"quantity[]\"></div><div class=\"col-md-3 mb-3\"><input id=\"quantity\" type=\"text\" class=\"form-control \" placeholder=\"Variant Code\" required name=\"variant_codes[]\"></div><div class=\"col-md-4 mb-3\"><div class=\"variant_warehouse\"></div></div><div class=\"col-md-1 mb-3\"><div class=\"remove\" id=\"'+id_select[index]+'-'+value+',remove\" onclick=\"remove_variant(this.id)\"><button type=\"button\"  class=\"close\" style=\"float: none;margin-left: 18px;text-align: right;margin-top: 9px;\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div></div><input type=\"hidden\" value='+id_select[index]+' name=\"variant_ids[]\"></div>');
                    $('.variant_warehouse').html('');
                    $('.radio').clone().appendTo($('.variant_warehouse'));
                });
                
            "]);
                    ?>
                </div>
            </div>
        </div>
        <?php Pjax::end(); ?>

        <div id="form" class="" style="display:none">

            <div class="form-group"> 
                <label class=" control-label" for="awesomeness">Warehouse</label> 
                <div class=""> 
                    <div class="radio" > 
                        <?= Html::dropDownList('warehouse_ids[]', null, ArrayHelper::map(\app\models\Department::find()->where(['warehouse' => 1])->all(), 'id', 'name'), ['class' => 'form-control warehouse', 'prompt' => 'Select a Warehouse']);
                        ?>
                    </div> 

                </div> </div>
            <!--                </form> </div>-->
        </div>




        <div style="display:none" id="hidden_warehouse">
            <div class="card">
                <article class="card-body" id="warehouse"> 
                    <?php print_r($warehouses->models) ?>
                    <?php foreach ($warehouses as $warehouse) { ?>

                        <div class="form-row" id="3-ee"><div class="col-md-2 mb-3">
                                <span> <?= $warehouse->variant->name ?></span>
                            </div>
                            <div class="col-md-2 mb-3">
                                <input id="quantity" type="number" class="form-control " placeholder="Variant Quantity" value="0" min="0" required="" name="quantity[]" value="<?= $warehouse->in ?>">
                            </div>
                            <div class="col-md-3 mb-3">
                                <input id="quantity" type="text" class="form-control " placeholder="Variant Code" required="" name="variant_codes[]">
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="variant_warehouse">
                                    <div class="radio"> 
                                        <select class="form-control warehouse" name="warehouse_ids[]">
                                            <option value="">Select a Warehouse</option>
                                            <option value="12">Human Resource</option>
                                        </select>                    
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 mb-3">
                                <div class="remove" id="3-ee,remove" onclick="remove_variant(this.id)">
                                    <button type="button" class="close" style="float: none;margin-left: 18px;text-align: right;margin-top: 9px;" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" value="3" name="variant_ids[]">
                        </div>
                    <?php } ?>
                </article>
            </div>
        </div> 
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
                <div class="input-group-append" style="height: 34px;
                     ">
                    <a class="btn btn-primary" href="<?php echo $baseUrl . '../brand/create';
                ?>" data-pjax="0" onclick="addnew1(event, this)" >
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

        <?php //echo $form->field($model, 'updated_by')->textInput()      ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

