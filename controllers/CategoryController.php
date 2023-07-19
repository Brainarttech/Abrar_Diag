<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use slatiusa\nestable\Nestable;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
use yii\helpers\Json;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'nodeMove' => [
                'class' => 'slatiusa\nestable\NodeMoveAction',
                'modelName' => Category::className(),
            ],
        ];
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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Category();
        $model->created_by = Yii::$app->user->id;
        $model->created_on = date("Y-m-d H:i:s");
        if (Yii::$app->request->post()) {
            $category = Category::findOne(['tree', Yii::$app->request->post('Category')['tree']]);
            $model->name = Yii::$app->request->post('Category')['name'];
            $model->status = Yii::$app->request->post('Category')['status'];
            if (empty($category)) {
                $model->makeRoot();
            } else {
                $model->appendTo($category);
            }
            $model->save();
            return true;
        }

        return $this->renderAjax('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model->updated_by = Yii::$app->user->id;
        $model->updated_on = date("Y-m-d H:i:s");
        if (Yii::$app->request->post()) {
            $category = Category::findOne(['tree', Yii::$app->request->post('Category')['tree']]);
            $model->name = Yii::$app->request->post('Category')['name'];
            $model->status = Yii::$app->request->post('Category')['status'];
            if (empty($category)) {
                $model->makeRoot();
            } else {
                $model->appendTo($category);
            }
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
     * Deletes an existing Category model.
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
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionValidate() {

        if ($_GET['id']) {
            $model = $this->findModel($_GET['id']);
            //$model->scenario = 'update';
        } else {
            $model = new Category();
            //$model->scenario = 'create';
        }

        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    public function actionGetSubCategory() {
        $category = Category::findOne(['id' => $_POST['depdrop_parents'][0]]); ///->andWhere(['id' => $_POST['depdrop_parents'][0]]);
        $out = $category->children(1)->select(['id', 'name'])->all();
        return Json::encode(['output' => $out]);
    }

}
