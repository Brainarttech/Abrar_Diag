<?php

namespace app\controllers;


use app\modules\rbac\models\AuthAssignment;
use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
use app\models\Attendance;
use app\models\AttendanceSearch;
use app\helpers\morris_bar_chart;
use app\helpers\datetime;					 

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
			'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','view','create','update','delete','validate','profile'],
                'rules' => [
					[
                        'allow' => true,
                        'actions' => ['profile'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','create','validate','update','view','delete'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return \Yii::$app->user->can(Yii::$app->controller->id.'/'.Yii::$app->controller->action->id);
                            //return false;
                            //echo 'asdasd';
                            //die();
                            //var_dump($action);
                            //echo '<pre>';
                            //echo print_r($rule);
                            //echo print_r($action);
                            //echo '</pre>';
                            //die();
                            //return false;
                            //return $rule;
                            //return \Yii::$app->user->can('useraccess');
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

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
	
    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
		//return 'test';
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $model->scenario = 'create';

        if ($model->load(Yii::$app->request->post()))
        {
			$model->assign_department = implode(",",$model->assign_department);
            //echo '<pre>';
            //echo print_r($model->assign_department);
            //echo '</pre>';
            //return 'Duzzz';		 
            if($id = $model->signup())
            {
                $authModel = new AuthAssignment();
                $authModel->item_name = $model->role;
                $authModel->user_id = "$id";
                if($authModel->save())
                {
                    //Sender::sendAccountEmail($model->email);
                    return true;
                }
                else
                {
                    return false;
                }

            }


            //return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->renderAjax('create', [
		//return $this->render('create', [								  
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if(isset($_GET['change-password']))
        {
            $model->scenario = 'changepassword';
        }else
        {
            $model->scenario = 'update';
        }
        $model->updated_by = Yii::$app->user->id;
        $model->updated_on = date("Y-m-d H:i:s");
		$model->assign_department = explode(',', $model->assign_department); 																	 

        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
			$model->assign_department = implode (",",$model->assign_department);
            if(isset($_GET['change-password'])) {

                $model->password_hash = Yii::$app->security->generatePasswordHash($model->password);
            }

            if($model->save())
            {
                return true;
            }
            else
            {

                return false;
            }



        }

        if(isset($_GET['change-password'])){
            return $this->renderAjax('changepassword', [
                'model' => $model,
            ]);
        }else
        {
			
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
        
    }



    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }



    public function actionValidate()
    {

        if($_GET['id'])
        {
            if(isset($_GET['change-password']))
            {
                $model = $this->findModel($_GET['id']);
                $model->scenario = 'changepassword';
            }else
            {
                $model = $this->findModel($_GET['id']);
                $model->scenario = 'update';
            }
            
        }
        else
        {
            $model = new User();
            $model->scenario = 'create';
        }

        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
			$model->assign_department = implode (",",$model->assign_department);
            //echo '<pre>';
            //echo print_r(ActiveForm::validate($model));
            //echo '</pre>';
            //die();	
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    public function actionProfile()
    {
        $model = $this->findModel(Yii::$app->user->id);
        $changepassword = $this->findModel(Yii::$app->user->id);

        $model->scenario = 'profile';

        $changepassword->scenario = 'profile_changepassword';

        $model->updated_by = Yii::$app->user->id;
        $model->updated_on = date("Y-m-d H:i:s");


        $changepassword->updated_by = Yii::$app->user->id;
        $changepassword->updated_on = date("Y-m-d H:i:s");

        $request = \Yii::$app->getRequest();

        if ($request->isPost && $model->load($request->post())) {

            if(isset($_POST['User']['username']))
            {

                $directory = Yii::getAlias('@app/profile_image') . DIRECTORY_SEPARATOR;
                if (!is_dir($directory)) {
                    FileHelper::createDirectory($directory);
                }else {

                    if ($files = UploadedFile::getInstance($model, 'file')) {

                        $model->image = $model->first_name . '00' . $model->id .'.'.$files->extension;

                        $filePath = $directory . $model->image;

                        if ($files->saveAs($filePath)) {

                            //echo "Good";
                        }else
                        {
                            echo "Eoor";
                            //exit;
                        }

                    }


                    if($model->save())
                    {
                        return $this->redirect(['user/profile']);
                    }else
                    {
                        return $this->render('profile', [
                            'model' => $model,
                            'changepassword' => $changepassword,
                        ]);
                    }

                }



            }

        }else
        {
            return $this->render('profile', [
                'model' => $model,
                'changepassword'=>$changepassword,
            ]);
        }



        if ($request->isPost && $changepassword->load($request->post())) {

            if(isset($_POST['User']['password']))
            {
                if (Yii::$app->getSecurity()->validatePassword($changepassword->old_password, $changepassword->password_hash)) {

                    $changepassword->password_hash = Yii::$app->security->generatePasswordHash($changepassword->password);
                    if ($changepassword->save()) {
                        Yii::$app->session->setFlash('success', "Password Change Successfully");

                        return $this->redirect(['user/profile']);

                    }
                } else {
                    $changepassword->addError('old_password', 'Old Password is Incorrect');
                    return $this->render('profile', [
                        'model' => $model,
                        'changepassword' => $changepassword,
                    ]);
                }

            }


        }else
        {
            return $this->render('profile', [
                'model' => $model,
                'changepassword'=>$changepassword,
            ]);
        }


    }

	public function actionAttendance($id)
    {
        //return $id;
        //$attendance = Attendance::find()->where(['status' => '1', 'user_id'=>$id])->all();
        $searchModel = new AttendanceSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);
		
		if($_GET['attendance_date']){
			//return $_GET['attendance_date'];
			$dataProvider = $searchModel->advanceSearch(Yii::$app->request->queryParams, $id, $_GET['attendance_date']);
		}
		else{
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);
		}

        return $this->render('attendance', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        echo '<pre>';
        echo print_r($attendance);
        echo '</pre>';
    }

    public function actionAttendanceSearch($id)
    {
        if(isset($_GET['attendance_date'])){
            $year = $_GET['attendance_date'];
        }
        else{
            $year = date("Y");
        }

        $MorrisBarChart = array();
        for($iM =1;$iM<=12;$iM++)
        {
            $MorrisBarChartTemp = new morris_bar_chart();
            $MorrisBarChartTemp->y = date("F", strtotime("$iM/12/$year"));
            $MorrisBarChartTemp->a = datetime::countDays($year, $iM, array(0));
            $MorrisBarChartTemp->b = Attendance::find()->where(['status' => '1', 'user_id'=>$_GET['id']])->andWhere(['between', 'attendance_date', date('Y-m-01', strtotime("$iM/12/$year")), date('Y-m-t', strtotime("$iM/12/$year")) ])->count();
            array_push($MorrisBarChart,$MorrisBarChartTemp);
        }
        $MorrisBarChart = json_encode($MorrisBarChart);
        $searchModel = new AttendanceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);
        // echo '<pre>';
        // echo print_r($MorrisBarChart);
        // echo '</pre>';
        // return '';

        return $this->render('user_attendance_chart', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'MorrisBarChart' => $MorrisBarChart,
        ]);
    }

    public function actionAttendanceCount($id, $date)
    {
        $AttendanceArray = array();
        $MonthYear = explode("-",$date);
        
        $presentDays = Attendance::find()
        ->where(['status' => '1','user_id' => $id])
        ->andWhere(['=','month(`attendance_date`)', $MonthYear[1]]) //'0' for year
        ->andWhere(['=','year(`attendance_date`)', $MonthYear[0]]) // '1' for month
        ->count();

        array_push($AttendanceArray,(int)$presentDays);
        array_push($AttendanceArray,(int)(datetime::countDays($MonthYear[0], $MonthYear[1], array(0))));

        $AttendanceArray = json_encode($AttendanceArray);

        return $AttendanceArray;

        //return $presentDays;
        ///return datetime::countDays($MonthYear[1], $MonthYear[0], array(0)); // '0' for month '1' for year
    }
	
	// public function actionEmployeeSalaryList()
    // {
        // //$this->layout = 'main-hrm';
        // $searchModel = new UserSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // return $this->render('employee_salary_list', [
            // 'searchModel' => $searchModel,
            // 'dataProvider' => $dataProvider,
        // ]);
    // }


    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
