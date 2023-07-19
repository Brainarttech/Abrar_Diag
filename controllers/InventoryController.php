<?php

namespace app\controllers;

use Yii;
use app\models\Inventory;
use app\models\InventorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InventoryController implements the CRUD actions for Inventory model.
 */
class InventoryController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function beforeAction($action) {

        if (parent::beforeAction($action)) {
            // change layout for error action
            if (Yii::$app->user->identity->role == "Manager") {
                $this->layout = 'manager';
            } else {
                $this->layout = 'inventory';
            }
            return true;
        } else {
            return false;
        }
    }

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

    /**
     * Lists all Inventory models.
     * @return mixed
     */
    public function actionIndex() {

        $searchModel = new InventorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Inventory model.
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
     * Creates a new Inventory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {

        $model = new Inventory();


        return $this->render('purchase', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Inventory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Inventory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Inventory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Inventory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Inventory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionAdd() {
        $purchase = new \app\models\Purchase;
        $purchase->supplier_id = Yii::$app->request->post()['supplier_id'];
        $purchase->invoice_number = Yii::$app->request->post()['invoice_number'];
        $purchase->due_date = Yii::$app->request->post()['due_date'];
        $purchase->warehouse_id = Yii::$app->request->post()['warehouse_id'];
        $purchase->hospital_id = Yii::$app->request->post()['hospital_id'];
        $purchase->note = Yii::$app->request->post()['note'];
        $purchase->attachment = Yii::$app->request->post()['attachment'];
        $purchase->status = Yii::$app->request->post()['status'];
        $purchase->order_discount = Yii::$app->request->post()['order_discount'];
        $purchase->tax = Yii::$app->request->post()['tax'];
        $purchase->total = Yii::$app->request->post()['payable'];
        if ($purchase->save(false)) {
            $product_ids = Yii::$app->request->post()['product_ids'];
            $i = 0;
            foreach ($product_ids as $product_id) {
                $inventory = new Inventory();
                $inventory->created_by = Yii::$app->user->id;
                $inventory->created_on = date("Y-m-d H:i:s");
                $inventory->purchase_id = $purchase->id;
                $inventory->product_id  = $product_id;
                $inventory->variant_id = Yii::$app->request->post()['variant_ids'][$i];
                $inventory->quantity = Yii::$app->request->post()['quantity'][$i];
                $inventory->cost_price = Yii::$app->request->post()['costs'][$i];
                $inventory->discount = Yii::$app->request->post()['discounts'][$i];
                $inventory->expiry_date = Yii::$app->request->post()['expiry_dates'][$i];
                $inventory->total = Yii::$app->request->post()['totals'][$i] - Yii::$app->request->post()['discounts'][$i];
                $inventory->grand_total = Yii::$app->request->post()['totals'][$i];
                $inventory->unit_id = Yii::$app->request->post()['units'][$i];
                $inventory->warehouse_id = Yii::$app->request->post()['warehouse_id'];
                $inventory->save(false);
                $i++;
            }
            return $this->redirect(['index']);
        } else {
            return 2;
        }


        print_r(Yii::$app->request->post());
        return false;
    }

}
