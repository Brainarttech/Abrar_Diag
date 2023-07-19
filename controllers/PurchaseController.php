<?php

namespace app\controllers;

use Yii;
use app\models\Purchase;
use app\models\PurchaseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * PurchaseController implements the CRUD actions for Purchase model.
 */
class PurchaseController extends Controller {

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
     * Lists all Purchase models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new PurchaseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Purchase model.
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
     * Creates a new Purchase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Purchase();
        $model->created_by = Yii::$app->user->id;
        $model->created_on = date("Y-m-d H:i:s");
        $dataProvider = new Purchase();
        if ($model->load(Yii::$app->request->post())) {

            if ($model->save()) {
                return true;
            } else {
                return false;
            }
        }

        return $this->render('create', [
                    'model' => $model,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing Purchase model.
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
     * Deletes an existing Purchase model.
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
     * Finds the Purchase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Purchase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Purchase::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionValidate() {

        if ($_GET['id']) {
            $model = $this->findModel($_GET['id']);
            //$model->scenario = 'update';
        } else {
            $model = new Purchase();
            //$model->scenario = 'create';
        }

        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    public function actionUploadInvoice() {

        $model = new Purchase();

        if (!is_dir('uploads')) {
            FileHelper::createDirectory('uploads');
        }
        $imageFile = UploadedFile::getInstanceByName('file');
        $filePath = 'uploads/' . $imageFile->baseName . '.' . $imageFile->extension;
        $imageFile->saveAs($filePath);
        return $filePath;
    }

}
