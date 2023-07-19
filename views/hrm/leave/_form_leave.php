<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap4\Modal;
use kartik\date\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\models\Department */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="leave-form">

    <?php

    $form = ActiveForm::begin([
        'id' => 'form',
        'enableAjaxValidation' => true,
        'validationUrl' => ($model->isNewRecord) ?Yii::$app->homeUrl.'hrm/validate-leave':Yii::$app->homeUrl.'hrm/validate-leave?id='.$model->id.'',
        'options' => [
            'class' => 'm-form m-form--state',
            'autocomplete'=>'off'
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
	
	<!-- <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?> -->

    <?php
        echo $form->field($model, 'user_id')->widget(Select2::classname(), [
            'data' =>  ArrayHelper::map(\app\models\User::find()->where(['status'=>'1'])->andFilterWhere(['and',['!=', 'role','Administrator']])->andFilterWhere(['and',['!=', 'role','Admin']])->all(), 'id', 'username'),
            'options' => [
                'placeholder' => 'Select a Employee',
                'allowClear' => true,
                'multiple' => false,
            ],
            'size' => Select2::MEDIUM,
            //'hideSearch' => true,
            //'theme' => Select2::THEME_BOOTSTRAP,
        ]);
    ?>

    <?php echo '<label class="form-control-label" for="Date Range">Leave To-From</label>'; ?>

    <?php
        echo DatePicker::widget([
            'model' => $model,
            'attribute' => 'leave_from',
            'attribute2' => 'leave_to',
            'options' => ['placeholder' => 'Start date'],
            'options2' => ['placeholder' => 'End date'],
            'type' => DatePicker::TYPE_RANGE,
            'form' => $form,
            'pluginOptions' => [
                'todayHighlight' => true,
                'format' => 'yyyy-mm-dd',
                'autoclose' => true,
            ]
        ]);
    ?>

    <!-- <?= $form->field($model, 'leave_from')->textInput() ?>

    <?= $form->field($model, 'leave_to')->textInput() ?>

    <?= $form->field($model, 'leave_type_id')->textInput() ?> -->

    <?php
        echo $form->field($model, 'leave_type_id')->widget(Select2::classname(), [
            'data' =>  ArrayHelper::map(\app\models\LeaveType::find()->where(['status'=>'1'])->all(), 'id', 'leave_name'),
            'options' => [
                'placeholder' => 'Select Leave Type',
                'allowClear' => true,
                'multiple' => false,
            ],
            'size' => Select2::MEDIUM,
            //'hideSearch' => true,
            //'theme' => Select2::THEME_BOOTSTRAP,
        ])->label('Leave Type');
    ?>

    <?php
        echo $form->field($model, 'applied_on')->widget(DatePicker::className(),[
            'type' => 1,
            'removeButton' => ['icon' => 'trash'],
            'options' => ['placeholder' => 'Applied on'],
            'pickerButton' => false,
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'autoclose' => true,
                'todayHighlight' => true,
            ]
        ]);
    ?>

    <?= $form->field($model, 'leave_reason')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'status')->dropDownList([ '0', '1', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'created_on')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_on')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?> -->

    <?= $form->field($model, 'leave_status')->dropDownList(['1'=>'approved','2'=>'pending','3'=>'rejected', ]) ?>

    <?= $form->field($model, 'status')->dropDownList(['1'=>'Active','0'=>'InActive', ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>





