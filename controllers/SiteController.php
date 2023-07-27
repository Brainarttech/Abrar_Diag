<?php

namespace app\controllers;

use app\models\AdditionalCostItem;
use app\models\ExtraSaleItem;
use app\models\ExtraSaleOptionItem;
use app\models\ItemName;
use app\models\OptionalItem;
use app\models\Payments;
use app\models\Sales;
use app\models\SalesItem;
use app\models\SalesItemSearch;
use app\models\SalesSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Report;
use app\models\ContactForm;
use app\models\Department;
use app\models\ItemCategory;
use yii\helpers\ArrayHelper;
use app\models\Product;
use app\models\UserReport;
use app\models\Patient;
use yii\db\Query;

use mPDF;

class SiteController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {

        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'actions' => ['login','patient-report','patient-lab-form-print-pdf'],
                    'allow' => true,
                ],
                [
                    'allow' => true,
                    'roles' => ['@'],
                /* 'matchCallback' => function ($rule, $action) {

                  // $module                 = Yii::$app->controller->module->id;
                  $action                 = Yii::$app->controller->action->id;
                  $controller         = Yii::$app->controller->id;
                  $route                     = "$controller/$action";
                  $post = Yii::$app->request->post();


                  if($route=='site/logout' || $route=='site/validate-complain')
                  {
                  return true;
                  }
                  else if (\Yii::$app->user->can($route)) {
                  return true;
                  }
                  else
                  {
                  return true;
                  }

                  } */
                ],
            ],
        ];
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'logout' => ['GET'],
            ]
        ];


        return $behaviors;
    }

    public function beforeAction($action) {
        if (parent::beforeAction($action)) {
            // change layout for error action
            if (Yii::$app->user->identity->role == "Manager") {
                $this->layout = 'manager';
            } else if (Yii::$app->user->identity->role == "reception") {
                $this->layout = 'reception';
            } else if (Yii::$app->user->identity->role == "accountant") {
                $this->layout = 'accounts';
            } else if (Yii::$app->user->identity->role == "CT Scan" || Yii::$app->user->identity->role == "Laboratory" || Yii::$app->user->identity->role == "ultrasound" || Yii::$app->user->identity->role == "xray" || Yii::$app->user->identity->role == "department") {
                $this->layout = 'department';
            } else if (strtolower(Yii::$app->user->identity->role) == "admin")  {
                $this->layout = 'admin';
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionPos() {
        return $this->render('pos');
    }

    public function actionPrintBill() {
        return $this->renderPartial('print_bill');
    }

    public function actionRefundBill() {
        if (\Yii::$app->user->can('site/refund-bill')) {
            return $this->render('refund-bill');
        } else {
            throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
        }
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        //echo Yii::$app->user->identity->role;
        //return ;
        // Daily Sales Report
        $date_end = date("Y-m-d H:i:s");
        $sales = [];
        $i = 0;
        while ($i < 15) {
            $date_start = date('Y-m-d H:i:s', strtotime($date_end . ' - ' . $i . ' hours'));
            $dailySales = Sales::find()->where(['like', 'created_on', $date_start])->andWhere(['status' => '1']);
            $sales[$i]['date'] = $date_start;
            $sales[$i]['sales'] = $dailySales->count();
            $i++;
        }
        $daily_sale = $sales;

        // Weekly Report
        $date_end = date("Y-m-d");
        $sales = [];
        $i = 0;
        while ($i < 7) {
            $date_start = date('Y-m-d', strtotime($date_end . ' - ' . $i . ' days'));
            $dailySales = Sales::find()->where(['like', 'created_on', $date_start])->andWhere(['status' => '1']);
            $sales[$i]['date'] = $date_start;
            $sales[$i]['sales'] = $dailySales->count();
            $i++;
        }
        $data = $sales;

        // Monthly sales Report
        $date_end = date("Y-m-d");
        $sales = [];
        $i = 0;
        while ($i < 7) {
            $date_start = date('Y-m-d', strtotime($date_end . ' - ' . $i . ' months'));
            $dailySales = Sales::find()->where(['like', 'created_on', $date_start])->andWhere(['status' => '1']);
            $sales[$i]['date'] = $date_start;
            $sales[$i]['sales'] = $dailySales->count();
            $i++;
        }
        $monthly_sales = $sales;

        return $this->render('index', [
                    'sales' => $data,
                    'daily_sales' => $daily_sale,
                    'monthly_sales' => $monthly_sales,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin() {
        if (Yii::$app->user->identity->role == "Manager") {
            $this->layout = 'main-hrm';
        }
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (Yii::$app->user->identity->role == "Manager") {
                return $this->redirect(['hrm/index']);
            }
            return $this->goBack();
        }
        $model->password = '';
        return $this->render('login', [
                    'model' => $model,
        ]);
    }
	
	

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact() {
        return $this->renderPartial('contact');
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout() {
        return $this->render('about');
    }

    public function actionPendingDepartmentBill() {
        echo Yii::$app->user->identity->role;
        $searchModel = new SalesSearch();
        $dataProvider = $searchModel->pendingDepartmentBillsearch(Yii::$app->request->queryParams);
        return $this->render('pending-department-bill', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionViewPendingDepartmentBill() {
        return $this->render('view-pending-department-bill');
    }

    /**
     * Department
     *
     * @return Response|string
     */
    public function actionPendingTest() {

        $searchModel = new SalesItemSearch();
        $assign_department = Yii::$app->user->identity->assign_department;
        $dataProvider = $searchModel->searchAssignPendingDepartment(Yii::$app->request->queryParams, $assign_department);
        return $this->render('pending-test', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCompleteTest() {
        
        $searchModel = new SalesItemSearch();
        
        $assign_department = Yii::$app->user->identity->assign_department;
        $dataProvider = $searchModel->searchAssignCompleteDepartment(Yii::$app->request->queryParams, $assign_department);
        return $this->render('complete-test', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    
        ]);
    }
 
    public function actionGenerateReportUser()
    {
        // Ensure the request is AJAX to enhance security
        
        // Get the raw JSON data sent in the AJAX request
        $rawData = Yii::$app->request->rawBody;

        // Log the raw JSON data without any extra information
        Yii::info("Raw JSON Data: $rawData");

        // Decode the JSON data
        $jsonData = json_decode($rawData, true);

        // Now you can access the individual form field values and the linkId from the $jsonData array
        $invoice_id = $jsonData['inputFieldName1'];
        $item_id = $jsonData['inputFieldName2'];
        $patient_id = $jsonData['inputFieldName3'];
        $linkId = $jsonData['linkId'];

        $userdata = UserReport::find()->where(['invoice_no' => $invoice_id])->where(['paitent_id' => $patient_id])->where(['item_id' => $item_id])->one();
        $patient_data = Patient::find()->where(['id' => $patient_id])->one();
        $item_data = ItemName::find()->where(['id' => $item_id])->one();
        
        

        $get_invoice_data=$userdata->invoice_no;
        $get_patient_id=$userdata->patient_id;
        $get_item_id=$userdata->item_id;

        if ($userdata !== null) {
            $get_invoice_data = $userdata->invoice_no;
            $get_patient_id = $userdata->patient_id;
            $get_item_id = $userdata->item_id;
    
            // Render the view file with the provided data
            $html = $this->renderAjax('generate-report-user', [
                'invoice_no' => $get_invoice_data,
                'patient_id' => $get_patient_id,
                'item_data' => $item_data,
                'patient_data'=>$patient_data,
                'report_data'=>$userdata->report,
            ]);
    
            // Now we can use these variables in your controller logic as needed
            return $html;
        }
    
        return 0;
    }






    public function actionReport() {
        if (Yii::$app->request->isAjax) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $departmentID = $_REQUEST['department_id'];
            $itemID = $_REQUEST['item_id'];
            $start = Yii::$app->request->post('start_date', '');
            $end = Yii::$app->request->post('end_date', '');
            $model = new SalesItem();
            $data = $model->find()
                ->joinWith(['sale.patient', 'item.category.department', 'user'])
                ->where(['item_category.id' => $departmentID, 'sale_item.item_id' => $itemID, 'sale_item.test_status' => '2'])
                ->andWhere(['between', 'sale_item.created_on', $start, $end ])
                ->limit($_REQUEST['length'])->offset($_REQUEST['start']);
            $count = $model->find()
                ->joinWith(['sale.patient', 'item.category.department', 'user'])
                ->where(['item_category.id' => $departmentID, 'sale_item.item_id' => $itemID, 'sale_item.test_status' => '2'])
                ->andWhere(['between', 'sale_item.created_on', $start, $end ])
                ->count();
            return [
                "draw" => intval($_REQUEST['draw']),
                "recordsTotal"    => intval($model->find()->count()),
                "recordsFiltered" => intval($count),
                "data"=> $data->asArray()->all(),
                "start" => (intval($_REQUEST['start']))+1,
                "length" => (intval($_REQUEST['length']))+1,
            ];
        }
        $searchModel = new SalesItemSearch();
        $assign_department = Yii::$app->user->identity->assign_department;
        // dd(Yii::$app->request->queryParams);
        $dataProvider = $searchModel->report(Yii::$app->request->queryParams);
        // $items = ArrayHelper::map(
        //     ItemName::find()->andWhere(['cat_id' => '1'])->asArray()->all(),
        //     'id',
        //     'name'
        // );
        return $this->render(
            'report',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                // 'items' => $items,
            ]
        );
    }

    public function actionReportStats() {
        $departmentID = Yii::$app->request->post('department_id', '');
        $itemID = Yii::$app->request->post('item_id', '');
        $start = Yii::$app->request->post('start', '');
        $end = Yii::$app->request->post('end', '');
        $salesItem = new SalesItem();
        $count = $salesItem->find()
            ->joinWith(['sale.patient', 'item.category.department', 'user'])
            ->where(['item_category.id' => $departmentID, 'sale_item.item_id' => $itemID, 'sale_item.test_status' => '2'])
            ->andWhere(['between', 'sale_item.created_on', $start, $end ])
            ->count();
        $totalPrice = $salesItem->find()
            ->joinWith(['sale.patient', 'item.category.department', 'user'])
            ->where(['item_category.id' => $departmentID, 'sale_item.item_id' => $itemID, 'sale_item.test_status' => '2'])
            ->andWhere(['between', 'sale_item.created_on', $start, $end ])
            ->sum('item_price');
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'count' => $count,
            'name' => ItemCategory::find()->where(['id' => $departmentID])->one()->name,
            'item_name' => ItemName::find()->where(['id' => $itemID])->one()->name,
            'total_price' => $totalPrice
        ];
    }

    public function actionItems() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);
            $itemNames = ItemName::find()
                ->where(['cat_id' => $id])
                ->asArray()
                ->all();
            $selected  = null;
            if ($id != null && count($itemNames) > 0) {
                $selected = '';
                foreach ($itemNames as $i => $itemName) {
                    $out[] = ['id' => $itemName['id'], 'name' => $itemName['name']];
                    if ($i == 0) {
                        $selected = $itemName['id'];
                    }
                }
                return ['output' => $out, 'selected' => $selected];
            }
        }
        return ['output' => '', 'selected' => ''];
    }
    public function actionPatientReport() {
        $searchModel = new SalesItemSearch();
        $dataProvider = $searchModel->searchPatientReport(Yii::$app->request->queryParams);
        // var_dump($dataProvided , Yii::$app->request->queryParams);die;
        return $this->render('patient-report', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    public function actionUpdateSaleItem($id) {
        
        //Check Allow Or Not
        $assign_department = Yii::$app->user->identity->assign_department;
        $assign_department = explode(',', $assign_department);
        //echo '<pre>';
        //echo print_r(Yii::$app->user->identity->assign_department);
        //echo '</pre>';
        $query = SalesItem::find()
                ->joinWith(['item.category.department'])
                ->joinWith(['labForm'])
                ->where(['in', 'department.id', $assign_department])
                ->andWhere(['test_status' => 1])
                ->andWhere(['sale_item.id' => $id]);
        //->asArray()
        $query = $query->one();
        // echo '<pre>';
        // echo print_r($query->item->id);
        // echo '</pre>';
        // die();
        //echo '<pre>';
        //echo print_r($query->item->category->department_id);
        //echo '</pre>';
		//for lab test area
        $option_items = Product::find()->where(['status' => 1])->all();
        if ($query->item->category->department_id == 10) {
            $required_option_items = OptionalItem::find()
                    ->joinWith(['category.department'])
                    ->where(['in', 'department.id', $assign_department])
                    ->where(['in', 'optional_item.cat_id', $assign_department])
                    ->andWhere(['required' => 1]);
            if (Yii::$app->user->identity->role != "Admin") {
                $required_option_items->andWhere(['optional_item.status' => '1']);
            }
            $required_option_items = $required_option_items->all();
            $extra_charges = AdditionalCostItem::find()
                    ->joinWith(['category.department'])
                    ->where(['in', 'department.id', $assign_department])
                    ->orWhere(['cat_id' => 10]);
            if (Yii::$app->user->identity->role != "Admin") {
                $extra_charges->andWhere(['additional_cost_item.status' => '1']);
            }
            $extra_charges = $extra_charges->all();
            return $this->render('lab-update-sale-item', [
                        'data' => $query,
                        'required_option_items' => $required_option_items,
                        'option_items' => $option_items,
                        'extra_charges' => $extra_charges,
                            //'dataProvider' => $dataProvider,
            ]);
        } 
		// for lab test area end
		elseif ($query) {
            $required_option_items = OptionalItem::find()
                    ->joinWith(['category.department'])
                    ->where(['in', 'department.id', $assign_department])
                    ->where(['in', 'optional_item.cat_id', $assign_department])
                    ->andWhere(['required' => 1]);
            if (Yii::$app->user->identity->role != "Admin") {
                $required_option_items->andWhere(['optional_item.status' => '1']);
            }
            $required_option_items = $required_option_items->all();
            $extra_charges = AdditionalCostItem::find()
                    ->joinWith(['category.department'])
                    ->where(['in', 'department.id', $assign_department])
                    ->orWhere(['cat_id' => NULL]);
            if (Yii::$app->user->identity->role != "Admin") {
                $extra_charges->andWhere(['additional_cost_item.status' => '1']);
            }
            $extra_charges = $extra_charges->all();
            return $this->render('update-sale-item', [
                        'data' => $query,
                        'required_option_items' => $required_option_items,
                        'option_items' => $option_items,
                        'extra_charges' => $extra_charges,
                            //'dataProvider' => $dataProvider,
            ]);
        } else {

            throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
        }
    }

    public function actionEditSaleItem($id) {
        $assign_department = Yii::$app->user->identity->assign_department;
        $assign_department = explode(',', $assign_department);

//echo '<pre>';
        //echo print_r(Yii::$app->user->identity->assign_department);
        //echo '</pre>';
        $query = SalesItem::find()
                ->joinWith(['item.category.department'])
                ->joinWith(['labForm'])
                ->where(['in', 'department.id', $assign_department])
                ->andWhere(['test_status' => 2])
                ->andWhere(['sale_item.id' => $id]);
        //->asArray()
        $query = $query->one();

            $required_option_items = OptionalItem::find()
                    ->joinWith(['category.department'])
                    ->where(['in', 'department.id', $assign_department])
                    ->where(['in', 'optional_item.cat_id', $assign_department])
                    ->andWhere(['required' => 1]);
            if (Yii::$app->user->identity->role != "Admin") {
                $required_option_items->andWhere(['optional_item.status' => '1']);
            }
            $required_option_items = $required_option_items->all();
            $option_items = OptionalItem::find()
                    ->joinWith(['category.department'])
                    ->where(['in', 'department.id', $assign_department])
                    ->where(['optional_item.cat_id' => 10])
                    ->andWhere(['required' => 0]);
            if (Yii::$app->user->identity->role != "Admin") {
                $option_items->where(['optional_item.status' => '1']);
            }
            $option_items->all();
            $extra_charges = AdditionalCostItem::find()
                    ->joinWith(['category.department'])
                    ->where(['in', 'department.id', $assign_department])
                    ->orWhere(['cat_id' => 10]);
            if (Yii::$app->user->identity->role != "Admin") {
                $extra_charges->andWhere(['additional_cost_item.status' => '1']);
            }
            $extra_charges = $extra_charges->all();
            $lab_form = \app\models\LabFormSubmit::find()->where(['sale_item_id' => $id])->one();
              $lab_form_id = $lab_form->lab_form_id;
            return $this->render('lab-edit-sale-item', [
                        'data' => $query,
                        'required_option_items' => $required_option_items,
                        'option_items' => $option_items,
                        'extra_charges' => $extra_charges,
                        'lab_form_id' => $lab_form_id,
                            //'dataProvider' => $dataProvider,
            ]);
    }

    public function actionViewSaleItem($id) {
        //return $id;

        /* $query2 = SalesItem::find()->joinWith(['labTestId'])->where(['in', 'sale_item.id', $id])->all();

          if(empty($query2[0][labTestId])){
          //echo "empty";
          $dataReader[0][lab_table_name] = "empty";
          }
          else{
          $fetch_lab_table_name = $query2[0][labTestId][0][test_table_name];
          //echo $fetch_lab_table_name;
          $connection = \Yii::$app->db;
          $sql="SELECT * FROM ".$fetch_lab_table_name." WHERE sale_item_id=".$id;
          //$sql="select auth_item.* from auth_item,auth_assignment where auth_item.type=1 and auth_assignment.user_id=$user_id and auth_assignment.item_name=auth_item.name";
          $command=$connection->createCommand($sql);
          $dataReader=$command->queryAll();
          $dataReader[0][lab_table_name] = $fetch_lab_table_name;
          } */

        //Check Allow Or Not
        $assign_department = Yii::$app->user->identity->assign_department;
        $assign_department = explode(',', $assign_department);

        //$query = SalesItem::find()->joinWith(['item.category.department'])->where(['in', 'department.id', $assign_department])->andWhere(['test_status'=>2])->andWhere(['sale_item.id'=>$id])->one();
        //$query = SalesItem::find()->joinWith(['item.category.department'])->where(['in', 'department.id', $assign_department])->andWhere(['test_status'=>2])->andWhere(['sale_item.id'=>$id])->one();
        //$query = SalesItem::find()->joinWith(['item.category.department'])->where(['in', 'department.id', $assign_department])->where(['sale_item.item_price'=>200])->asArray()->one();
        $query = SalesItem::find()
                        ->joinWith(['item.category.department'])
                        ->joinWith(['labFormSubmit.labFormFieldSubmit'])
                        //->joinWith(['labFormSubmit.labFormFieldSubmit'])
                        ->where(['in', 'department.id', $assign_department])
                        ->where(['test_status' => 2])
                        ->where(['sale_item.id' => $id])->one();

        // echo '<pre>';
        // echo print_r($query);
        // echo '</pre>';
        // die();
        // return;

        if ($query->item->category->department_id == 10) {
            //return 'Lab';
            $option_items = ExtraSaleOptionItem::find()->where(['sale_item_id' => $query->id])->all();
            $extra_charges = ExtraSaleItem::find()->where(['sale_item_id' => $query->id])->all();
            return $this->render('lab-view-sale-item', [
                        'data' => $query,
                        //'dataReader' => $dataReader,
                        'option_items' => $option_items,
                        'extra_charges' => $extra_charges,
                            //'dataProvider' => $dataProvider,
            ]);
        } else if ($query) {
            $option_items = ExtraSaleOptionItem::find()->where(['sale_item_id' => $query->id])->all();
            $extra_charges = ExtraSaleItem::find()->where(['sale_item_id' => $query->id])->all();
            //echo '<pre>';
            //echo print_r($query->comment);
            //echo '</pre>';
            //return ;
            return $this->render('view-sale-item', [
                        'data' => $query,
                        'option_items' => $option_items,
                        'extra_charges' => $extra_charges,
                            //'dataProvider' => $dataProvider,
            ]);
        } else {
            //return 'error';
            throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
        }
    }

    public function actionLabFormPrint($id) {
        $assign_department = Yii::$app->user->identity->assign_department;
        $assign_department = explode(',', $assign_department);

        $query = SalesItem::find()
                        ->joinWith(['item.category.department'])
                        ->joinWith(['sale.referred'])
                        ->joinWith(['labFormSubmit.labFormFieldSubmit'])
                        ->where(['in', 'department.id', $assign_department])
                        ->where(['test_status' => 2])
                        ->where(['sale_item.id' => $id])->one();



         if ($query->item->category->department_id == 10) { 
            // return $this->renderPartial('printlabform/report');
            return $this->renderPartial('printlabform/report', [
                        'query' => $query,
            ]);
        } 

        // echo '<pre>';
        // echo print_r($query);
        // echo '</pre>';
        // die();
        // return $this->renderPartial('printlabform/report', [
        // 'data' => $query,
        // 'option_items'=>$option_items,
        // 'extra_charges'=>$extra_charges,
        // //'dataProvider' => $dataProvider,
        // ]);
    }
    public function actionLabFormPrintPdf($id, $feedback) {
           $query = SalesItem::find()
                           ->joinWith(['item.category.department'])
                           ->joinWith(['sale.referred'])
                           ->joinWith(['labFormSubmit.labFormFieldSubmit'])
                           ->where(['test_status' => 2])
                           ->where(['sale_item.id' => $id])->one();
   
           $pdf_content = $this->renderPartial('printlabform/reportPdf',['query' => $query, "feedback"=>$feedback]);
           $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8' ,  'orientation' => 'P' ,'mrgin-top' => 0]);
           $mpdf->WriteHTML($pdf_content);
           $file = 'generatedPdfs/'. $query->sale->patient->name.'_'.$id.'_'.time().'.pdf';
           $mpdf->Output(  \Yii::getAlias('@webroot').'/'.$file,'F' );
           $arr = array(
                       "file" => "../".$file , 
                       "regNo" => $query->sale->patient->reg_no , 
                       "phone" => $query->sale->patient->phone_no , 
                       "email" => $query->sale->patient->email ,
                       "query"=>$query);
                       
                        // ===save unique token in database with pdf link===
           $token = substr(str_shuffle("0123456789abcdefghijklmnogfgfgfhfghghfhmlkjkjcwerwrepqrstvwxyz"), 0, 6);
           $report = new Report();
           $maxTries = 1000;
           $counter  = 0;
           while(++$counter  < $maxTries){
               $uniqueToken = Report::find()->where(["token"=>$token])->one();
               if(!$uniqueToken){
                   break;
               }
               //Make new token
               $token = substr(str_shuffle("0123456789abcdefdgghdthertetyertertyweryterwerryugyuguyiyugughijklmnopqrstvwxyz"), 0, 6);
           }
           $report->token = $token;
           $report->url = 'https://app.abrar-diagnostics.com/web/'.$file;
           $report->other = "token genertaed";
           $report->save();
           
           echo json_encode($arr);
               
       }
    public function actionTest() {
        $sale_item = SalesItem::find()->all();
        foreach ($sale_item as $sale) {
            $item = ItemName::findOne($sale->item_id);
            if ($item->cat_id == 8 || $item->cat_id == 10) {
                $caluclate = ($sale->item_price * $item->consultant_percentage) / 100;
                $caluclate = round($caluclate);
                $update = SalesItem::findOne($sale->id);
                $update->consultant_amount = $caluclate;
                $update->save();
            }
        }
    }


    public function actionPatientLabFormPrintPdf($id) {
    
        $query = SalesItem::find()
                        ->joinWith(['item.category.department'])
                        ->joinWith(['sale.referred'])
                        ->joinWith(['labFormSubmit.labFormFieldSubmit'])
                        ->where(['test_status' => 2])
                        ->where(['sale_item.id' => $id])->one();
        // for lab only that is department id 10

            // return $this->renderPartial('printlabform/report'); //check
        $pdf_content = $this->renderPartial('printlabform/reportPdf',['query' => $query]);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8' ,  'orientation' => 'P' ,'mrgin-top' => 0]);
        $mpdf->WriteHTML($pdf_content);
         $mailStr = $mpdf->Output("ViewReport.pdf" , "S");
        //echo $mailStr;
        //header("Content-Type: application/pdf" );
       
        $file = 'generatedPdfs/'. $query->sale->patient->name.'_'.$id.'_'.time().'.pdf';
         // chmod($file , 0644);

        $mpdf->Output($file,'F' );
        $arr = array(
            "file" => "../".$file , 
            "regNo" => $query->sale->patient->reg_no , 
            "phone" => $query->sale->patient->phone_no , 
            "email" => $query->sale->patient->email ,
            "query"=>$query);


         echo json_encode($arr);
    // return $this->renderPartial('printlabform/reportPdf', [
    //             'query' => $query,
    // ]);

        
    }
    public function actionDailySales() {
        $date_end = date("Y-m-d H:i:s");
        $sales = [];
        $i = 0;
        while ($i < 17) {
            $date_start = date('Y-m-d H:i:s', strtotime($date_end . ' - ' . $i . ' months'));
            $dailySales = Sales::find()->where(['like', 'created_on', $date_start])->andWhere(['status' => '1']);
            $sales[]['date'] = $date_start;
            $sales[]['sales'] = $dailySales->count();
            $i++;
        }
        $data = $sales;
        print_r($data);
    }
	
	
	public function actionLooog() {
        if (Yii::$app->user->identity->role == "Manager") {
            $this->layout = 'main-hrm';
        }
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (Yii::$app->user->identity->role == "Manager") {
                return $this->redirect(['hrm/index']);
            }
            return $this->goBack();
        }
        $model->password = '';
        return $this->render('login', [
                    'model' => $model,
        ]);
    }
    
}
