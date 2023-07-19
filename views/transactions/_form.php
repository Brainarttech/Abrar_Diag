<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
date_default_timezone_set('Asia/Karachi');

/* @var $this yii\web\View */
/* @var $model app\models\Patient */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-form">

    <?php
    $form = ActiveForm::begin([
        'id' => 'form',
        'enableAjaxValidation' => true,
        'validationUrl' => ($model->isNewRecord) ?Yii::$app->homeUrl.'transactions/validate':Yii::$app->homeUrl.'transactions/validate?id='.$model->id.'',
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

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'charts_of_accounts_id')->widget(Select2::classname(), [
                'data' => $data,
                'language' => 'de',
                'options' => ['placeholder' => 'Select a Account Detail ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
            <?php
                //echo $model->debit.'<br>'.$model->credit;
                if($model->debit === 0){
                    echo $form->field($model, 'credit')->textInput(['maxlength' => true])->label('Amount');
                    //echo 'abc';
                }
                if($model->credit === 0){
                    echo $form->field($model, 'debit')->textInput(['maxlength' => true])->label('Amount');
                    //echo 'xyz';
                }

                
            ?>
            <?php
                echo '<div class="form-group field-accounttransactions-time required"><label class="control-label">Date Time</label>';
                echo DateTimePicker::widget([
                    'name' => 'AccountTransactions[created_on]',
                    //'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
                    //'type' => DateTimePicker::TYPE_INPUT,
                    'value' => str_replace('/', '-', date('Y/m/d h:i:s', time())),//date('dd/M/yyyy hh:ii', time()),
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-m-dd hh:ii:ss',
                        //'format' => 'dd.mm.yyyy',
                        'defaultViewDate' => true,
                        'todayHighlight' => true,
                        'todayBtn' => true,
                        'keyboardNavigation' => false,
                    ]
                ]);
                echo '</div>';
            ?>
        </div>
        <div class="col-md-6">
            
            <?= $form->field($model, 'description')->textarea(['rows' => '3']) ?>

            <?php
            /*echo "<pre>";
            echo print_r($data2);
            echo "</pre>";*/


            $arr[1] = ['id'=>'1','acc'=>'With Draw'];
            $arr[2] = ['id'=>'2','acc'=>'Deposit'];
            $abc = ArrayHelper::map($arr, 'id', 'acc');
            //$catList = [['id'=>'1','cat-id'=>'With Draw 1'],['id'=>'2','cat-id'=>'With Draw 2']];

            // Parent
            //$value = 2;
            echo $form->field($model, 'actype')->dropDownList($abc, ['id'=>'acc', 'options'=>[$value=>['Selected'=>true]], 'prompt' => 'Select Type...']);

            /*echo "<pre>";
            echo print_r($data2);
            echo "</pre>";*/

            // Child # 1
            echo $form->field($model, 'account_used')->widget(DepDrop::classname(), [//subcat
                'type'=>DepDrop::TYPE_SELECT2,
                //'data'=>[0 => 'Tablets'],
                //'data'=>$a,
                'data'=>$data2,
                //'data'=>'{"output":{"Income":[{"id":"134","name":"Income & Bonuses","accountGroup":null}]},"selected":""}',
                'options'=>['id'=>'subcat-id','placeholder' => 'Select Account'],
                'pluginOptions'=>[
                    'depends'=>['acc'],
                    /*'placeholder'=>'Select Account...',*/
                    'url'=>Url::to(['/transactions/subcat'])
                ]
            ]);

            ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Done', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>