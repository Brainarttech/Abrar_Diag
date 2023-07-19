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

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;



/*function getUserRoles($user_id){
    $connection = \Yii::$app->db;
    $sql="select auth_item.* from auth_item,auth_assignment where auth_item.type=1 and auth_assignment.user_id=$user_id and auth_assignment.item_name=auth_item.name";
    $command=$connection->createCommand($sql);
    $dataReader=$command->queryAll();
    $roles ='';
    if(count($dataReader) > 0){
        foreach($dataReader as $role){
            $roles.="<span class=\"label label-primary\">".$role['name']."</span></br>";
        }
    }
    return $roles;
}

function statusLabel($status)
{
    if ($status !='1')
    {
        $label = "<span class=\"label label-danger\">".Yii::t('app', 'Inactive')."</span>";
    }
    else
    {
        $label = "<span class=\"label label-primary\">".Yii::t('app', 'Active')."</span>";
    }
    return $label;
}*/
$status = array('0'=>Yii::t('app', 'Inactive'),'1'=>Yii::t('app', 'Active'));






?>
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
        //'filterModel' => $searchModel,
        'responsiveWrap' => false,
        'toolbar' =>  [
            //'{export}',
            '{toggleData}',
        ],

        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<h5 class="card-title"><i class="fa fa-th-list"></i> '.Yii::t ( 'app', 'User List' ).' </h5>',
            'before' => Html::a('<i class="fa fa-plus"></i> ' . Yii::t('app', 'Add New User'), [
                'create'
            ], ['data-pjax' => 0,'onclick'=>'addnew(event,this)',
                'class' => 'btn btn-primary btn-sm'
            ]),
            'after' => '</form>'.Html::a('<i class="fa fa-sync"></i> ' . Yii::t('app', 'Reset List'), [
                    'index'
                ], [
                    'class' => 'btn btn-primary btn-sm'
                ]),


            'showFooter' => false,

        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [

                'attribute' => 'image',

                'label' => Yii::t('app', 'Image'),

                'format' => 'raw',

                'width' => '50px',

                'value' => function ($model, $key, $index, $widget)

                {
                    $url = \app\helpers\Helper::getBaseUrl().'profile_image/'.$model->image;
                    $image = '<div class="project-people"><img src ="'.$url.'"></div>';

                    return $image;

                }
            ],
            'first_name',
            'last_name',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            [
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'tr-b'],
                'attribute' => 'id',
                'label'=>Yii::t('app', 'Roles'),

                'format' => 'raw',

                'value' => function ($model, $key, $index, $widget)

                {	  
                    //return getUserRoles($model->id);
					return Helper::getUserRoles($model->id);
                },
                'filter'=>false,

            ],

            [
                'attribute'=>'status',
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],

                'value'=>function($model)
                {
					return Helper::statusLabel($model->status);
                    //return statusLabel($model->status);
                },
                'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                'filter' => [
                    0 => 'Inactive',
                    1 => 'Active',
                ],
                'filterWidgetOptions' => [
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ],
                'filterInputOptions' => ['placeholder' => 'All...'],
                'format'=>'raw',
            ],
            [

                'attribute' =>  'created_on',
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'value' => function($model){
                    return date("d/m/Y", strtotime($model->created_on));
                },

                //'filter'=>false

            ],
            [

                'attribute' => 'created_by',
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'value'=>function($model)
                {
                    return \app\helpers\Helper::getUser($model->created_by);
                },
                //'value'=>'user.username',
                'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(User::find()->all(), 'id', 'username'),
                'filterWidgetOptions' => [
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ],
                'filterInputOptions' => ['placeholder' => 'All...'],
                'format'=>'raw',

            ],
            [

                //'attribute' =>  'created_on',
                'header'=>'Last Update',
                'headerOptions' => ['style' => 'width:10%','class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'format'=>'raw',
                'value' => function($model){
                    if($model->updated_by)
                    {
                        return date("d/m/Y", strtotime($model->updated_on)).'<br>'.\app\helpers\Helper::getUser($model->updated_by);

                    }else
                    {
                        return '';
                    }
                },
                //'filter'=>false

            ],

            [
                'class' => 'kartik\grid\ActionColumn',
                'dropdown' => true,
                'dropdownButton'=>['class'=>'mb-1 mt-1 mr-1 btn btn-xs btn-primary dropdown-toggle'],
                'dropdownOptions' => ['class' => 'pull-right'],
                'template' => '{edit}{change_password}{assign_role}{attendance}{attendance_search}',//{assign_role}
                'buttons' => [
                    'profile' => function ($url, $model) {

                        $title = Yii::t('app', 'Profile');
                        $options = []; // you forgot to initialize this
                        $icon = '<span class=""></span>';
                        $label = $icon . ' ' . $title;
                        $url = '';
                        $options['class'] = 'dropdown-item text-1';
                        $options['onclick'] = 'externalWindow('.$model->id.',event)';
                        return '<li>' . Html::a($label, $url, $options) . '</li>' . PHP_EOL;
                    },
                    'login' => function ($url, $model) {
                        $title = Yii::t('app', 'Auto Login');
                        $options = []; // you forgot to initialize this
                        $icon = '<span class=""></span>';
                        $label = $icon . ' ' . $title;
                        $url = '';
                        $options['class'] = 'dropdown-item text-1';
                        $options['onclick'] = 'externalWindow('.$model->id.',event)';
                        return '<li>' . Html::a($label, $url, $options) . '</li>' . PHP_EOL;
                    },
                    'send_email' => function ($url, $model) {
                        $title = Yii::t('app', 'Send Email');
                        $options = []; // you forgot to initialize this
                        $icon = '<span class=""></span>';
                        $label = $icon . ' ' . $title;
                        $url = '';
                        $options['class'] = 'dropdown-item text-1';
                        $options['onclick'] = 'sendEmail('.$model->id.',event)';
                        return '<li>' . Html::a($label, $url, $options) . '</li>' . PHP_EOL;
                    },
                    'send-sms' => function ($url, $model) {
                        $title = Yii::t('app', 'Send SMS');
                        $options = []; // you forgot to initialize this
                        $icon = '<span class=""></span>';
                        $label = $icon . ' ' . $title;
                        $url = '';
                        $options['class'] = 'dropdown-item text-1';
                        $options['onclick'] = 'updateRecord('.$model->id.',\'user\',\'Update User\',event)';
                        return '<li>' . Html::a($label, $url, $options) . '</li>' . PHP_EOL;
                    },
                    'edit' => function ($url, $model) {
                        $title = Yii::t('app', 'Update User');
                        $options = []; // you forgot to initialize this
                        $icon = '<span class=""></span>';
                        $label = $icon . ' ' . $title;
                        $url = '';
                        $options['class'] = 'dropdown-item text-1';
                        $options['onclick'] = 'updateRecord('.$model->id.',\'user\',\'Update User\',event)';
                        return '<li>' . Html::a($label, $url, $options) . '</li>' . PHP_EOL;
                    },
                    'change_password' => function ($url, $model) {
                        $title = Yii::t('app', 'Change Password');
                        $options = []; // you forgot to initialize this
                        $icon = '<span class=""></span>';
                        $label = $icon . ' ' . $title;
                        $url = '';
                        $options['onclick'] = 'changePassword('.$model->id.',\'user\',\'Update Password\',event)';

                        $options['class'] = 'dropdown-item text-1';
                        return '<li>' . Html::a($label, $url, $options) . '</li>' . PHP_EOL;
                    },
                    'session_detail' => function ($url, $model) {
                        $title = Yii::t('app', 'View Session Detail');
                        $options = []; // you forgot to initialize this
                        $icon = '<span class=""></span>';
                        $label = $icon . ' ' . $title;
                        $url = Yii::$app->homeUrl.'patient/view?id='.$model->id;
                        $options['class'] = 'dropdown-item text-1';
                        return '<li>' . Html::a($label, $url, $options) . '</li>' . PHP_EOL;
                    },
                    'assign_role' => function ($url, $model) {
                        $title = Yii::t('app', 'Assign Role & Operation');
                        $options = []; // you forgot to initialize this
                        $icon = '<span class=""></span>';
                        $label = $icon . ' ' . $title;
                        $url = Yii::$app->homeUrl.'rbac/default/index?assign_user_id='.$model->id;
                        $options['class'] = 'dropdown-item text-1';
						return '<li>' . Html::a($label, $url, $options) . '</li>' . PHP_EOL;
                    },
                    'attendance' => function ($url, $model) {
                        $title = Yii::t('app', 'View Attendance');
                        $options = []; // you forgot to initialize this
                        $icon = '<span class=""></span>';
                        $label = $icon . ' ' . $title;
                        $url = Yii::$app->homeUrl.'user/attendance?id='.$model->id;
                        $options['class'] = 'dropdown-item text-1';
                        //$options['onclick'] = 'updateRecord('.$model->id.',\'user\',\'Update User\',event)';
                        return '<li>' . Html::a($label, $url, $options) . '</li>' . PHP_EOL;
                    },
                    'attendance_search' => function ($url, $model) {
                        $title = Yii::t('app', 'View Attendance Chart');
                        $options = []; // you forgot to initialize this
                        $icon = '<span class=""></span>';
                        $label = $icon . ' ' . $title;
                        $url = Yii::$app->homeUrl.'user/attendance-search?id='.$model->id;
                        $options['class'] = 'dropdown-item text-1';
                        //$options['onclick'] = 'updateRecord('.$model->id.',\'user\',\'Update User\',event)';									   
                        return '<li>' . Html::a($label, $url, $options) . '</li>' . PHP_EOL;
                    },

                ],
                'headerOptions' => ['class' => 'kartik-sheet-style'],
            ],
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