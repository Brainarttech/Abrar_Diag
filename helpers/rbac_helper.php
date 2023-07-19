<?php

namespace app\helpers;

use app\models\User;
use Yii;
use yii\base\Exception;

/**
 * Created by PhpStorm.
 * User: Waqar
 * Date: 10/28/2017
 * Time: 2:35 PM
 */


class rbac_helper
{
	public static function msg()
    {
        return 'yeah yeah';
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
}
?>