<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PatientSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<?php

if(Yii::$app->request->queryParams)
{
    echo '<div data-pjax = 0 class="m-portlet m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_7">';

}else { ?>

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


    <div class="patient-search">

        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'options' => [
                'data-pjax' => 1
            ],
        ]); ?>

            <div class="m-form m-form--label-align-right">
                <div class="row align-items-center">
                    <div class="col-xl-12 order-2 order-xl-1">
                        <div class="form-group m-form__group row">

                            <div class="col-md-2">
                                <?= $form->field($model, 'reg_no') ?>

                            </div>
                            <div class="col-md-2">

                                    <?= $form->field($model, 'name') ?>

                            </div>

                            <div class="col-md-2">
                                <?= $form->field($model, 'cnic') ?>
                            </div>

                            <div class="col-md-2">
                                <?= $form->field($model, 'phone_no') ?>

                            </div>

                            <div class="col-md-2">
                                <?= $form->field($model, 'email') ?>

                            </div>
                            <div class="col-md-2">
                                <?php

                                // Normal select with ActiveForm & model
                                echo $form->field($model, 'gender')->widget(Select2::classname(), [
                                    'data' => array("Male"=>"Male","Female"=>"Female","Other"=>"Other"),
                                    'theme' => Select2::THEME_BOOTSTRAP,
                                    'options' => ['placeholder' => ''],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]);




                                ?>

                            </div>
                            <div class="col-md-2">
                                <?= $form->field($model, 'age') ?>

                            </div>
                            <div class="col-md-2">
                                <?= $form->field($model, 'relationship') ?>

                            </div>
                            <div class="col-md-2">
                                <?= $form->field($model, 'whatsapp_no') ?>

                            </div>
                            <div class="col-md-2">
                            
                                <?= $form->field($model, 'city') ?>

                            </div>
                            <div class="col-md-2">
                                <?= $form->field($model, 'country') ?>
                            </div>
                            <div class="col-md-2">
                                <?php

                                // Normal select with ActiveForm & model
                                echo $form->field($model, 'created_by')->widget(Select2::classname(), [
                                    'data' => ArrayHelper::map(\app\models\User::find()->where(['role'=>'reception'])->all(),'id','username'),
                                    'theme' => Select2::THEME_BOOTSTRAP,
                                    'options' => ['placeholder' => ''],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]);




                                ?>

                            </div>

                        </div>



                        <div class="form-group">
                            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                            <?= Html::a('Reset', ['/patient/index'], ['class'=>'btn btn-default']) ?>
                            
                        </div>

                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end: Search Form -->

</div>


