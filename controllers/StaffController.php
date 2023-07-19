<?php

namespace app\controllers;

use Yii;
use app\models\Staff;
use app\models\StaffSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * StaffController implements the CRUD actions for Staff model.
 */
class StaffController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'rules' => [
                [

                    'allow' => true,
                    'roles' => ['@'],
                    'matchCallback' => function ($rule, $action) {

                        // $module                 = Yii::$app->controller->module->id;
                        $action                 = Yii::$app->controller->action->id;
                        $controller         = Yii::$app->controller->id;
                        $route                     = "$controller/$action";
                        $post = Yii::$app->request->post();
                        if(strpos($route,'validate') || \Yii::$app->user->can($route))
                        {
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
            if(Yii::$app->user->identity->role=="Manager"){
                $this->layout = 'main-hrm';
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
     * Lists all Staff models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StaffSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Staff model.
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
     * Creates a new Staff model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Staff();
        $model->created_by = Yii::$app->user->id;
        $model->created_on = date("Y-m-d H:i:s");

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return true;
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Staff model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return true;
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
            $model = new Staff();
            //$model->scenario = 'create';
        }

        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    /**
     * Deletes an existing Staff model.
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

    /**
     * Finds the Staff model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Staff the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Staff::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
