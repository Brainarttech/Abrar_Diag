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
        <div class="col-md-6">
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>
        <?php
        if ($model->isNewRecord) { ?>
            <div class="col-md-6">
                <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>
            </div>

        <?php } else { ?>
            <div class="col-md-6">
                <?= $form->field($model, 'phone_no')->textInput(['maxlength' => true]) ?>
            </div>

        <?php } ?>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'status')->dropDownList(['1'=>'Active','0'=>'InActive', ]) ?>
        </div>
    </div>
    <?php if ($model->isNewRecord) {?>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'phone_no')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?php
                    echo $form->field($model, 'role')->widget(Select2::classname(), [
                        'data' =>  ArrayHelper::map(\app\modules\rbac\models\AuthItem::find()->where(['type'=>1])->andWhere(['NOT IN','name',['Software Developer']])->andFilterWhere(['and',['!=', 'name','Administrator']])->andFilterWhere(['and',['!=', 'name','Admin']])->all(), 'name', 'name'),
                        'options' => ['placeholder' => 'Select a Role ...'],
                        'size' => Select2::SMALL,
                        'hideSearch' => true,
                        //'theme' => Select2::THEME_BOOTSTRAP,
                        'pluginOptions' => [
                            'allowClear' => true,
                            // 'multiple' => true,
                        ],
                    ]);
                ?>
            </div>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-md-6">
            <?php
                echo $form->field($model, 'assign_department')->widget(Select2::classname(), [
                    'data' =>  ArrayHelper::map(\app\models\Department::find()->where(['status'=>'1'])->all(), 'id', 'name'),
                    'options' => [
                        'placeholder' => 'Select a Department',
                        'allowClear' => true,
                        'multiple' => true,
                    ],
                    'size' => Select2::MEDIUM,
                    //'hideSearch' => true,
                    //'theme' => Select2::THEME_BOOTSTRAP,
                ]);
            ?>
        </div>
        <div class="col-md-6">
            <?php
                echo $form->field($model, 'designation_id')->widget(Select2::classname(), [
                    'data' =>  ArrayHelper::map(\app\models\Designation::find()->where(['status'=>'1'])->all(), 'id', 'designation_name'),
                    'options' => [
                        'placeholder' => 'Select a Designation',
                        'allowClear' => true,
                        'multiple' => false,
                    ],
                    'size' => Select2::MEDIUM,
                    //'hideSearch' => true,
                    //'theme' => Select2::THEME_BOOTSTRAP,
                ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'about')->textarea(['maxlength' => true]) ?>
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