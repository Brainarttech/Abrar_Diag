<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use dosamigos\fileupload\FileUpload;
use kartik\form\ActiveForm;
use kartik\builder\TabularForm;
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\Purchase */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="purchase-form">

    <?php
    $form = ActiveForm::begin([
                'id' => 'form',
                'enableAjaxValidation' => true,
                'options' => ['enctype' => 'multipart/form-data'],
                'validationUrl' => ($model->isNewRecord) ? Yii::$app->homeUrl . 'purchase/validate' : Yii::$app->homeUrl . 'purchase/validate?id=' . $model->id . '',
                'options' => [
                    'class' => 'm-form m-form--state',
                    'autocomplete' => 'off'
                ],
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'form-control-label '],
                /* 'horizontalCssClasses' => [
                  'error' => 'form-control-feedback',
                  ], */
                ],
    ]);
    ?>

    <?= $form->field($model, 'supplier_id')->dropDownList(ArrayHelper::map(\app\models\Supplier::find()->all(), 'id', 'name'), ['prompt' => 'Select Supplier']) ?>

    <?= $form->field($model, 'invoice_number')->textInput() ?>

    <?= $form->field($model, 'total')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'paid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_discount')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'due_date')->widget(DatePicker::classname(), [
        'type' => DatePicker::TYPE_INPUT,
        'options' => ['placeholder' => 'Enter Due date'],
        'removeButton' => false,
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]);
    ?>
    <!-- <?= ''; /* $form->field($model, 'warehouse_id')->dropDownList(ArrayHelper::map(\app\models\Warehouse::find()->all(), 'id', 'name'), ['prompt' => 'Select Warehouse']);*/ ?> -->
    <?= $form->field($model, 'warehouse_id')->dropDownList([], ['prompt' => 'Select Warehouse']) ?>


    <?php //$form->field($model, 'file')->fileInput()   ?>

    <?=
    FileUpload::widget([
        'model' => $model,
        'attribute' => 'file', // your url, this is just for demo purposes,
        'options' => ['accept' => 'image/*'],
        'url' => ['purchase/upload-invoice'],
        'clientOptions' => [
            'maxFileSize' => 2000000
        ],
        // Also, you can specify jQuery-File-Upload events
        // see: https://github.com/blueimp/jQuery-File-Upload/wiki/Options#processing-callback-options
        'clientEvents' => [
            'fileuploaddone' => 'function(e, data) {
                                document.getElementById("attachment").value = data.result;
                            }',
            'fileuploadfail' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
        ],
    ]);
    ?>
    <div id="errors">

    </div>
    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hospital_id')->hiddenInput(['value' => 1])->label(false); ?>

    <?= $form->field($model, 'attachment')->hiddenInput(['id' => 'attachment'])->label(false); ?>

    <?php
    $dataProvider = new ArrayDataProvider([
        'allModels' => [
        ]
    ]);
    echo TabularForm::widget([
        // your data provider
        'dataProvider' => $dataProvider,
        // formName is mandatory for non active forms
        // you can get all attributes in your controller 
        // using $_POST['kvTabForm']
        'formName' => 'kvTabForm',
        // set defaults for rendering your attributes
        'attributeDefaults' => [
            'type' => TabularForm::INPUT_TEXT,
        ],
        // configure attributes to display
        'attributes' => [
            'id' => ['label' => 'book_id', 'type' => TabularForm::INPUT_HIDDEN_STATIC, 'columnOptions' => ['vAlign' => GridView::ALIGN_MIDDLE]],
            'name' => ['label' => 'Book Name'],
            'publish_date' => ['label' => 'Published On', 'type' => TabularForm::INPUT_STATIC]
        ],
        // configure other gridview settings
        'gridSettings' => [
            'condensed' => true,
            'panel' => [
                'heading' => '<i class="fas fa-book"></i> Manage Books',
                'before' => true,
                'type' => GridView::TYPE_PRIMARY,
                'before' => true,
                'footer' => false,
                'after' => Html::button('<i class="fas fa-plus"></i> Add New', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create']) . ' ' .
                Html::button('<i class="fas fa-times"></i> Delete', ['type' => 'button', 'class' => 'btn btn-danger kv-batch-delete']) . ' ' .
                Html::button('<i class="fas fa-save"></i> Save', ['type' => 'button', 'class' => 'btn btn-primary kv-batch-save'])
            ]
        ]
    ]);
    ?>

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
