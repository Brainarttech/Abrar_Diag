<?php

use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

\kartik\select2\Select2Asset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="user-form">

    <?php

    $form = ActiveForm::begin([
        'id' => 'form',
        'enableAjaxValidation' => true,
        'validationUrl' => ($model->isNewRecord) ?Yii::$app->homeUrl.'user/validate':Yii::$app->homeUrl.'user/validate?id='.$model->id.'',
        //'errorCssClass' => 'has-danger',
        'options' => [
            'class' => 'm-form m-form--state',
            'enctype' => 'multipart/form-data'
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
		<div class="row">
			<div class="col-md-12">
				<?= $form->field($model, 'payment_type')->dropDownList(['Monthly'=>'Monthly','Hourly'=>'Hourly','Yearly'=>'Yearly',]) ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?= $form->field($model, 'basic_salary')->textInput(['maxlength' => true]) ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?= $form->field($model, 'overtime_salary')->textInput(['maxlength' => true]) ?>
			</div>
		</div>
		<div class="form-group">
			<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
		</div>
    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    $( document ).ready(function() {
        //$('#user-assign_department').select2();
    });
</script>