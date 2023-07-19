<?php

namespace app\helpers;

use yii\db\ActiveQuery;

use app\models\User;
use app\models\LeaveType;
use app\models\Attendance;
use app\models\LabForm;
use app\models\LabFormField;
use app\models\Department;
use app\models\SalesItem;
use Yii;
use yii\base\Exception;

/**
 * Created by PhpStorm.
 * User: Waqar
 * Date: 10/28/2017
 * Time: 2:35 PM
 */


class Helper
{
    public  static function getSize($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }
        return $bytes;
    }

    public static function DateTime($dateTime)
    {
        $phpdate = strtotime( $dateTime );
        $date = date( 'd/m/Y', $phpdate );
        $time = date('h:i A',$phpdate);
        return $date.'<br>'.$time;
    }

    public static function getCreated($id)
    {
        $user = User::findOne($id);
        return  $user->username;
    }

    public static function getBaseUrl()
    {
        $url = Yii::$app->homeUrl;
        $str  = str_replace("/web","",$url);
        return $str;
    }

    public static function DatTim($dateTime)
    {
        $phpdate = strtotime($dateTime);
        $date = date('d/m/Y h:i A', $phpdate);
        return $date;
    }

    public static function getUser($id)
    {
        $user = User::findOne($id);
        return $user->username;
    }
	
	public static function getUserDepartment($departmentid)
    {
        $department = Department::findOne($departmentid);
        return $department->name;
    }
	
	public static function getDepartmentByItemID($saleID, $ItemID)
    {
		//return $ItemID;
		$arr = SalesItem::find()
        ->select(['sale_item.item_id', 'sale_item.item_name'])->where(['sale_id' => $saleID, 'item_id'=>$ItemID])
        ->joinWith(['item' => function(ActiveQuery $query)use ($level){
            return $query->select(['item_name.cat_id']);
            //return $query->andWhere(['=', 'sketch_category_item.type', $level]);
        }])
        ->joinWith(['item.category'])
        //->joinWith(['sketchCategoryItems.sketchCategoryItemImages'])
        ->asArray()
        ->all();
        return $arr[0]['item']['category']['name'];
    }

    public static function getUserRole($id)
    {
        $user = User::findOne($id);
        return $user->role;
    }

    public static function statusLabel($status)
    {
        if ($status !='1')
        {
            return '<span class="m-badge m-badge--danger m-badge--wide">In Active</span>';
        }
        else
        {
            return '<span class="m-badge m-badge--success m-badge--wide">Active</span>';
        }
    }

    public static function leavestatusLabel($status)
    { 
        if($status == '1')
        {
            return '<span class="m-badge m-badge--success m-badge--wide">approved</span>';
        }
        else if ($status == '2')
        {
            return '<span class="m-badge m-badge--info m-badge--wide">pending</span>';
        }
        else
        {
            return '<span class="m-badge m-badge--danger m-badge--wide">rejected</span>';   
        }
        
    }

    public static function getUserRoles($user_id){
        $connection = \Yii::$app->db;
        $sql="select auth_item.* from auth_item,auth_assignment where auth_item.type=1 and auth_assignment.user_id=$user_id and auth_assignment.item_name=auth_item.name";
        $command=$connection->createCommand($sql);
        $dataReader=$command->queryAll();
        $roles ='';
        if(count($dataReader) > 0){
            foreach($dataReader as $role){
                $roles .= '<span class="m-badge m-badge--success m-badge--wide mb-1">'.$role['name'].'</span>';
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

    public static function getLeaveType($id)
    {
        $LeaveType = LeaveType::findOne($id);
        return $LeaveType->leave_name;
    }
	
    public static function getLabFormName($id) {
        $form = LabForm::findOne($id);
        return $form->form_name;
    }
    
    public static function getLabFormTitle($id) {
        $form = LabForm::findOne($id);
        return $form->title;
    }

    public static function getLabFormField($id)
    {
        $form = LabFormField::findOne($id);
        return $form;
    }
	
	public function AttendanceApi($start_date, $end_date)
    {
		$already_exist = 0;
		$new_entries = 0;
        $xmlstring = file_get_contents("http://app.i-mployee.com/v2/index.php?r=employeeP/getapiXML&api_key=tr75sx575ip3b9td1e7e2540fsur9abd&fromdate=".$start_date."&todate=".$end_date); //Abrar Surgery
        //$xmlstring = file_get_contents("http://app.i-mployee.com/v2/index.php?r=employeeP/getapiXML&api_key=tr75sx575ip3b9td1e7e2540fsur9abd&fromdate=2018-12-01&todate=2018-12-19"); //Abrar Surgery
        //$xmlstring = file_get_contents("http://app.i-mployee.com/v2/index.php?r=employeeP/getapiXML&api_key=tr75sx575ip3b9td1e7e2540fsur9abd&fromdate=".date("Y-m-d")."&todate=".date("Y-m-d")); //Abrar Diagnostic
        $xml = simplexml_load_string($xmlstring, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);
        $array = $array['Employee'];
        foreach ($array as $key => $value) {
            if(Attendance::find()->where([
                'user_id'=>(int)$value['EmployeeCode'],
                'attendance_date'=>$value['AttendanceDate']
                //'check_in_date'=>$value['CheckInDate'],
                //'check_in_time'=>$value['CheckIntime'],
                //'check_out_date'=>$value['CheckOutDate'],
                //'check_out_time'=>$value['CheckOuttime']
            ])->exists()){
                $model = Helper::findModelAttendance((int)$value['EmployeeCode'], $value['AttendanceDate']);
                //echo $model;
                //echo "<pre>";
                //echo print_r($model);
                //echo "</pre>";
                $model->check_in_date = $value['CheckInDate'];
                $model->check_in_time = $value['CheckIntime'];
                $model->check_out_date = $value['CheckOutDate'];
                $model->check_out_time = $value['CheckOuttime'];
                $model->stay_time = datetime::HourMinuteSeconds($model->check_in_time, $model->check_out_time);
                //echo "<pre>";
                //echo print_r($model);
                //echo "</pre>";
                $model->save();
				$already_exist++;
                //echo "{$key}-Exist<br>";
            }
            else{
                if((int)$value['EmployeeCode']){
                    $model = new Attendance();
                    $model->user_id = (int)$value['EmployeeCode'];
                    $model->attendance_date = $value['AttendanceDate'];
                    $model->check_in_date = $value['CheckInDate'];
                    $model->check_in_time = $value['CheckIntime'];
                    $model->check_out_date = $value['CheckOutDate'];
                    $model->check_out_time = $value['CheckOuttime'];
                    $model->stay_time = datetime::HourMinuteSeconds($model->check_in_time, $model->check_out_time);
                    $model->save();
					$new_entries++;
                    //echo "{$key}<br>";
                }
            }
            //echo "<pre>";
            //echo print_r($model->errors);
            //echo "</pre>";
            
            //echo "{$key} => {$value['EmployeeName']} ";
            //echo "{$key} => {$value} ";
        }
		return $already_exist."-".$new_entries;
        // return;
        // echo "<pre>";
        // echo print_r($array);
        // echo "</pre>";
    }
	
	protected function findModelAttendance($EmployeeCode ,$attendance_date)
    {
        //return ($model = Attendance::find()->where(['attendance_date' => $attendance_date])->One());
        if (($model = Attendance::find()->where(['user_id' => $EmployeeCode, 'attendance_date' => $attendance_date])->One()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
?>