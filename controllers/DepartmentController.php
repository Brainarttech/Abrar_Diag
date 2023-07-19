<?php

namespace app\controllers;

use Yii;
use app\models\Department;
use app\models\DepartmentSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
use DateTime;
/**
 * DepartmentController implements the CRUD actions for Department model.
 */
class DepartmentController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'rules' => [
                [

                    'allow' => true,
                    'roles' => ['@'],
                    'matchCallback' => function ($rule, $action) {
                // $module                 = Yii::$app->controller->module->id;
                $action = Yii::$app->controller->action->id;
                $controller = Yii::$app->controller->id;
                $route = "$controller/$action";
                $post = Yii::$app->request->post();
                if (strpos($route, 'validate') || \Yii::$app->user->can($route)) {
                    return true;
                } else {
                    return true;
                }
            }
                ],
            ],
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
            } else {
                $this->layout = 'admin';
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Lists all Department models.
     * @return mixed
     */
    public function actionIndex() {
        //return 'test';
        $searchModel = new DepartmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Department model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Department model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Department();
        $model->created_by = Yii::$app->user->id;
        $model->created_on = date("Y-m-d H:i:s");

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return true;
            } else {
                return false;
            }
        }

        return $this->renderAjax('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Department model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model->updated_by = Yii::$app->user->id;
        $model->updated_on = date("Y-m-d H:i:s");

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return true;
            } else {
                return false;
            }
        }

        return $this->renderAjax('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Department model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionValidate() {

        if ($_GET['id']) {
            $model = $this->findModel($_GET['id']);
            //$model->scenario = 'update';
        } else {
            $model = new Department();
            //$model->scenario = 'create';
        }

        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    /**
     * Finds the Department model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Department the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Department::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionReport() {
//        $searchModel = new DepartmentSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//
//        return $this->render('report', [
//                    //'searchModel' => $searchModel,
//                    'dataProvider' => $dataProvider,
//        ]);
        $searchModel = new \app\models\SalesItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //$dataProvider = \app\models\Sales::find()->all();
        return $this->render('report', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPrintReport() {
        ini_set('memory_limit', '-1');
        set_time_limit(1000);
        $searchModel = new \app\models\SalesItemSearch();
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

        $dataProvider = $searchModel->printSearch(Yii::$app->request->queryParams);
        $dataProvider->pagination = false;
        //Print
        if (isset($_GET['type']) && $_GET['type'] == "print") {
            return $this->renderPartial('print_test_sale_report', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        } 
    }

}
