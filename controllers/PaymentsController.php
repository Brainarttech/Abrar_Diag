<?php

namespace app\controllers;

use app\models\Sales;
use Yii;
use app\models\Payments;
use app\models\PaymentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * PaymentsController implements the CRUD actions for Payments model.
 */
class PaymentsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
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
     * Lists all Payments models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaymentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Payments model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = Payments::find()->where(['sale_id'=>$id])->all();
        $sale = Sales::findOne($id);
        return $this->renderAjax('view', [
            'model' => $model,
            'sale'=>$sale,
        ]);
    }

    public function actionLater($id)
    {

        $sale = Sales::findOne($id);
        $sale->depart_push_status = 2;
        $sale->updated_by = Yii::$app->user->id;
        $sale->updated_on = date("Y-m-d H:i:s");
        if($sale->save()){
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Creates a new Payments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $sale_id = $_GET['id'];
        $model = new Payments();

        $model->scenario = 'create';
        $saleModel = Sales::findOne($sale_id);
        $model->created_by = Yii::$app->user->id;
        $model->created_on = date("Y-m-d H:i:s");
        $model->sale_id = $sale_id;
        $model->payment_status = "1";
        $model->status = "1";
        $paymentLastInvoice = Payments::find()->select('reference_no')->orderBy(['id' => SORT_DESC])->one();
        $str = $paymentLastInvoice->reference_no;
        preg_match_all('!\d+!', $str, $matches);

        if($matches[0][0]==0)
        {
            $matches = 100;
        }else
        {
            $matches = $matches[0][0];
        }

        $invoice_no = 'ADC/LAT/'.($matches + 1);
        $model->reference_no = $invoice_no;
        if ($model->load(Yii::$app->request->post())) {
            if($model->save())
            {
                $total = $saleModel->paid_amount + $model->amount;
                $saleModel->paid_amount = $total;
                if($total >= $saleModel->grand_total)
                {
                    $saleModel->payment_status = "1";
                }
                $saleModel->updated_by = Yii::$app->user->id;
                $saleModel->updated_on = date("Y-m-d H:i:s");
                $saleModel->save();
                $resp['status'] = true;
                $resp['id'] = $saleModel->id;

                return json_encode($resp);

            }
            else
            {
                $resp['status'] = false;
                $resp['id'] = $saleModel->id;

                return json_encode($resp);

            }
        }
        return $this->renderAjax('create', [
            'model' => $model,
            'sale'=>$saleModel,
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
            $model = new Payments();
            $sale_id = $_GET['sale_id'];
            $model->scenario = 'create';
            $model->sale_id = $sale_id;
        }

        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    /**
     * Updates an existing Payments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
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

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Payments model.
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
     * Finds the Payments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Payments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Payments::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
