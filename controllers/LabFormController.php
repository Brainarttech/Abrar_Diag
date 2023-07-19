<?php

namespace app\controllers;

use Yii;
use app\models\LabForm;
use yii\bootstrap\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * LabFormController implements the CRUD actions for LabForm model.
 */
class LabFormController extends Controller {

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
     * Lists all LabForm models.
     * @return mixed
     */
    public function actionIndex() {
//		$lab_forms = LabForm::find()->all();
//                foreach($lab_forms as $form)
//                {
//                    $item = new \app\models\LabFormItemName;
//                    $item->lab_form_id = $form->id;
//                    $item->item_name_id = $form->item_name_id;
//                    $item->save();
//                }
        $dataProvider = new ActiveDataProvider([
            'query' => LabForm::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LabForm model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionRenderView($id) {
        //return $this->renderAjax('render_view', [
        return $this->renderAjax('render_view', [
                    'model' => $this->findModel($id),
        ]);
    }
    public function actionRenderEdit($id) {
        //return $this->renderAjax('render_view', [
        //$lab_form_submit = \app\models\LabFormSubmit::find()->where(['sale_item_id'=>$id])->one();
         $id = explode(',', $id);
        
        return $this->renderAjax('render_edit', [
                    'model' => $this->findModel($id[1]),
                    'sale_item_id' => $id[0],
                    
        ]);
    }

    /**
     * Creates a new LabForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {

        $model = new LabForm();
        $model->created_by = Yii::$app->user->id;
        $model->created_on = date("Y-m-d H:i:s");
        
        if ($model->load(Yii::$app->request->post())) {
            $items = Yii::$app->request->post()['LabForm']['item_names'];
           
            if ($model->save(false)) {
                foreach ($items as $item) {
                    $lab_form_item = new \app\models\LabFormItemName;
                    $lab_form_item->lab_form_id = $model->id;
                    $lab_form_item->item_name_id = $item;
                    $lab_form_item->save(false);
                }
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
     * Updates an existing LabForm model.
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
            $items = Yii::$app->request->post()['LabForm']['item_names'];
           \app\models\LabFormItemName::deleteAll(['lab_form_id' => $model->id]);
            if ($model->save(false)) {
                foreach ($items as $item) {
                    $lab_form_item = new \app\models\LabFormItemName;
                    $lab_form_item->lab_form_id = $model->id;
                    $lab_form_item->item_name_id = $item;
                    $lab_form_item->save(false);
                }
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
     * Deletes an existing LabForm model.
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
     * Finds the LabForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LabForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = LabForm::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionValidate() {

        if ($_GET['id']) {
            $model = $this->findModel($_GET['id']);
            //$model->scenario = 'update';
        } else {
            $model = new LabForm();
            //$model->scenario = 'create';
        }

        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

}
