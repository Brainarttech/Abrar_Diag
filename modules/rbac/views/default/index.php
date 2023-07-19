<?php

error_reporting(0);

use yii\base\InvalidConfigException;
use yii\helpers\Json;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

use yii\widgets\ActiveForm;

use app\models\User;

use yii\helpers\ArrayHelper;
use app\helpers\Helper;
use app\helpers\rbac_helper;
use kartik\select2\Select2;
/**

 *


 */


$this->title = Yii::t ( 'app', 'System Settings' );

$this->params ['breadcrumbs'] [] = $this->title;

function getUserRoles($user_id){
    $connection = \Yii::$app->db;
    $sql="select auth_item.* from auth_item,auth_assignment where auth_item.type=1 and auth_assignment.user_id=$user_id and auth_assignment.item_name=auth_item.name";
    $command=$connection->createCommand($sql);
    $dataReader=$command->queryAll();
    $roles ='';
    if(count($dataReader) > 0){
        foreach($dataReader as $role){
            $roles.=$role['name']."</br>";
        }
    }
    return $roles;
}
function getUserOperations($user_id){
    $connection = \Yii::$app->db;
    $sql="select auth_item.* from auth_item,auth_assignment where auth_item.type=2 and auth_assignment.user_id=$user_id and auth_assignment.item_name=auth_item.name";
    $command=$connection->createCommand($sql);
    $dataReader=$command->queryAll();
    $roles ='';
    if(count($dataReader) > 0){
        foreach($dataReader as $role){
            $roles.=$role['name']."</br>";
        }
    }
    return $roles;
}
function getUserAssignments(){
    if(!empty($_GET['assign_user_id'])){
        $connection = \Yii::$app->db;
        $sql="select auth_assignment.*,auth_item.type from auth_item, auth_assignment where  auth_assignment.user_id=$_GET[assign_user_id] and auth_assignment.item_name=auth_item.name";
        $command=$connection->createCommand($sql);
        $dataReader=$command->queryAll();
        if(count($dataReader) > 0){
            return $dataReader;
        }
    }else{
        return '';
    }
}
function checkParentExists($parent,$child){
    $connection = \Yii::$app->db;
    $sql="select * from auth_item_child where  parent='$parent' and child='$child'";
    $command=$connection->createCommand($sql);
    $dataReader=$command->queryAll();
    if(count($dataReader) > 0){
        return 'yes';
    }else{
        return 'no';
    }
}
function countChild($parent){
    $connection = \Yii::$app->db;
    $sql="select * from auth_item_child where  parent='$parent'";
    $command=$connection->createCommand($sql);
    $dataReader=$command->queryAll();
    if(count($dataReader) > 0){
        return "[".count($dataReader)."]";
    }else{
        return '';
    }
}
function roleParent(){
    $connection = \Yii::$app->db;
    $sql="select auth_item_child.*,auth_item.type from auth_item, auth_item_child where auth_item_child.child=auth_item.name and auth_item_child.child='$_GET[role_id]'";
    ///$sql="select * from auth_item_child where  parent='$_GET[role_id]'";
    $command=$connection->createCommand($sql);
    $dataReader=$command->queryAll();
    return $dataReader;
}
function roleChild(){
    $connection = \Yii::$app->db;
    $sql="select auth_item_child.*,auth_item.type from auth_item, auth_item_child where auth_item_child.parent=auth_item.name and auth_item_child.parent='$_GET[role_id]'";
    //$sql="select * from auth_item_child where  child='$_GET[role_id]'";
    $command=$connection->createCommand($sql);
    $dataReader=$command->queryAll();
    return $dataReader;
}
function operationParent(){
    $connection = \Yii::$app->db;
    $sql="select auth_item_child.*,auth_item.type from auth_item, auth_item_child where auth_item_child.child=auth_item.name and auth_item_child.child='$_GET[operation_id]'";
    ///$sql="select * from auth_item_child where  parent='$_GET[role_id]'";
    $command=$connection->createCommand($sql);
    $dataReader=$command->queryAll();
    return $dataReader;
}
function operationChild(){
    $connection = \Yii::$app->db;
    $sql="select auth_item_child.*,auth_item.type from auth_item, auth_item_child where auth_item_child.parent=auth_item.name and auth_item_child.parent='$_GET[operation_id]'";
    //$sql="select * from auth_item_child where  child='$_GET[role_id]'";
    $command=$connection->createCommand($sql);
    $dataReader=$command->queryAll();
    return $dataReader;
}
function getRoleType($type){
    $connection = \Yii::$app->db;
    $sql="select auth_item.type from auth_item where  name ='$type'";
    $command=$connection->createCommand($sql);
    $dataReader=$command->queryOne();
    return $dataReader['type'];
}
function getDescription($id){
    $connection = \Yii::$app->db;
    $sql="select auth_item.description from auth_item where  name ='$id'";
    $command=$connection->createCommand($sql);
    $dataReader=$command->queryOne();
    return $dataReader['description'];
}
function getUserName($id){
    $connection = \Yii::$app->db;
    $sql="select first_name,last_name from tbl_user where  id ='$id'";
    $command=$connection->createCommand($sql);
    $dataReader=$command->queryOne();
    return $dataReader['first_name']." ".$dataReader['last_name'];
}
$active = array('0'=>Yii::t('app', 'Inactive'),'1'=>Yii::t('app', 'Active'));
?>


<style>

input[type="checkbox"]{
  width: 18px; /*Desired width*/
  height: 18px; /*Desired height*/
  cursor: pointer;
  
}
    .cke_contents{max-height:250px}
    .slider .tooltip.top {
        margin-top: -36px;
        z-index: 100;
    }
    .close {
        color: #000000;
        float: right;
        font-size: 18px;
        font-weight: bold;
        line-height: 1;
        opacity: 0.2;
        text-shadow: 0 1px 0 #ffffff;
    }

    .table thead th{
        color: #337ab7;
    }

    .nav.nav-tabs.nav-top-border .nav-item a:hover {
        color: white;
        background: #144639;
    }

    .nav.nav-tabs.nav-top-border .nav-item a.nav-link.active {

        border-top: 3px solid #37BC9B;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        color: #555;
    }


    .nav.nav-tabs.nav-top-border .nav-item a {

        color: white;
        background: #1d2b36;

    }

    .nav.nav-tabs.no-hover-bg .nav-item:active{

        background: white;

    }


</style>
<script type="text/javascript">
    function Add_Error(obj,msg){
        $(obj).parents('.form-group').addClass('has-error');
        $(obj).parents('.form-group').append('<div style="color:#D16E6C; clear:both" class="error"><i class="icon-remove-sign"></i> '+msg+'</div>');
        return true;
    }
    function Remove_Error(obj){
        $(obj).parents('.form-group').removeClass('has-error');
        $(obj).parents('.form-group').children('.error').remove();
        return false;
    }
    function Add_ErrorTag(obj,msg){
        obj.css({'border':'1px solid #D16E6C'});

        obj.after('<div style="color:#D16E6C; clear:both" class="error"><i class="icon-remove-sign"></i> '+msg+'</div>');
        return true;
    }
    function Remove_ErrorTag(obj){
        obj.removeAttr('style').next('.error').remove();
        return false;
    }
    $(document).ready(function(e) {
        $('#role_frm').submit(function(event){
            var error='';
            $('#role_frm [data-validation="required"]').each(function(index, element) {
                //alert($(this).attr('id'));
                Remove_Error($(this));
                if($(this).val() == ''){
                    error+=Add_Error($(this),'This Field is Required!');
                }else{
                    Remove_Error($(this));
                }
                if(error !=''){
                    event.preventDefault();
                }else{
                    return true;
                }
            });
        });
        $('#operation_frm').submit(function(event){
            var error='';
            $('#operation_frm [data-validation="required"]').each(function(index, element) {
                //alert($(this).attr('id'));
                Remove_Error($(this));
                if($(this).val() == ''){
                    error+=Add_Error($(this),'This Field is Required!');
                }else{
                    Remove_Error($(this));
                }
                if(error !=''){
                    event.preventDefault();
                }else{
                    return true;
                }
            });
        });
    });

    //})
</script>

<style>
    .cke_contents{max-height:250px}
    .slider .tooltip.top {
        margin-top: -36px;
        z-index: 100;
    }
    .close {
        color: #000000;
        float: right;
        font-size: 18px;
        font-weight: bold;
        line-height: 1;
        opacity: 0.2;
        text-shadow: 0 1px 0 #ffffff;
    }
</style>

<div class="logo-index">
    <!--
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    -->
    <div class="ibox float-e-margins container">
        

        <div class="ibox-content">
            <div class="tabbable">
                <ul class="nav nav-tabs  m-tabs-line m-tabs-line--2x m-tabs-line--success" role="tablist" id="myTab">
                
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link active show" id="base-tab11" data-toggle="tab" aria-controls="tab11" href="#assignments" aria-expanded="true"><?php echo Yii::t ( 'app', 'Assignments' ); ?></a>
                    </li>
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" id="base-tab12" data-toggle="tab" aria-controls="tab12" href="#role" aria-expanded="false"><?php echo Yii::t ( 'app', 'Roles' ); ?></a>
                    </li>
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" id="base-tab13" data-toggle="tab" aria-controls="tab13" href="#permission" aria-expanded="false"><?php echo Yii::t ( 'app', 'Permissions' ); ?></a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="assignments">
                        <br/>
                        <?php if(empty($_GET['assign_user_id'])){ ?>
                            <?php
                            if(count($users) > 0){?>
                    
                                <?php Pjax::begin(); ?>

                                <?php


                            

                                echo GridView::widget ( [

                                    'dataProvider' => $dataProvider,

                                    'filterModel' => $searchModel,
                                    'toolbar' =>  [
            
                                        ],
        

                                    'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<h5 class="card-title"><i class="fa fa-th-list"></i> '.Yii::t ( 'app', 'Users Login' ).' </h5>',
            

                                        'showFooter' => false,

                    ],
                        
                                    'columns' => [

                                        [

                                            'class' => 'yii\grid\SerialColumn'

                                        ],

                                    

                                        'username',

                                    

                                        // 'auth_key',

                                        // 'password_hash',

                                        // 'password_reset_token',

                                        'email:email',
                                        [

                                            'attribute' => 'id',
                                            'label'=>Yii::t('app', 'Roles'),

                                            'format' => 'raw',

                                            'value' => function ($model, $key, $index, $widget)

                                            {
                                                return getUserRoles($model->id);

                                            }

                                        ],

                                        [

                                            'attribute' => 'id',
                                            'label'=>Yii::t('app', 'Operations'),

                                            'format' => 'raw',


                                            'value' => function ($model, $key, $index, $widget)

                                            {

                                                return getUserOperations($model->id);

                                            }

                                        ],

                                        'status',
                                        [

                                             'class' => 'yii\grid\ActionColumn',



                                            'template'=>'{update} {view} {delete}',

                                            'buttons' => [


                                                'update' => function ($url, $model) {
                                                    $users=' <a href='.Yii::$app->homeUrl.'rbac/default/index'.'?assign_user_id='.$model->id.'>'.$model->username.'</a>';

                                                    return  '<a href="'.Yii::$app->homeUrl.'rbac/default/index?assign_user_id='.$model->id.'" class="btn btn-primary btn-xs">Roles & Operations</a>';},

                                                'view' => function ($url, $model) {

                                                    return "";},

                                                'delete' => function ($url, $model) {
                                                    return '';}


                                            ],
                                        ],


                                        // 'role',

                                        //'active',



                                        // 'created_at',

                                        // 'updated_at',




                                    ],


                                ] );

                               

                                ?>
                                <?php Pjax::end(); ?>
                            <?php   }
                        }else{
                            ?>
                            <div class="row">


                                <form method="post" class="form-horizontal" action="" enctype="multipart/form-data">
                                    <?php Yii::$app->request->enableCsrfValidation = true; ?>
                                    <input type="hidden" name="_csrf" value="<?php echo $this->renderDynamic('return Yii::$app->request->csrfToken;'); ?>">
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <!--<h3><?/*=Yii::t('app', 'Assignment for User')*/?> : <?/*= getUserName($_GET['assign_user_id'])*/?></h3>-->
                                            <?php
                                            if(getUserAssignments() !=''){?>

                                                <table class="table table-bordered table-striped">
                                                    <?php
                                                    foreach(getUserAssignments() as $assign){
                                                        ?>
                                                        <tr>
                                                            <td><?=$assign['item_name']?></td>
                                                            <td><?=Yii::t('app',$assign['type']=='1'?'Role':'Operation')?></td>
                                                            <?php
                                                            /* Dont let anyone remove admin role from user: admin
                                                                ALso dont let anyone remove role Customer */
                                                            if((User::findOne($_GET['assign_user_id'])->username == 'admin' && $assign['type'] == 2 && $assign['item_name'] == 'Admin')
                                                                || ($assign['type'] == 2 && $assign['item_name'] == 'Customer'))
                                                            {
                                                                ?>
                                                                <td width="100"></td>
                                                                <?php
                                                            }
                                                            else
                                                            {
                                                                ?>
                                                                <td width="100"><a href="<?php echo Yii::$app->homeUrl?>rbac/default/index?assign_user_id=<?=$_GET['assign_user_id']?>&assign_user_remove=<?= urlencode($assign['item_name'])?>" onClick="return confirm('<?=Yii::t('app','Are you Sure!')?>')" class="btn btn-danger btn-xs" ><?=Yii::t('app',"Remove")?></a></td>
                                                                <?php
                                                            }
                                                            ?>
                                                        </tr>
                                                    <?php } ?>
                                                </table>
                                            <?php } else{
                                                echo Yii::t('app',"no assignment");
                                            }
                                            ?>
                                            <a href="<?php echo Yii::$app->homeUrl?>rbac/default/index" class="btn btn-primary  btn-sm"><?=Yii::t('app',"Back")?></a>
                                        </div>

                                        <div class="col-sm-6">
                                            <h3><?=Yii::t('app', 'Assign Roles and Operations from the below drop down and click Assign')?></h3>
                                            <?php
                                            if(count($assigment_error) >0){?>
                                                <div class="alert alert-danger">
                                                    <?php
                                                    foreach($assigment_error as $errors){
                                                        foreach($errors as $error){ ?>
                                                            <li><?=$error?></li>
                                                        <?php   }
                                                    }
                                                    ?>
                                                </div>

                                            <?php }  ?>

                                            <select name="auth_item" class="form-control">
                                                <optgroup label="Roles">
                                                    <?php
                                                    if(count($roles) > 0){
                                                        foreach($roles as $role){
                                                            /* Customer role should not be allowed to be assigned to any user */
                                                            if($role['name'] == 'Customer')
                                                                continue;
                                                            ?>
                                                            <option><?=$role['name']?></option>
                                                        <?php   }
                                                    }
                                                    ?>
                                                </optgroup>
                                                <optgroup label="Operations">
                                                    <?php
                                                    if(count($operations) > 0){
                                                        foreach($operations as $operation){?>
                                                            <option><?=$operation['name']?></option>
                                                        <?php   }
                                                    }
                                                    ?>
                                                </optgroup>
                                            </select>
                                            <br>
                                            <?= Html::submitButton(Yii::t ( 'app', 'Assign' ), ['class' => 'btn btn-primary pull-right']) ?>
                                        </div>


                                    </div>

                                </form>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="tab-pane" id="permission">

                      

                        
                        <table class="table m-table m-table--head-bg-brand table-bordered" id="myTable" style="width: 100% !important">
                            <thead>
                            <tr>
                                <th align="center"> <?=Yii::t('app',"Permission")?></th>
                                <th align="center"> <?=Yii::t('app',"Description")?></th>
                                 <?php
                                foreach($roles as $roleCol){
                                    ?>
                                    <th align="center"><?=Yii::t('app',$roleCol['name'])?></th>

                                <?php } ?>
                            </tr>
                            
                            </thead>
                            <tbody>
                            <?php foreach($operations as $opRow){ ?>


                                <tr>
                                    <td align="center"><?=$opRow['name']?></td>
                                     <td align="center"><?=$opRow['description']?></td>

                                    <?php
                                    foreach($roles as $roleCol){
                                        ?>
                                        <td align="center">
                                            <?php
                                            if(checkParentExists($roleCol['name'],$opRow['name']) =='yes'){
                                               /* if($roleCol['name'] == 'Adminn' || $roleCol['name'] == 'Customer')
                                                {
                                                    */?><!--
                                                    <a href="#" class="btn btn-danger btn-xs"  onClick="return alert('<?/*=Yii::t('app','Can not revoke permissons from system role!')*/?>')"><?/*=Yii::t('app',"Revoke")*/?></a>
                                                    --><?php
/*                                                    continue;
                                                }*/
                                                ?>
                                                <label class="m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand ">
                            <input type="checkbox" checked="checked" value="<?=$roleCol['name']?>" class="m-checkable checkbox-click">
                            <span></span>
                        </label>
                                                
                                                                
                                                
                                                
                                               <!--  <a id="revoke" href="?child=<?=urlencode($opRow['name'])?>&parent=<?=urlencode($roleCol['name'])?>&remove_child=true" class="btn btn-danger btn-xs"  onClick="return confirm('<?=Yii::t('app','Are you Sure!')?>')"><?=Yii::t('app',"Revoke")?></a> -->

                                            <?php }else{
                                                /*if($roleCol['name'] == 'Adminn' || $roleCol['name'] == 'Customer')
                                                {
                                                    */?><!--
                                                    <a href="#" class="btn btn-primary btn-xs"  onClick="return alert('<?/*=Yii::t('app','Can not assign permissions to system role!')*/?>')"><?/*=Yii::t('app',"Assign")*/?></a>
                                                    --><?php
/*                                                    continue;
                                                }*/
                                                ?>
                                               <!--  <a id="assign" href="?child=<?=urlencode($opRow['name'])?>&parent=<?=urlencode($roleCol['name'])?>" class="btn btn-primary btn-xs" onClick="return confirm('<?=Yii::t('app','Are you Sure!')?>')"><?=Yii::t('app','Assign')?></a> -->

                                                    <label class="m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand ">
                            <input type="checkbox"  value="<?=$roleCol['name']?>" class="m-checkable checkbox-click">
                            <span></span>
                        </label>
                                    

                                            <?php   } ?>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                  
                    </div>
                    <div class="tab-pane" id="role">
                        <br/>

                        <?php
                        if(empty($_GET['add_role']) && empty($_GET['role_id'])){?>
                            <a href="<?php echo Yii::$app->homeUrl?>rbac/default/index?add_role=true" class="btn btn-primary btn-sm"><?=Yii::t('app',"Add New Role")?></a
                            ><?php if(count($roles) > 0){?>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th><?=Yii::t('app',"Role")?></th>
                                        <th><?=Yii::t('app',"Role Description")?></th>
                                        <!--<th><?=Yii::t('app',"Data")?></th>-->
                                        <th><?=Yii::t('app',"Action")?></th>

                                    </tr>
                                    </thead>
                                    <?php   foreach($roles as $role){?>
                                        <tr>
                                            <?php
                                            if($role['name'] == 'Admin')
                                            {
                                                ?>
                                                <td><?=$role['name']." ".countChild($role['name'])?></td>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <td><a href="<?php echo Yii::$app->homeUrl?>rbac/default/index?role_id=<?=$role['name']?>"><?=$role['name']." ".countChild($role['name'])?></a></td>
                                                <?php
                                            }
                                            ?>
                                            <td><?=$role['description']?></td>
                                            <!--<td><?=$role['data']?></td>-->
                                            <td>
                                                <?php
                                                if(!in_array($role['name'],array('Admin'))){
                                                    ?>
                                                    <a href="<?php echo Yii::$app->homeUrl?>rbac/default/index?role_del=<?=$role['name']?>" onClick="return confirm('<?=Yii::t('app','Are you Sure!')?>')" class="btn btn-danger btn-xs"><?=Yii::t('app',"Remove")?></a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php   }?>
                                </table>
                            <?php   }else echo Yii::t('app',"No Data");
                        }
                        if(!empty($_GET['add_role']) && empty($_GET['role_id'])){
                            ?>
                            <h3><?=Yii::t('app',"Add Role")?></h3>
                            <form method="post" class="form-horizontal" action="" enctype="multipart/form-data" id="role_frm">
                                <?php Yii::$app->request->enableCsrfValidation = true; ?>
                                <input type="hidden" name="_csrf" value="<?php echo $this->renderDynamic('return Yii::$app->request->csrfToken;'); ?>">
                                <?php
                                if(count($role_add_error) >0){?>
                                    <div class="alert alert-danger">
                                        <?php
                                        foreach($role_add_error as $errors){
                                            foreach($errors as $error){ ?>
                                                <li><?=$error?></li>
                                            <?php   }
                                        }
                                        ?>
                                    </div>
                                <?php }  ?>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label><?=Yii::t('app',"Name")?> <font color="#FF0000">*</font></label>
                                        <input type="text" class="form-control" name="role_name" id="role_name" data-validation="required" value="<?= isset($_POST['role_name'])?$_POST['role_name']:''?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label><?=Yii::t('app',"Description")?> <font color="#FF0000">*</font></label>
                                        <input type="text" class="form-control" name="role_description" id="role_description" value="<?= isset($_POST['role_description'])?$_POST['role_description']:''?>" data-validation="required">
                                    </div>
                                </div>
                                <!--<div class="form-group">
                                        <div class="col-sm-4">
                                            <label><?=Yii::t('app',"Data")?></label>
                                            <input type="text" class="form-control" name="role_data" value="<?= isset($_POST['role_data'])?$_POST['role_data']:''?>">
                                        </div>
                                    </div>-->
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <a href="<?php echo Yii::$app->homeUrl?>rbac" class="btn btn-default  btn-sm"><?=Yii::t('app',"Back")?></a>
                                    </div>
                                    <div class="col-sm-2"  align="right">
                                        <?= Html::submitButton(Yii::t ( 'app', 'Save' ), ['class' => 'btn btn-primary  btn-sm role_add']) ?>
                                    </div>
                                </div>
                            </form>
                        <?php }
                        if(!empty($_GET['role_id']) && $_GET['role_id'] != 'Admin' && $_GET['role_id'] != 'Customer') {?>
                            <h3><?=Yii::t('app',"Role")?> : <?=$_GET['role_id']?></h3>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h3><?=Yii::t('app',"Relations")?></h3>
                                        <h4><?=Yii::t('app',"Parent")?></h4>
                                        <?php
                                        if(count(roleParent()) > 0){?>

                                            <table class="table table-bordered table-striped">
                                                <?php
                                                foreach(roleParent() as $roleParent){
                                                    ?>
                                                    <tr>
                                                        <td><?=$roleParent['parent']?></td>
                                                        <td><?=Yii::t('app',getRoleType($roleParent['parent'])=='1'?'Role':'Operation')?></td>
                                                        <!--<td>
                                                    <a href="index.php?r=liveobjects/setting/rights&child=<?=urlencode($_GET['role_id'])?>&parent=<?=urlencode($roleParent['name'])?>&role_child_del=true&role_id=<?=urlencode($_GET['role_id'])?>" class="btn btn-danger btn-xs"  onClick="return confirm('<?=Yii::t('app','Are you Sure!')?>')">Remove</a>
                                                </td>-->
                                                    </tr>
                                                <?php } ?>
                                            </table>
                                        <?php } else{
                                            echo Yii::t('app',"This item has no parents.");
                                        }
                                        ?>
                                        <h4><?=Yii::t('app',"Children")?></h4>
                                        <?php
                                        if(count(roleChild()) > 0){?>

                                            <table class="table table-bordered table-striped">
                                                <?php
                                                foreach(roleChild() as $roleChild){
                                                    ?>
                                                    <tr>
                                                        <td><?=$roleChild['child']?></td>
                                                        <td><?=Yii::t('app',getRoleType($roleChild['child'])=='1'?'Role':'Operation')?></td>
                                                        <td>
                                                            <a href="<?php echo Yii::$app->homeUrl?>rbac/default/index?child=<?=urlencode($roleChild['child'])?>&parent=<?=urlencode($_GET['role_id'])?>&role_child_del=true&role_id=<?=urlencode($_GET['role_id'])?>" class="btn btn-danger btn-xs"  onClick="return confirm('<?=Yii::t('app','Are you Sure!')?>')"><?=Yii::t('app','Remove')?></a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </table>
                                        <?php } else{
                                            echo Yii::t('app',"This item has no children.");
                                        }
                                        ?>
                                        <br/><a href="<?php echo Yii::$app->homeUrl?>rbac" class="btn btn-primary btn-sm"><?=Yii::t('app',"Back")?></a>
                                    </div>
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <div class="ibox-content">
                                            <h3><?=Yii::t('app',"Update Role")?></h3>
                                            <form method="post" action="" enctype="multipart/form-data">
                                                <?php Yii::$app->request->enableCsrfValidation = true; ?>
                                                <input type="hidden" name="_csrf" value="<?php echo $this->renderDynamic('return Yii::$app->request->csrfToken;'); ?>">
                                                <label><?=Yii::t('app',"Role")?></label>
                                                <input type="text" readonly class="form-control" value="<?=$_GET['role_id']?>">
                                                <label><?=Yii::t('app',"Description")?></label>
                                                <input type="text" name="edit_role_description" value="<?=getDescription($_GET['role_id'])?>" class="form-control"><br/>
                                                <?= Html::submitButton(Yii::t ( 'app', 'Update' ), ['class' => 'btn btn-primary  btn-sm']) ?>
                                            </form>
                                        </div>
                                        <div class="ibox-content">
                                            <h3><?=Yii::t('app',"Add Child")?></h3>
                                            <?php
                                            if(count($roleChild_assigment_error) >0){?>
                                                <div class="alert alert-danger">
                                                    <?php
                                                    foreach($roleChild_assigment_error as $errors){
                                                        foreach($errors as $error){ ?>
                                                            <li><?=$error?></li>
                                                        <?php   }
                                                    }
                                                    ?>
                                                </div>
                                            <?php }  ?>

                                            <form method="post"  action="" enctype="multipart/form-data">
                                                <?php Yii::$app->request->enableCsrfValidation = true; ?>
                                                <input type="hidden" name="_csrf" value="<?php echo $this->renderDynamic('return Yii::$app->request->csrfToken;'); ?>">
                                                <select name="role_child_auth_item" class="form-control">
                                                    <optgroup label="Roles">
                                                        <?php
                                                        if(count($roles) > 0){
                                                            foreach($roles as $role){?>
                                                                <option><?=$role['name']?></option>
                                                            <?php   }
                                                        }
                                                        ?>
                                                    </optgroup>
                                                    <optgroup label="Operations">
                                                        <?php
                                                        if(count($operations) > 0){
                                                            foreach($operations as $operation){?>
                                                                <option><?=$operation['name']?></option>
                                                            <?php   }
                                                        }
                                                        ?>
                                                    </optgroup>
                                                </select>
                                                <br/>
                                                <?= Html::submitButton(Yii::t ( 'app', 'Save' ), ['class' => 'btn btn-primary  btn-sm']) ?>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        else
                        {
                            ?>
                            <!-- this button was showing twice <a href="index.php?r=liveobjects/setting/rights" class="btn btn-primary btn-sm"><?=Yii::t('app',"Back")?></a>-->
                            <?php
                        }?>
                    </div>
                    <div class="tab-pane fade" id="operations">
                        <br/>
                        <?php
                        if(empty($_GET['add_operation']) && empty($_GET['operation_id'])){?>
                            <h3><?=Yii::t('app',"Operations")?></h3>
                            <a href="<?php echo Yii::$app->homeUrl?>rbac/default/index?add_operation=true" class="btn btn-primary btn-sm"><?=Yii::t('app',"Add New")?></a>
                            <?php   if(count($operations) > 0){?>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th><?=Yii::t('app',"Name")?></th>
                                        <th><?=Yii::t('app',"Description")?></th>
                                        <th><?=Yii::t('app',"Data")?></th>
                                        <!--<th><?=Yii::t('app',"Action")?></th>-->
                                    </tr>
                                    </thead>
                                    <?php   foreach($operations as $operation){?>
                                        <tr>
                                            <td><a href="<?php echo Yii::$app->homeUrl?>rbac/default/index?operation_id=<?=$operation['name']?>"><?=$operation['name']." ".countChild($operation['name'])?></a></td>
                                            <td><?=$operation['description']?></td>
                                            <td><?=$operation['data']?></td>
                                            <!--<td><a href="index.php?r=liveobjects/setting/rights&operation_del=<?=$operation['name']?>" onClick="return confirm('<?=Yii::t('app','Are you Sure!')?>')" class="btn btn-danger btn-xs"><?=Yii::t('app',"Remove")?></a></td>-->
                                        </tr>
                                    <?php   }?>
                                </table>
                            <?php   }else echo Yii::t('app',"No Data");

                        }
                        if(!empty($_GET['add_operation']) && empty($_GET['operation_id'])){
                            ?>
                            <h3><?=Yii::t('app',"Add Operation")?></h3>
                            <form method="post" class="form-horizontal" action="" enctype="multipart/form-data" id="operation_frm">
                                <?php Yii::$app->request->enableCsrfValidation = true; ?>
                                <input type="hidden" name="_csrf" value="<?php echo $this->renderDynamic('return Yii::$app->request->csrfToken;'); ?>">
                                <?php
                                if(count($operation_add_error) >0){?>
                                    <div class="alert alert-danger">
                                        <?php
                                        foreach($operation_add_error as $errors){
                                            foreach($errors as $error){ ?>
                                                <li><?=$error?></li>
                                            <?php   }
                                        }
                                        ?>
                                    </div>
                                <?php }  ?>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label><?=Yii::t('app',"Name")?> <font color="#FF0000">*</font></label>
                                        <input type="text" class="form-control" name="operation_name" id="operation_name" data-validation="required" value="<?= isset($_POST['operation_name'])?$_POST['operation_name']:''?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label><?=Yii::t('app',"Description")?> <font color="#FF0000">*</font></label>
                                        <input type="text" class="form-control" name="operation_description" id="operation_description" value="<?= isset($_POST['operation_description'])?$_POST['operation_description']:''?>" data-validation="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label><?=Yii::t('app',"Data")?></label>
                                        <input type="text" class="form-control" name="operation_data" value="<?= isset($_POST['operation_data'])?$_POST['operation_data']:''?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <?= Html::submitButton(Yii::t ( 'app', 'Save' ), ['class' => 'btn btn-primary  btn-sm operation_add']) ?>
                                    </div>
                                    <div class="col-sm-2" align="right">
                                        <a href="<?php echo Yii::$app->homeUrl?>rbac" class="btn btn-primary  btn-sm"><?=Yii::t('app',"Back")?></a>
                                    </div>
                                </div>
                            </form>

                        <?php }
                        if(!empty($_GET['operation_id'])){?>
                            <h3><?=Yii::t('app',"Operation")?> : <?=$_GET['operation_id']?></h3>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h3><?=Yii::t('app',"Relations")?></h3>
                                        <h4><?=Yii::t('app',"Parent")?></h4>
                                        <?php
                                        if(count(operationParent()) > 0){?>

                                            <table class="table table-bordered table-striped">
                                                <?php
                                                foreach(operationParent() as $operationParent){
                                                    ?>
                                                    <tr>
                                                        <td><?=$operationParent['parent']?></td>
                                                        <td><?=Yii::t('app',getRoleType($operationParent['parent'])=='1'?'Role':'Operation')?></td>
                                                        <!--<td>
                                                        <a href="index.php?r=liveobjects/setting/rights&child=<?=urlencode($_GET['operation_id'])?>&parent=<?=urlencode($operationParent['parent'])?>&operation_child_del=true&operation_id=<?=urlencode($_GET['operation_id'])?>" class="btn btn-danger btn-xs"  onClick="return confirm('<?=Yii::t('app','Are you Sure!')?>')">Remove</a>
                                                    </td>-->
                                                    </tr>
                                                <?php } ?>
                                            </table>
                                        <?php } else{
                                            echo Yii::t('app',"This item has no parents.");
                                        }
                                        ?>
                                        <h4><?=Yii::t('app',"Children")?></h4>
                                        <?php
                                        if(count(operationChild()) > 0){?>

                                            <table class="table table-bordered table-striped">
                                                <?php
                                                foreach(operationChild() as $operationChild){
                                                    ?>
                                                    <tr>
                                                        <td><?=$operationChild['child']?></td>
                                                        <td><?=Yii::t('app',getRoleType($operationChild['child'])=='2'?'Role':'Operation')?></td>
                                                        <td>
                                                            <a href="<?php echo Yii::$app->homeUrl?>rbac/default/index?child=<?=urlencode($operationChild['child'])?>&parent=<?=urlencode($_GET['operation_id'])?>&operation_child_del=true&operation_id=<?=urlencode($_GET['operation_id'])?>" class="btn btn-danger btn-xs"  onClick="return confirm('<?=Yii::t('app','Are you Sure!')?>')"><?=Yii::t('app',"Remove")?></a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </table>
                                        <?php } else{
                                            echo Yii::t('app',"This item has no children.");
                                        }
                                        ?><br/>
                                        <a href="<?php echo Yii::$app->homeUrl?>rbac" class="btn btn-primary  btn-sm"><?=Yii::t('app',"Back")?></a>
                                    </div>
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <h3><?=Yii::t('app',"Update Operation")?></h3>
                                        <form method="post" action="" enctype="multipart/form-data">
                                            <?php Yii::$app->request->enableCsrfValidation = true; ?>
                                            <input type="hidden" name="_csrf" value="<?php echo $this->renderDynamic('return Yii::$app->request->csrfToken;'); ?>">
                                            <label><?=Yii::t('app',"Operation")?></label>
                                            <input type="text" readonly class="form-control" value="<?=$_GET['operation_id']?>">
                                            <label><?=Yii::t('app',"Description")?></label>
                                            <input type="text" name="edit_operation_description" value="<?=getDescription($_GET['operation_id'])?>" class="form-control"><br/>
                                            <?= Html::submitButton(Yii::t ( 'app', 'Update' ), ['class' => 'btn btn-primary  btn-sm']) ?>
                                        </form>
                                        <h3><?=Yii::t('app',"Add Child")?></h3>
                                        <?php
                                        if(count($operationChild_assigment_error) >0){?>
                                            <div class="alert alert-danger">
                                                <?php
                                                foreach($operationChild_assigment_error as $errors){
                                                    foreach($errors as $error){ ?>
                                                        <li><?=$error?></li>
                                                    <?php   }
                                                }
                                                ?>
                                            </div>
                                        <?php }  ?>
                                        <form method="post" class="form-horizontal" action="" enctype="multipart/form-data">
                                            <?php Yii::$app->request->enableCsrfValidation = true; ?>
                                            <input type="hidden" name="_csrf" value="<?php echo $this->renderDynamic('return Yii::$app->request->csrfToken;'); ?>">
                                            <select name="operation_child_auth_item" class="form-control">
                                                <optgroup label="Operations">
                                                    <?php
                                                    if(count($operations) > 0){
                                                        foreach($operations as $operation){?>
                                                            <option><?=$operation['name']?></option>
                                                        <?php   }
                                                    }
                                                    ?>
                                                </optgroup>
                                            </select>
                                            <br/>
                                            <?= Html::submitButton(Yii::t ( 'app', 'Save' ), ['class' => 'btn btn-primary  btn-sm']) ?>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>




<script>


         $(document).ready( function () {
    $('#myTable').DataTable();
} );

        



    $(document).ready(function(e) {


        $('#myTable').on('click', '.checkbox-click', function(){

      

             var $this = $(this);

              var child = $(this).parent().parent().siblings(":first").text();
    var parent = $(this).val();
  if ($(this).is(':checked')) {
   


   // alert("checked");


    var url = '?child='+child+'&parent='+parent+'';
        $.ajax({
            url: url,
            type: "GET",
            success: function (data) {
                //alert(data);
                if(!data=="Revoke")
                {
                    $this.removeAttr("checked");
                }
                

            },
            error: function(xhr, ajaxOptions, thrownError){

            },
            //timeout : 15000//timeout of the ajax call
        });




  }
  else
  {
     var url = '?child='+child+'&parent='+parent+'&remove_child=true';
    
        $.ajax({
            url: url,
            type: "GET",
            success: function (data) {

                //alert(data);

                if(!data=="ASSIGN")
                {
                    $this.prop('checked');
                }
            

        

            },
            error: function(xhr, ajaxOptions, thrownError){

            },
           // timeout : 15000//timeout of the ajax call
        });
    
  }
});



        $('a[data-toggle="tab"]').on('shown.bs.tab', function () {

            //save the latest tab; use cookies if you like 'em better:

            localStorage.setItem('lastTab_leadview', $(this).attr('href'));

        });
        $('[data-toggle="hover"]').popover({ trigger: "hover" });


        //go to the latest tab, if it exists:

        var lastTab_leadview = localStorage.getItem('lastTab_leadview');

        if ($('a[href="' + lastTab_leadview + '"]').length > 0) {

            $('a[href="' + lastTab_leadview + '"]').tab('show');
        }
        else
        {
            // Set the first tab if cookie do not exist

            $('a[data-toggle="tab"]:first').tab('show');
        }

    });





    /*$('#assign').click(function(e){
        e.preventDefault();
        var url = $(this).attr("href");


        $.ajax({
                url: url,
                type: "GET",
            success: function (data) {



                alert(data);

        },
        error: function(xhr, ajaxOptions, thrownError){

        },
        timeout : 15000//timeout of the ajax call
    });

    });


    $('#revoke').click(function(e){
        e.preventDefault();
        var url = $(this).attr("href");
        $.ajax({
            url: url,
            type: "GET",
            success: function (data) {


                $(this).attr("id","assign");

                alert(data);

            },
            error: function(xhr, ajaxOptions, thrownError){

            },
            timeout : 15000//timeout of the ajax call
        });

    });*/

    


</script>