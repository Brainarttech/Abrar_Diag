<?php

use app\models\User;
use app\helpers\Helper;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'EMPLOYEE SALARY LIST';
$this->params['breadcrumbs'][] = $this->title;

$status = array('0'=>Yii::t('app', 'Inactive'),'1'=>Yii::t('app', 'Active'));

?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<style>

    .project-people, .project-actions{
        text-align: right;
        vertical-align: middle;
    }

    .project-people img{
        width: 32px;
        height: 32px;
    }

    .label-primary, .badge-primary{
        background-color: #1ab394;
        color: #FFFFFF;
        padding: 3px 6px;
    }
	
</style>
<div class="user-index">

    <?php Pjax::begin(); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsiveWrap' => false,
        'toolbar' =>  [
            //'{export}',
            '{toggleData}',
        ],

        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<h5 class="card-title"><i class="fa fa-th-list"></i> '.Yii::t ( 'app', 'EMPLOYEE SALARY LIST' ).' </h5>',
            'before' => '',
            'after' => '</form>'.Html::a('<i class="fa fa-sync"></i> ' . Yii::t('app', 'Reset List'), [
                    'index'
                ], [
                    'class' => 'btn btn-primary btn-sm'
                ]),
            'showFooter' => false,

        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
            'email:email',
			//'designation_id',
			[
				'attribute' => 'designation',
				'value' => 'designation.designation_name',
			],
			'payment_type',
			'basic_salary',
			'overtime_salary',
            // [
                // 'attribute'=>'status',
                // 'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                // 'contentOptions' => ['class' => 'text-center'],
                // 'value'=>function($model)
                // {
                    // return Helper::statusLabel($model->status);
                    // //return statusLabel($model->status);
                // },
                // 'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                // 'filter' => [
                    // 0 => 'Inactive',
                    // 1 => 'Active',
                // ],
                // 'filterWidgetOptions' => [
                    // 'theme' => Select2::THEME_BOOTSTRAP,
                    // 'pluginOptions' => [
                        // 'allowClear' => true,
                    // ],
                // ],
                // 'filterInputOptions' => ['placeholder' => 'All...'],
                // 'format'=>'raw',
            // ],
			[
                'class' => '\kartik\grid\ActionColumn',
                'template' => '{update}',
                'contentOptions' => ['style' => 'width:50px;'],
                'buttons' => [
                    'update' => function ($url, $model)
                    {
                        return '<a href="#"><span class="fas fa-pencil-alt"  onclick="updateRecord('.$model->id.',\'hrm\',\'Update Employee Salary: '.$model->username.'\',event,\'update-employee-salary-list\')"></span></a>';
                    },
                ]
            ] ,
		    // [
				// 'class' => 'kartik\grid\ActionColumn',
				// 'template'=>'{view}{update}',
				// 'headerOptions' => ['style' => 'width:8%'],
				// 'buttons'=>[
					// 'view' => function ($url, $model) {
						// return Html::a('<i class="fas fa-eye"></i>', $url, [
							// 'title' => Yii::t('yii', 'View'),
						// ]);
					// },
					// 'update' => function ($url, $model) {
						// return Html::a('<i class="fas fa-pencil-alt"></i>', $url, [
							// 'title' => Yii::t('yii', 'Update'),
						// ]);
					// }
				// ]
			// ],
            // [
                // 'class' => 'kartik\grid\ActionColumn',
				// //'deleteOptions' => ['label' => '<i class="glyphicon glyphicon-remove"></i>'],
				
				
                // //'dropdown' => false,
                // //'dropdownButton'=>['class'=>'mb-1 mt-1 mr-1 btn btn-xs btn-primary dropdown-toggle'],
                // //'dropdownOptions' => ['class' => 'pull-right'],
                // // 'template' => '{edit}',
                // // 'buttons' => [
                    // // 'edit' => function ($url, $model) {
                        // // $title = Yii::t('app', 'Update User');
                        // // $options = []; // you forgot to initialize this
                        // // $icon = '<span class=""></span>';
                        // // $label = $icon . ' ' . $title;
                        // // $url = '';
                        // // $options['class'] = 'dropdown-item text-1';
                        // // $options['onclick'] = 'updateRecord('.$model->id.',\'user\',\'Update User\',event)';
                        // // return '<li>' . Html::a($label, $url, $options) . '</li>' . PHP_EOL;
                    // // },
                // // ],
                // // 'headerOptions' => ['class' => 'kartik-sheet-style'],
            // ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>


<script>

    function changePassword(id,controller,title,event) {

        event.preventDefault();
        var dialog = bootbox.dialog({
            title: title,
            message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',


        });


        dialog.init(function(){
            var request = $.ajax({
                url: baseUrl+controller+"/update?id="+id+"&change-password=true",
                method: "GET",
            });

            request.done(function( msg ) {
                dialog.find('.bootbox-body').html(msg);


            });

            $(document).on("submit", "#form", function (event) {
                event.preventDefault();
                event.stopImmediatePropagation();

                $(this).submit(function() {
                    return false;
                });


                $form = $(this); //wrap this in jQuery

                var url = $form.attr('action');

                $.ajax({
                    type: "POST",
                    url: url,
                    data: $("#form").serialize(),
                    // serializes the form's elements.
                    success: function(data)
                    {
                        if(data==true)
                        {
                            //toastr.success('', 'Update Successfully', {timeOut: 2000});
                            $.pjax.defaults.timeout = 5000;
                            $.pjax.reload({container:'#p0'});
                            bootbox.hideAll();
                        }
                        else
                        {
                            //toastr.success('', 'Some Error Occur', {timeOut: 2000});
                        }


                    }
                });
                // avoid to execute the actual submit of the form.
            });

        });

    }



    function externalWindow(id,event) {
        var scr_w, scr_w1;
        var scr_h, scr_h1;
        scr_w1 = 1015;
        scr_h1 = 740;

        if (scr_w == '800'){
            scr_w1 = 785;
            scr_h1 = 500;
        }

        var url = "<?= Yii::$app->homeUrl?>site/switch-identity?id="+id;
        var printWindow =

            window.open (url, 'Print' ,
                "dependant=no,directories=no,location=no,menubar=no"
                +   ",resizable=no,scrollbars=yes,titlebar=no,toolbar=no,"
                + "0, 0, top=0,left=0,status=1,width=" +scr_w1+",height="+scr_h1);



        //window.open(url, 'Print', 'left=100, top=100, width=' + width + ', height=' + height + ', toolbar=0, resizable=0');


    }


</script>