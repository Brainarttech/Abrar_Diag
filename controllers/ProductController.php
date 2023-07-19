<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use app\helpers\datetime;
use app\helpers\MorrisBarChart;
use yii\widgets\ActiveForm;
use yii\helpers\Json;
use yii\db\Query;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller {

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
                $this->layout = 'manager';
            } else {
                $this->layout = 'inventory';
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex() {

        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {

        $model = new Product();
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
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $variants = \app\models\ProductVariant::find()->where(['product_id' => $model->id])->all();
        
       /*  $warehouses = \app\models\Warehouse::find()->where(['product_id' => $model->id])->all(); */
        $warehouse = null;
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
                    'warehouses' => $warehouses,
        ]);
//        return $this->renderAjax('update', [
//                    'model' => $model,
//        ]);
    }

    /**
     * Deletes an existing Product model.
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
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionValidate() {

        if ($_GET['id']) {
            $model = $this->findModel($_GET['id']);
            //$model->scenario = 'update';
        } else {
            $model = new Product();
            //$model->scenario = 'create';
        }

        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    public function actionProducts() {
        $model = Product::find()->all();
        return $this->render('products', ['model' => $model]);
    }

    public function actionCreateWithCategory() {

        $model = new Product();

        $model->created_by = Yii::$app->user->id;
        $model->created_on = date("Y-m-d H:i:s");
        if ($model->load(Yii::$app->request->post())) {
            $model->brand_id = Yii::$app->request->post('Product')['brand_id'];
            if (Yii::$app->request->post('root_id') != '') {
                $model->category_id = Yii::$app->request->post('root_id');
                if (Yii::$app->request->post('sub_category_id') != '') {
                    $model->category_id = Yii::$app->request->post('sub_category_id');
                    if (Yii::$app->request->post('category_id') != '') {
                        $model->category_id = Yii::$app->request->post('category_id');
                    }
                }
            }
            if ($model->validate()) {

                $model->save();
            } else {
                $errors = $model->errors;
                print_r($errors);
                return 1;
            }
//            foreach (Yii::$app->request->post()['variant_id'] as $variant) {
//                $variants = new \app\models\ProductVariant;
//                $variants->product_id = $model->id;
//                $variants->variant_id = $variant;
//                $variants->save();
//            }
            foreach (Yii::$app->request->post()['variant_ids'] as $key => $variant) {
                $variants = new \app\models\ProductVariant;
                $variants->product_id = $model->id;
                $variants->variant_id = $variant;
                $variants->code = Yii::$app->request->post()['variant_codes'][$key];
                $variants->save(false);
                /* $warehouse = new \app\models\Warehouse;
                $warehouse->product_id = $model->id;
                $warehouse->variant_id = $variant;
                $warehouse->in = Yii::$app->request->post()['quantity'][$key];
                $warehouse->warehouse_id = Yii::$app->request->post()['warehouse_ids'][$key + 1];
                $warehouse->save(false); */
            }
            return $this->redirect(['index']);
        }
        return $this->render('create_1', [
                    'model' => $model,
        ]);
    }

}
