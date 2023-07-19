
<?php

use kartik\file\FileInput;
use kartik\password\PasswordInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'My Profile';




?>
<style>
    .padding-15{
        padding: 15px;
    }
</style>

<div class="m-content">
    <div class="row">
        <div class="col-xl-3 col-lg-4">
            <div class="m-portlet m-portlet--full-height  ">
                <div class="m-portlet__body">
                    <div class="m-card-profile">
                        <div class="m-card-profile__title m--hide">
                            Your Profile
                        </div>
                        <div class="m-card-profile__pic">
                            <div class="m-card-profile__pic-wrapper">
                                <img src="<?= app\helpers\Helper::getBaseUrl()?>profile_image/<?= Yii::$app->user->identity->image?>" alt="">
                            </div>
                        </div>
                        <div class="m-card-profile__details">
												<span class="m-card-profile__name">
													<?= Yii::$app->user->identity->first_name . ' ' . Yii::$app->user->identity->last_name?>
												</span>
                            <a href="" class="m-card-profile__email m-link">
                                <?= Yii::$app->user->identity->email?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8">
            <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-tools">
                        <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#update" role="tab" aria-selected="true">
                                    <i class="flaticon-share m--hide"></i>
                                    Update Profile
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link" data-toggle="tab" href="#change_password" role="tab" aria-selected="false">
                                    Change Password
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active show" id="update">
                        <?php

                        $form = ActiveForm::begin([
                            'id' => 'form',
                            'errorCssClass' => 'has-danger',
                            'options'=>array('enctype' => 'multipart/form-data')
                        ]);
                        ?>

                        <div class="row padding-15">
                            <div class="col-md-6">
                                <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>

                        <div class="row padding-15">
                            <div class="col-md-6">
                                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'phone_no')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>

                        <div class="row padding-15">
                            <div class="col-md-6">
                                <?= $form->field($model, 'username')->textInput(['maxlength' => true,'readonly'=> true]) ?>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label" for="user-image">Image</label>
                                <?php


                                echo $form->field($model, 'file')->widget(FileInput::classname(), [
                                    'options' => ['multiple' => false, 'accept' => 'image/*'],
                                    'pluginEvents' => [
                                        'change' => 'function() { showImage(); }',
                                    ],
                                    'pluginOptions' => [
                                        'allowedFileExtensions'=>['jpg', 'gif', 'png', 'bmp'],
                                        'showPreview' => false,
                                        'showCaption' => true,
                                        'showRemove' => false,
                                        'showCancel' => false,
                                        'showUpload' => false,
                                        'initialCaption'=> $model->image,


                                    ]
                                ])->label(false);


                                ?>
                            </div>
                        </div>

                        <div class="row padding-15">
                            <div class="col-md-12">
                                <?= $form->field($model, 'about')->textarea(['maxlength' => true]) ?>
                            </div>

                        </div>

                        <div class="form-group padding-15">
                            <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
                        </div>



                        <?php ActiveForm::end(); ?>
                    </div>
                    <div class="tab-pane" id="change_password">



                        <?php if (Yii::$app->session->hasFlash('success')): ?>
                            <div class="row" style="padding-left: 50px;padding-right: 50px;padding-top: 20px;">
                            <div class="alert alert-success" role="alert" style="width: 100%;">
                                <strong>
                                    Well done!
                                </strong>
                                <?= Yii::$app->session->getFlash('success') ?>
                            </div>
                            </div>
                        <?php endif; ?>





                        <?php



                        $form2 = ActiveForm::begin([
                            'id' => 'form2',
                            'errorCssClass' => 'has-danger',
                        ]);


                        ?>

                        <div class="row padding-15">
                            <div class="col-md-12">
                                <?= $form2->field($changepassword, 'old_password')->passwordInput(['maxlength' => true]) ?>

                            </div>
                        </div>
                        <div class="row padding-15">
                            <div class="col-md-12">
                                <?php
                                echo $form2->field($changepassword, 'password')->widget(
                                    PasswordInput::classname()
                                )->label("New Password");

                                ?>                            </div>
                        </div>
                        <div class="row padding-15">
                            <div class="col-md-12">

                                <?php

                                echo $form2->field($changepassword, 'repeat_password')->widget(
                                    PasswordInput::classname()
                                );

                                ?>
                            </div>
                        </div>

                        <div class="form-group padding-15">
                            <?= Html::submitButton('Change Password', ['class' => 'btn btn-info']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>