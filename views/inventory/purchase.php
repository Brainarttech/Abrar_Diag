<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use dosamigos\fileupload\FileUpload;

\app\assets\InventoryAsset::register($this);

$baseUrl = Yii::$app->homeUrl;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--begin::Web font -->
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>

        <script>
            WebFont.load({
                google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
                active: function () {
                    sessionStorage.fonts = true;
                }
            });
        </script>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <script src="<?= $baseUrl ?>js/jquery.min.js"></script>
    </head>
    <body ng-app="myApp"    class="m--skin- m-page--loading-enabled m-page--loading m-content--skin-light m-header--fixed m-header--fixed-mobile m-aside-left--offcanvas-default m-aside-left--enabled m-aside-left--fixed m-aside-left--skin-dark m-aside--offcanvas-default"  >
        <?php $this->beginBody() ?>

        <!-- begin::Page loader -->
        <div class="m-page-loader m-page-loader--base">
            <div class="m-blockui">
                <span>
                    Loading Data...
                </span>
                <span>
                    <div class="m-loader m-loader--brand"></div>
                </span>
            </div>
        </div>
        <!-- end::Page Loader -->


        <!-- END: Header -->

        <!-- begin::Body -->

        <div class="inventory-form">
            <div class="row">
                <div class="col-md-12">
                    <?php $form = ActiveForm::begin(); ?>
                    <div class="purchase-form">

                        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body" style="background: #f2f3f8;padding-top: 30px !important;" >

                            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-container m-container--responsive m-container--xxl m-container--full-height">
                                <div class="m-grid__item m-grid__item--fluid m-wrapper">
                                    <div class="row" >
                                        <div class="col-md-6">
                                            <?= Html::label('Supplier', 'supplier_id') ?>

                                            <?php
                                            echo Select2::widget([
                                                'name' => 'supplier_id',
                                                'data' => ArrayHelper::map(\app\models\Supplier::find()->all(), 'id', 'name'),
                                                'options' => [
                                                    'placeholder' => 'Select Supplier',
                                                    'multiple' => false
                                                ],
                                            ]);
                                            ?>
                                        </div>

                                        <div class="col-md-6">
                                            <?= Html::label('Invoice Number') ?>

                                            <?= Html::textInput('invoice_number', '', ['class' => 'form-control']); ?>
                                        </div>

                                        <div class="col-md-6">
                                            <?= Html::label('Payment Due Date') ?>

                                            <?=
                                            DatePicker::widget([
                                                'name' => 'due_date',
                                                'type' => DatePicker::TYPE_INPUT,
                                                'options' => ['placeholder' => 'Enter Due date'],
                                                'removeButton' => false,
                                                'pluginOptions' => [
                                                    'autoclose' => true,
                                                    'format' => 'yyyy-mm-dd'
                                                ]
                                            ]);
                                            ?>
                                        </div>



                                        <div class="col-md-6">
                                            <?= Html::label('Warehouse') ?>
                                            <?php
                                            echo Select2::widget([
                                                'name' => 'warehouse_id',
                                                'data' => ArrayHelper::map(\app\models\Department::find()->where(['warehouse' => 1])
                                                                ->all(), 'id', 'name'),
                                                'options' => [
                                                    'placeholder' => 'Select Warehouse',
                                                    'multiple' => false
                                                ],
                                            ]);
                                            ?>
                                        </div>



                                        <div class="col-md-6">
                                            <?php //$form->field($model, 'file')->fileInput()   ?>
                                            <?= Html::label('Image') ?>

                                            <?=
                                            FileUpload::widget([
                                                'name' => 'file',
                                                'attribute' => 'file', // your url, this is just for demo purposes,
                                                'options' => ['accept' => 'image/*'],
                                                'url' => ['purchase/upload-invoice'],
                                                'options' => ['style' => 'margin-top: -12px;margin-bottom: -6px;;margin-top: -11px;position: inherit;font-size: x-large!important;'],
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
                                        </div>

                                        <div class="col-md-6">
                                            <?= Html::label('Note') ?>

                                            <?= Html::textInput('note', '', ['class' => 'form-control']); ?>
                                        </div>

                                        <?= Html::hiddenInput('hospital_id', 1); ?>


                                        <?= Html::hiddenInput('attachment', '', ['id' => 'attachment'], ['class' => 'form-control']); ?>
                                        <?= Html::hiddenInput('status', 'Payment Pending', ['class' => 'form-control']); ?>







                                    </div>
                                    <div class="m-content" style="background: #f2f3f8;padding-top: 30px !important;">

                                        <div class="row ng-view">

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
            <!-- end:: Body -->
        </div>
        <!-- end:: Page -->


        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
