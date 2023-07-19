<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Variant */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="variant-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php Pjax::begin(); ?>
    <div class="form-group field-variant-product_id">
        <?php
        echo '<label class="control-label">Product Name</label>';
        ?>
        <div class="input-group">
            <?php
            echo Select2::widget([
                'name' => 'Variant[product_id]',
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
