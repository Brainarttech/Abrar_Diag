<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\helpers\datetime;
use app\helpers\MorrisBarChart;

use app\models\Department;
use app\models\DepartmentSearch;
use app\models\Designation;
use app\models\DesignationSearch;
use app\models\Attendance;
use app\models\Leave;
use app\models\LeaveSearch;
use app\models\LeaveType;
use app\models\LeaveTypeSearch;
use app\models\User;
use app\models\UserSearch;
use app\models\Payroll;
use app\models\PayrollSearch;

use app\helpers\Helper;

class HrmController extends \yii\web\Controller
{
    public function beforeAction($action) {
        if (parent::beforeAction($action)) {
            // change layout for error action
            if(Yii::$app->user->identity->role=="Manager"){
                $this->layout = 'manager';
            }
            else if(Yii::$app->user->identity->role=="reception"){
                $this->layout = 'reception';
            }
			else if(Yii::$app->user->identity->role=="accountant"){
                $this->layout = 'accounts';
            }
            else if(Yii::$app->user->identity->role=="CT Scan" || Yii::$app->user->identity->role=="Laboratory" || Yii::$app->user->identity->role=="ultrasound" || Yii::$app->user->identity->role=="xray" || Yii::$app->user->identity->role=="department"){
                $this->layout = 'department';
            }
            else{
                $this->layout = 'admin';
            }
            return true;
        }
        else {
            return false;
        }
    }

    public function actionIndex()
    {
    	//$this->layout = 'main-hrm';
        return $this->render('index');
    }

   /* public function actionDepartment()
    {
    	$this->layout = 'main-hrm';
        //return $this->render('department');
        $searchModel = new DepartmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('department', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Department();
        $model->created_by = Yii::$app->user->id;
        $model->created_on = date("Y-m-d H:i:s");
        $model->hospital_id = 1;

        if ($model->load(Yii::$app->request->post())) {
            if($model->save())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->updated_by = Yii::$app->user->id;
        $model->updated_on = date("Y-m-d H:i:s");

        if ($model->load(Yii::$app->request->post())) {
            if($model->save())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    public function actionValidate()
    {

        if($_GET['id'])
        {
            $model = $this->findModel($_GET['id']);
            //$model->scenario = 'update';
        }
        else
        {
            $model = new Department();
            //$model->scenario = 'create';
        }

        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    protected function findModel($id)
    {
        if (($model = Department::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }*/

    public function actionDesignation()
    {
    	$this->layout = 'manager';
        //return $this->render('department');
        $searchModel = new DesignationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('designation', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreateDesignation()
    {
    	//$departmentdropdown = ArrayHelper::map(\app\models\Department::find()->asArray()->all(), 'id', 'name');

    	//echo "<pre>";
	    //echo print_r($departmentdropdown);
	    //echo "</pre>";

    	//return;
        $model = new Designation();
        $model->created_by = Yii::$app->user->id;
        $model->created_on = date("Y-m-d H:i:s");

        if ($model->load(Yii::$app->request->post())) {
            if($model->save())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        return $this->renderAjax('create_designation', [
            'model' => $model,
            //'departmentdropdown' => $departmentdropdown,
        ]);
    }

    public function actionUpdateDesignation($id)
    {
        //$departmentdropdown = ArrayHelper::map(\app\models\Department::find()->asArray()->all(), 'id', 'name');
        $model = $this->findModelDesignation($id);
        $model->updated_by = Yii::$app->user->id;
        $model->updated_on = date("Y-m-d H:i:s");

        if ($model->load(Yii::$app->request->post())) {
            if($model->save())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        return $this->renderAjax('update_designation', [
            'model' => $model,
            //'departmentdropdown' => $departmentdropdown,
        ]);
    }

    public function actionValidateDesignation()
    {

        if($_GET['id'])
        {
            $model = $this->findModelDesignation($_GET['id']);
            //$model->scenario = 'update';
        }
        else
        {
            $model = new Designation();
            //$model->scenario = 'create';
        }

        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    public function actionLeave()
    {
        //return 'LeaveType';
        $searchModel = new LeaveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('leave/leave', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionLeaveType()
    {
        //return 'LeaveType';
        $searchModel = new LeaveTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('leave_type', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreateLeave()
    {
        //$departmentdropdown = ArrayHelper::map(\app\models\Department::find()->asArray()->all(), 'id', 'name');

        //echo "<pre>";
        //echo print_r($departmentdropdown);
        //echo "</pre>";

        //return;
        $model = new Leave();
        $model->created_by = Yii::$app->user->id;
        $model->created_on = date("Y-m-d H:i:s");

        if ($model->load(Yii::$app->request->post())) {
            if($model->save())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        return $this->renderAjax('leave/create_leave', [
            'model' => $model,
        ]);
    }

    public function actionCreateLeaveType()
    {
        //$departmentdropdown = ArrayHelper::map(\app\models\Department::find()->asArray()->all(), 'id', 'name');

        //echo "<pre>";
        //echo print_r($departmentdropdown);
        //echo "</pre>";

        //return;
        $model = new LeaveType();
        $model->created_by = Yii::$app->user->id;
        $model->created_on = date("Y-m-d H:i:s");

        if ($model->load(Yii::$app->request->post())) {
            if($model->save())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        return $this->renderAjax('create_leave_type', [
            'model' => $model,
            //'departmentdropdown' => $departmentdropdown,
        ]);
    }

    public function actionUpdateLeave($id)
    {
        $model = $this->findModelLeave($id);
        $model->updated_by = Yii::$app->user->id;
        $model->updated_on = date("Y-m-d H:i:s");

        if ($model->load(Yii::$app->request->post())) {
            if($model->save())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        return $this->renderAjax('leave/update_leave', [
            'model' => $model,
        ]);
    }

    public function actionUpdateLeaveType($id)
    {
        $model = $this->findModelLeaveType($id);
        $model->updated_by = Yii::$app->user->id;
        $model->updated_on = date("Y-m-d H:i:s");

        if ($model->load(Yii::$app->request->post())) {
            if($model->save())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        return $this->renderAjax('update_leave_type', [
            'model' => $model,
        ]);
    }

    public function actionValidateLeave()
    {
        if($_GET['id'])
        {
            $model = $this->findModelLeave($_GET['id']);
            //$model->scenario = 'update';
        }
        else
        {
            $model = new Leave();
            //$model->scenario = 'create';
        }

        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    public function actionValidateLeaveType()
    {
        if($_GET['id'])
        {
            $model = $this->findModelLeaveType($_GET['id']);
            //$model->scenario = 'update';
        }
        else
        {
            $model = new LeaveType();
            //$model->scenario = 'create';
        }

        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }
	
	public function actionFetchAttendance()
    {
		if(isset($_GET['attendance_start_date']) && isset($_GET['attendance_end_date']))
		{
			return $this->render('fetch_attendance',
				['attendance_date' => Helper::AttendanceApi($_GET['attendance_start_date'], $_GET['attendance_end_date'])]
			);
		}
		return $this->render('fetch_attendance');
	}
	
	public function actionEmployeeSalaryList()
    {
    	//$this->layout = 'main-hrm';
        //return $this->render('department');
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('employee_salary_list/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionUpdateEmployeeSalaryList($id)
    {
    	$model = $this->findModelUser($id);
        $model->updated_by = Yii::$app->user->id;
        $model->updated_on = date("Y-m-d H:i:s");

        if ($model->load(Yii::$app->request->post())) {
            if($model->save())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        return $this->renderAjax('employee_salary_list/update', [
            'model' => $model,
        ]);
    }
	
	public function actionMakePayment()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('make_payment/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionMakePaymentCreate($id)
    {
		$temp = User::find()->select(['id', 'basic_salary'])->where(['id' => $id])->asArray()->one();
		// print_r($temp['basic_salary']);
		// die();
        $model = new Payroll();
		$model->user_id = $id;
		$model->monthly_salary = $temp['basic_salary'];
        $model->payment_date = date("Y-m-d H:i:s");
        $model->status = '1';
        $model->created_by = Yii::$app->user->id;
        $model->created_on = date("Y-m-d H:i:s");

        if ($model->load(Yii::$app->request->post())) {
            $model->payment_month = $model->payment_month.= '-00';
            //die();
            if($model->save())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        return $this->renderAjax('make_payment/_form', [
            'model' => $model,
            //'departmentdropdown' => $departmentdropdown,
        ]);
    }

    public function actionMakePaymentUpdate($id)
    {
        $model = $this->findModelPayroll($id);
        $model->updated_by = Yii::$app->user->id;
        $model->updated_on = date("Y-m-d H:i:s");
        $model->payment_month = substr($model->payment_month, 0, -3);

        if ($model->load(Yii::$app->request->post())) {
            $model->payment_month = $model->payment_month.= '-00';
            if($model->save())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        return $this->renderAjax('make_payment/_form', [
            'model' => $model,
        ]);
    }

    public function actionViewPayment($id)
    {
        $searchModel = new PayrollSearch();
        $dataProvider = $searchModel->advanceSearch(Yii::$app->request->queryParams, $id);

        return $this->render('make_payment/view', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        //return 'ViewPayment';
    }

	public function actionPayrollValidate()
    {
        if($_GET['id'])
        {
            $model = $this->findModelPayroll($_GET['id']);
            //$model->scenario = 'update';
        }
        else
        {
            $model = new Payroll();
            //$model->scenario = 'create';
        }

        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            $model->payment_month = $model->payment_month.= '-00';
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }
	
	protected function findModelPayroll($id)
    {
        if (($model = Payroll::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelDesignation($id)
    {
        if (($model = Designation::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelLeave($id)
    {
        if (($model = Leave::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelLeaveType($id)
    {
        if (($model = LeaveType::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelAttendance($EmployeeCode ,$attendance_date)
    {
        //return ($model = Attendance::find()->where(['attendance_date' => $attendance_date])->One());
        if (($model = Attendance::find()->where(['user_id' => $EmployeeCode, 'attendance_date' => $attendance_date])->One()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	protected function findModelUser($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
