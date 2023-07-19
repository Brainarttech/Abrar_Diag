<?php

/**
 * Created by PhpStorm.
 * User: Multiline
 * Date: 9/29/2018
 * Time: 6:50 PM
 */

namespace app\controllers;

use app\models\ExpensesSearch;
use app\models\SalesItemSearch;
use app\models\SalesSearch;
use DateTime;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use yii\filters\VerbFilter;

class ReportController extends Controller {

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

    public function actionExpense() {

        $searchModel = new ExpensesSearch();
        $searchModel->scenario = 'report';

        if (empty(Yii::$app->request->queryParams)) {
            $start = date('Y-m-d 00:00:00');
            $end = date('Y-m-d 23:59:59');



            $start_date = DateTime::createFromFormat('Y-m-d H:i:s', $start);
            $start_date = $start_date->format('d/m/Y h:i A');

            $end_date = DateTime::createFromFormat('Y-m-d H:i:s', $end);
            $end_date = $end_date->format('d/m/Y h:i A');

            $range = $start_date . ' - ' . $end_date;


            $searchModel->created_on = $range;
        }

        $dataProvider = $searchModel->searchReport(Yii::$app->request->queryParams);


        return $this->render('expense_report', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSaleSummary() {


        $searchModel = new SalesSearch();
        $searchModel->scenario = 'report';

        if (empty(Yii::$app->request->queryParams)) {
            $start = date('Y-m-d 00:00:00');
            $end = date('Y-m-d 23:59:59');



            $start_date = DateTime::createFromFormat('Y-m-d H:i:s', $start);
            $start_date = $start_date->format('d/m/Y h:i A');

            $end_date = DateTime::createFromFormat('Y-m-d H:i:s', $end);
            $end_date = $end_date->format('d/m/Y h:i A');

            $range = $start_date . ' - ' . $end_date;


            $searchModel->created_on = $range;
        }

        $dataProvider = $searchModel->saleSummary(Yii::$app->request->queryParams);
        $dataProvider->pagination = false;


        //Print
        if (isset($_GET['type']) && $_GET['type'] == "print") {
            return $this->renderPartial('print_sale_summary_report', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->render('sale_summary_report', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        }
    }

    public function actionDetailSaleReport() {



        $searchModel = new SalesSearch();
        $searchModel->scenario = 'report';

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

        $dataProvider = $searchModel->saleSummary(Yii::$app->request->queryParams);
        $dataProvider->pagination = false;


        //Print
        if (isset($_GET['type']) && $_GET['type'] == "print") {
        


            $start_date = explode('-', $searchModel->created_on);
            //echo DateTime::createFromFormat('d/m/Y h:i A', trim($start_date[1]))->format('Y-m-d h:i');

            $end_date = $start_date[1];
            $start_date = $start_date[0];
            $start_date = DateTime::createFromFormat('d/m/Y h:i A', trim($start_date));
            $start_date = $start_date->format('Y-m-d H:i:s');

            $end_date = DateTime::createFromFormat('d/m/Y h:i A', trim($end_date));
            $end_date = $end_date->format('Y-m-d H:i:s');
            $pending_payments = \app\models\Payments::find()->where(['between', 'created_on', $start_date, $end_date])->andWhere(['like', 'reference_no', 'LAT'])->andWhere(['payment_status' => 1])->all();

            $expenses = \app\models\Expenses::find()->where(['between', 'created_on', $start_date, $end_date])->all();

            return $this->renderPartial('print_detail_sale_report', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'pending_payments' => $pending_payments,
                        'expenses' => $expenses,
            ]);
        } else {
            return $this->render('detail_sale_report', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        }
    }
    public function actionSummarySaleReport() {



        $searchModel = new SalesSearch();
        $searchModel->scenario = 'report';

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

        $dataProvider = $searchModel->saleSummary(Yii::$app->request->queryParams);
        $dataProvider->pagination = false;

        $start_date = explode('-', $searchModel->created_on);
            //echo DateTime::createFromFormat('d/m/Y h:i A', trim($start_date[1]))->format('Y-m-d h:i');

        $end_date = $start_date[1];
        $start_date = $start_date[0];
        $start_date = DateTime::createFromFormat('d/m/Y h:i A', trim($start_date));
        $start_date = $start_date->format('Y-m-d H:i:s');

        $end_date = DateTime::createFromFormat('d/m/Y h:i A', trim($end_date));
        $end_date = $end_date->format('Y-m-d H:i:s');
        $pending_payments = \app\models\Payments::find()->where(['between', 'created_on', $start_date, $end_date])->andWhere(['like', 'reference_no', 'LAT'])->andWhere(['payment_status' => 1])->all();
        $expenses = \app\models\Expenses::find()->where(['between', 'created_on', $start_date, $end_date])->all();
        //Print
        if (isset($_GET['type']) && $_GET['type'] == "print") {
            return $this->renderPartial('print_summary_sale_report', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'pending_payments' => $pending_payments,
                'expenses' => $expenses,
            ]);
        } else {
            return $this->render('summary_sale_report', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'pending_payments' => $pending_payments,
                'expenses' => $expenses,
            ]);
        }
    }

    public function actionTestSaleReport() {

        $searchModel = new SalesItemSearch();
        $searchModel->scenario = 'report';

        if (empty(Yii::$app->request->queryParams['SalesItemSearch']['created_on'])) {
            $start = date('Y-m-d 00:00:00');
            $end = date('Y-m-d 23:59:59');



            $start_date = DateTime::createFromFormat('Y-m-d H:i:s', $start);
            $start_date = $start_date->format('d/m/Y h:i A');

            $end_date = DateTime::createFromFormat('Y-m-d H:i:s', $end);
            $end_date = $end_date->format('d/m/Y h:i A');

            $range = $start_date . ' - ' . $end_date;


            $searchModel->created_on = $range;
        }

        $dataProvider = $searchModel->customSearch(Yii::$app->request->queryParams);
        $dataProvider->pagination = false;
        //Print
        if (isset($_GET['type']) && $_GET['type'] == "print") {
            return $this->renderPartial('print_test_sale_report', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->render('test_sale_report', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        }
    }

    public function actionDepartmentSaleReport() {


        $searchModel = new SalesSearch();
        $searchModel->scenario = 'report';

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

        $dataProvider = $searchModel->saleSummary(Yii::$app->request->queryParams);
        $dataProvider->pagination = false;


        //Print
        if (isset($_GET['type']) && $_GET['type'] == "print") {
            return $this->renderPartial('print_detail_sale_report', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->render('detail_sale_report', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        }
    }

}

?>
