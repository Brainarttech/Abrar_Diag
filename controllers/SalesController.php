<?php

namespace app\controllers;

use app\models\SalesItemSearch;
use DateTime;
use Yii;
use app\models\Sales;
use app\models\SalesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SalesController implements the CRUD actions for Sales model.
 */
class SalesController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
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
            if (Yii::$app->user->identity->role == "Manager") {
                $this->layout = 'main-hrm';
            } else if (Yii::$app->user->identity->role == "reception") {
                $this->layout = 'reception';
            } else if (Yii::$app->user->identity->role == "accountant") {
                $this->layout = 'accounts';
            } else if (Yii::$app->user->identity->role == "CT Scan" || Yii::$app->user->identity->role == "Laboratory" || Yii::$app->user->identity->role == "ultrasound" || Yii::$app->user->identity->role == "xray" || Yii::$app->user->identity->role == "department") {
                $this->layout = 'department';
            } else {
                $this->layout = 'admin';
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Lists all Sales models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new SalesSearch();
        if (empty(Yii::$app->request->queryParams['SalesSearch']['created_on'])) {
            $start = date('Y-m-d 00:00:00');
            $end = date('Y-m-d 23:59:59');



            $start_date = DateTime::createFromFormat('Y-m-d H:i:s', $start);
            $start_date = $start_date->format('d/m/Y h:i A');

            $end_date = DateTime::createFromFormat('Y-m-d H:i:s', $end);
            $end_date = $end_date->format('d/m/Y h:i A');

            $range = $start_date . ' - ' . $end_date;


            $searchModel->created_on = $range;
        }

        //return print_r(Yii::$app->request->queryParams);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sales model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->renderAjax('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Sales model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        exit;
        $model = new Sales();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Sales model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        exit;
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Sales model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        exit;
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Sales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Sales::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPrintDailysalereport() {

        return $this->renderPartial('print_daily_sale_report');
    }

    public function actionPrintDailytestreport() {

        return $this->renderPartial('print_daily_test_report');
    }

    public function actionPrintDailydetailsalereport() {

        return $this->renderPartial('print_daily_detail_sale_report');
    }

    public function actionDailysalereport() {
        if (isset($_GET['day'])) {

            if (empty($_GET['day'])) {
                $today = date('Y-m-d');
                $previous = date('ymd', strtotime($today . '-1 day'));
                $next = date('ymd', strtotime($today . '+1 day'));
            } else {
                $today_date = str_split($_GET['day'], 2);
                $today_date = implode('-', $today_date);
                $today = '20' . $today_date;
                $previous = date('ymd', strtotime($today . '-1 day'));
                $next = date('ymd', strtotime($today . '+1 day'));
            }


            $searchModel = new SalesSearch();
            $dataProvider = $searchModel->dailySaleSearch(Yii::$app->request->queryParams, $today);
            $dataProvider->pagination = false;
        } else if (isset($_GET['from']) && isset($_GET['to']) && !empty($_GET['from']) && !empty($_GET['to'])) {
            $from = $_GET['from'];
            $to = $_GET['to'];
            $start_date = $_GET['from'];
            $end_date = $_GET['to'];


            $start_date = DateTime::createFromFormat('d/m/Y', $start_date);
            $start_date = $start_date->format('Y-m-d');

            $end_date = DateTime::createFromFormat('d/m/Y', $end_date);
            $end_date = $end_date->format('Y-m-d');

            $end_date = date('Y-m-d H:i:s', strtotime($end_date . ' +1 day'));

            $searchModel = new SalesSearch();
            $dataProvider = $searchModel->dailySaleSearch(Yii::$app->request->queryParams, '', $start_date, $end_date);
            $dataProvider->pagination = false;
        } else {
            $today = date('Y-m-d');
            $previous = date('ymd', strtotime($today . '-1 day'));
            $next = date('ymd', strtotime($today . '+1 day'));
            $searchModel = new SalesSearch();
            $dataProvider = $searchModel->dailySaleSearch(Yii::$app->request->queryParams, $today);
            $dataProvider->pagination = false;
        }



        return $this->render('dailysalereport', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'previous' => $previous,
                    'next' => $next,
                    'today' => $today,
                    'from' => $from,
                    'to' => $to
        ]);
    }

    public function actionDailytestreport() {
        if (isset($_GET['day'])) {

            $today_date = str_split($_GET['day'], 2);
            $today_date = implode('-', $today_date);
            $today = '20' . $today_date;

            $previous = date('ymd', strtotime($today . '-1 day'));
            $next = date('ymd', strtotime($today . '+1 day'));
        } else {
            $today = date('Y-m-d');
            $previous = date('ymd', strtotime($today . '-1 day'));
            $next = date('ymd', strtotime($today . '+1 day'));
        }
        $searchModel = new SalesItemSearch();
        $dataProvider = $searchModel->dailysearch(Yii::$app->request->queryParams, $today);
        $dataProvider->pagination = false;


        return $this->render('daily-test-report', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'previous' => $previous,
                    'next' => $next,
                    'today' => $today,
        ]);
    }

    public function actionDailydetailsalereport() {


        if (isset($_GET['day'])) {

            if (empty($_GET['day'])) {
                $today = date('Y-m-d');
                $previous = date('ymd', strtotime($today . '-1 day'));
                $next = date('ymd', strtotime($today . '+1 day'));
            } else {
                $today_date = str_split($_GET['day'], 2);
                $today_date = implode('-', $today_date);
                $today = '20' . $today_date;
                $previous = date('ymd', strtotime($today . '-1 day'));
                $next = date('ymd', strtotime($today . '+1 day'));
            }
            $searchModel = new SalesSearch();
            $dataProvider = $searchModel->dailySaleSearch(Yii::$app->request->queryParams, $today);
            $dataProvider->pagination = false;
        } else if (isset($_GET['from']) && isset($_GET['to']) && !empty($_GET['from']) && !empty($_GET['to'])) {
            $from = $_GET['from'];
            $to = $_GET['to'];
            $start_date = $_GET['from'];
            $end_date = $_GET['to'];

            

            $start_date = DateTime::createFromFormat('d/m/Y', $start_date);
            $start_date = $start_date->format('Y-m-d');

            $end_date = DateTime::createFromFormat('d/m/Y', $end_date);
            $end_date = $end_date->format('Y-m-d');
            $end_date = date('Y-m-d H:i:s', strtotime($end_date . ' +1 day'));

            $searchModel = new SalesSearch();
            $dataProvider = $searchModel->dailySaleSearch(Yii::$app->request->queryParams, $today);
            $dataProvider->pagination = false;
        } else {
            $today = date('Y-m-d');
            $previous = date('ymd', strtotime($today . '-1 day'));
            $next = date('ymd', strtotime($today . '+1 day'));
            $searchModel = new SalesSearch();
            $dataProvider = $searchModel->dailySaleSearch(Yii::$app->request->queryParams, $today);
            $dataProvider->pagination = false;
        }



        return $this->render('dailydetailsalereport', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'previous' => $previous,
                    'next' => $next,
                    'today' => $today,
                    'from' => $from,
                    'to' => $to
        ]);
    }

    public function actionCustomSaleReport() {
        $searchModel = new SalesSearch();
        $dataProvider = $searchModel->CustomSalesearch(Yii::$app->request->queryParams);
        $dataProvider->pagination = false;

        return $this->render('custom_sale_report', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCustomSaleReportPrint() {
        $searchModel = new SalesSearch();
        $dataProvider = $searchModel->CustomSalesearch(Yii::$app->request->queryParams);
        $dataProvider->pagination = false;

        return $this->renderPartial('print_custom_sale_report', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTestsSaleReport()
    {
        
        $searchModel = new SalesSearch();
        $dataProvider = $searchModel->TestsSaleReportSearch(Yii::$app->request->queryParams);
        $dataProvider->pagination = false;

        if(Yii::$app->request->queryParams['print'])
        {
            return $this->renderPartial('tests-sale-report-print', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        return $this->render('tests-sale-report', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDepartmentSaleReport()
    {
        
        $searchModel = new SalesSearch();
        $dataProvider = $searchModel->DepartmentSaleReportSearch(Yii::$app->request->queryParams);
        $dataProvider->pagination = false;

        if(Yii::$app->request->queryParams['print'])
        {
            return $this->renderPartial('department-sale-report-print', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        return $this->render('department-sale-report', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionComplete() {
        
        $searchModel = new SalesSearch();
        if (empty(Yii::$app->request->queryParams['SalesSearch']['created_on'])) {
            $start = date('Y-m-d 00:00:00');
            $end = date('Y-m-d 23:59:59');

            $start_date = DateTime::createFromFormat('Y-m-d H:i:s', $start);
            $start_date = $start_date->format('d/m/Y h:i A');

            $end_date = DateTime::createFromFormat('Y-m-d H:i:s', $end);
            $end_date = $end_date->format('d/m/Y h:i A');

            $range = $start_date . ' - ' . $end_date;
            $searchModel->created_on = $range;
        }

        //return print_r($searchModel);
        $dataProvider = $searchModel->completeSalesSearch(Yii::$app->request->queryParams);
        //  return print_r($dataProvider);
       //return print_r(Yii::$app->request->queryParams);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionPartialRefund() {
        
        $searchModel = new SalesSearch();
        if (empty(Yii::$app->request->queryParams['SalesSearch']['created_on'])) {
            $start = date('Y-m-d 00:00:00');
            $end = date('Y-m-d 23:59:59');

            $start_date = DateTime::createFromFormat('Y-m-d H:i:s', $start);
            $start_date = $start_date->format('d/m/Y h:i A');

            $end_date = DateTime::createFromFormat('Y-m-d H:i:s', $end);
            $end_date = $end_date->format('d/m/Y h:i A');

            $range = $start_date . ' - ' . $end_date;
            $searchModel->created_on = $range;
        }

        //return print_r($searchModel);
        $dataProvider = $searchModel->completeSalesSearch(Yii::$app->request->queryParams);
        //  return print_r($dataProvider);
       //return print_r(Yii::$app->request->queryParams);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionRefund() {
        
        $searchModel = new SalesSearch();
        if (empty(Yii::$app->request->queryParams['SalesSearch']['created_on'])) {
            $start = date('Y-m-d 00:00:00');
            $end = date('Y-m-d 23:59:59');

            $start_date = DateTime::createFromFormat('Y-m-d H:i:s', $start);
            $start_date = $start_date->format('d/m/Y h:i A');

            $end_date = DateTime::createFromFormat('Y-m-d H:i:s', $end);
            $end_date = $end_date->format('d/m/Y h:i A');

            $range = $start_date . ' - ' . $end_date;
            $searchModel->created_on = $range;
        }

        //return print_r($searchModel);
        $dataProvider = $searchModel->completeSalesSearch(Yii::$app->request->queryParams);
        //  return print_r($dataProvider);
       //return print_r(Yii::$app->request->queryParams);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionPaid() {
        
        $searchModel = new SalesSearch();
        if (empty(Yii::$app->request->queryParams['SalesSearch']['created_on'])) {
            $start = date('Y-m-d 00:00:00');
            $end = date('Y-m-d 23:59:59');

            $start_date = DateTime::createFromFormat('Y-m-d H:i:s', $start);
            $start_date = $start_date->format('d/m/Y h:i A');

            $end_date = DateTime::createFromFormat('Y-m-d H:i:s', $end);
            $end_date = $end_date->format('d/m/Y h:i A');

            $range = $start_date . ' - ' . $end_date;
            $searchModel->created_on = $range;
        }

        //return print_r($searchModel);
        $dataProvider = $searchModel->paymentSalesSearch(Yii::$app->request->queryParams);
        //  return print_r($dataProvider);
       //return print_r(Yii::$app->request->queryParams);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    
    
    public function actionPartialPayment() {
        
        $searchModel = new SalesSearch();
        if (empty(Yii::$app->request->queryParams['SalesSearch']['created_on'])) {
            $start = date('Y-m-d 00:00:00');
            $end = date('Y-m-d 23:59:59');

            $start_date = DateTime::createFromFormat('Y-m-d H:i:s', $start);
            $start_date = $start_date->format('d/m/Y h:i A');

            $end_date = DateTime::createFromFormat('Y-m-d H:i:s', $end);
            $end_date = $end_date->format('d/m/Y h:i A');

            $range = $start_date . ' - ' . $end_date;
            $searchModel->created_on = $range;
        }

        //return print_r($searchModel);
        $dataProvider = $searchModel->paymentSalesSearch(Yii::$app->request->queryParams);
        //  return print_r($dataProvider);
       //return print_r(Yii::$app->request->queryParams);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    
    
    public function actionDuePayment() {
        
        $searchModel = new SalesSearch();
        if (empty(Yii::$app->request->queryParams['SalesSearch']['created_on'])) {
            $start = date('Y-m-d 00:00:00');
            $end = date('Y-m-d 23:59:59');

            $start_date = DateTime::createFromFormat('Y-m-d H:i:s', $start);
            $start_date = $start_date->format('d/m/Y h:i A');

            $end_date = DateTime::createFromFormat('Y-m-d H:i:s', $end);
            $end_date = $end_date->format('d/m/Y h:i A');

            $range = $start_date . ' - ' . $end_date;
            $searchModel->created_on = $range;
        }

        //return print_r($searchModel);
        $dataProvider = $searchModel->paymentSalesSearch(Yii::$app->request->queryParams);
        //  return print_r($dataProvider);
       //return print_r(Yii::$app->request->queryParams);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    
    
    public function actionDepartmentPush() {
        
        $searchModel = new SalesSearch();
        if (empty(Yii::$app->request->queryParams['SalesSearch']['created_on'])) {
            $start = date('Y-m-d 00:00:00');
            $end = date('Y-m-d 23:59:59');

            $start_date = DateTime::createFromFormat('Y-m-d H:i:s', $start);
            $start_date = $start_date->format('d/m/Y h:i A');

            $end_date = DateTime::createFromFormat('Y-m-d H:i:s', $end);
            $end_date = $end_date->format('d/m/Y h:i A');

            $range = $start_date . ' - ' . $end_date;
            $searchModel->created_on = $range;
        }

        //return print_r($searchModel);
        $dataProvider = $searchModel->paymentSalesSearch(Yii::$app->request->queryParams);
        //  return print_r($dataProvider);
       //return print_r(Yii::$app->request->queryParams);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
}
