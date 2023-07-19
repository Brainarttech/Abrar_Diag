<?php

namespace app\modules\rbac\controllers;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\UserSearch;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use app\modules\rbac\models\AuthAssignment;
use app\modules\rbac\models\AuthItem;
use app\modules\rbac\models\AuthItemChild;

/**
 * Default controller for the `rbac` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public function behaviors()
    {
		$behaviors['access'] = [
            'class' => AccessControl::className(),
            'only' => ['index','hi'],
            'rules' => [
                [
                    'allow' => true,
                    'actions' => ['index','hi'],
                    'roles' => ['@'],
                    'matchCallback' => function ($rule, $action) {
                        return \Yii::$app->user->can(Yii::$app->controller->id.'/'.Yii::$app->controller->action->id);
                        //echo Yii::$app->controller->id.'/'.Yii::$app->controller->action->id;
						//die();
                    }
                ],
            ],
        ];

        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'delete' => ['POST'],
            ]
        ];


        return $behaviors;
    }


    public function beforeAction($action) {
		$this->enableCsrfValidation = false;
		return parent::beforeAction($action);
 	}




   public function actionIndex(){
		//return 'asd';
        //error_reporting(0);
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        $users = User::findAll(1);
        $authItems = AuthItem::find()->asArray()->all();
        $roles = AuthItem::find()->where("type = 1")->asArray()->all();
        $operations = AuthItem::find()->where("type = 2")->asArray()->all();
        // Remove Assigment User
        if(!empty($_GET['assign_user_remove'])){
            $item_name = urldecode($_GET['assign_user_remove']);
            if (($model = AuthAssignment::find()->where("user_id=$_GET[assign_user_id] and item_name='$item_name'")->one()) !== null) {
                $model->delete();
                return $this->redirect(['index', 'assign_user_id' => $_GET[assign_user_id]]);
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }
        // Add Assigment User
        if(!empty($_POST['auth_item'])){
            $model = new AuthAssignment;
            $model->item_name = $_POST['auth_item'];
            $model->user_id =  $_GET[assign_user_id];

            $model->save();
            //var_dump($model->errors);
            if(count($model->errors)>0){
                return $this->render('index', [
                    'users' => $users,
                    'authItems' => $authItems,
                    'operations' => $operations,
                    'roles' => $roles,
                    'dataProvider' => $dataProvider,
                    'assigment_error' => $model->errors,

                ]);
            }else
                return $this->redirect(['index', 'assign_user_id' => $_GET['assign_user_id']]);
        }
        // Remove Parent Child of Role
        if(!empty($_GET['parent']) && !empty($_GET['child']) && !empty($_GET['role_child_del'])){
            $authItemChildObj  = AuthItemChild::find()->where("parent='".urldecode($_GET['parent'])."' and child='".urldecode($_GET['child'])."'")->one();
            $authItemChildObj->delete();
            //var_dump($authItemChildObj->errors);
            return $this->redirect(['index','role_id'=>$_GET['role_id']]);

        }
        // Remove Parent Child of Opration
        if(!empty($_GET['parent']) && !empty($_GET['child']) && !empty($_GET['operation_child_del'])){
            $authItemChildObj  = AuthItemChild::find()->where("parent='".urldecode($_GET['parent'])."' and child='".urldecode($_GET['child'])."'")->one();

            $authItemChildObj->delete();
            return $this->redirect(['index','operation_id'=>$_GET['operation_id']]);

        }
        // Add Parent Child
        if(!empty($_GET['parent']) && !empty($_GET['child']) && empty($_GET['remove_child']) && empty($_GET['operation_child_del'])){
            $authItemChildObj  = new AuthItemChild;

            $authItemChildObj->parent = urldecode($_GET['parent']);
            $authItemChildObj->child = urldecode($_GET['child']);
            $authItemChildObj->save();
            echo "REVOKE";
            exit;
            //return $this->redirect(['index']);
        }
        // Remove Parent Child
        if(!empty($_GET['parent']) && !empty($_GET['child']) && !empty($_GET['remove_child'])){
            $authItemChildObj  = AuthItemChild::find()->where("parent='".urldecode($_GET['parent'])."' and child='".urldecode($_GET['child'])."'")->one();

            $authItemChildObj->delete();

            echo "ASSIGN";
            exit;
            //return $this->redirect(['index']);

        }

        // Add Role
        if(!empty($_POST['role_name']) && !empty($_POST['role_description'])){
            $authItemObj = new AuthItem;
            $authItemObj->name = $_POST['role_name'];
            $authItemObj->description = $_POST['role_description'];
            $authItemObj->data = $_POST['role_data'];
            $authItemObj->type = 1;
            $authItemObj->save();
            ///var_dump($authItemObj->errors);
            if(count($authItemObj->errors)>0){
                return $this->render('index', [
                    'users' => $users,
                    'authItems' => $authItems,
                    'operations' => $operations,
                    'roles' => $roles,
                    'dataProvider' => $dataProvider,
                    'role_add_error' => $authItemObj->errors,

                ]);
            }else
                return $this->redirect(['index']);
        }
        // Add Role child
        if(!empty($_POST['role_child_auth_item'])){
            $authItemChildObj  = new AuthItemChild;

            $authItemChildObj->parent = urldecode($_GET['role_id']);
            $authItemChildObj->child = urldecode($_POST['role_child_auth_item']);
            $authItemChildObj->save();
            ///var_dump($authItemChildObj->errors);
            if(count($authItemChildObj->errors)>0){
                return $this->render('index', [
                    'users' => $users,
                    'authItems' => $authItems,
                    'operations' => $operations,
                    'roles' => $roles,
                    'dataProvider' => $dataProvider,
                    'roleChild_assigment_error' => $authItemChildObj->errors,

                ]);
            }else
                return $this->redirect(['index','role_id'=>$_GET['role_id']]);
        }
        // Update Role
        if(!empty($_POST['edit_role_description'])){
            $authItemdObj  = AuthItem::find()->where("name='".$_GET['role_id']."' and type='2'")->one();
            if(!is_null($authItemdObj)){
                $authItemdObj->description = $_POST['edit_role_description'];
                $authItemdObj->save();
                ///var_dump($authItemChildObj->errors);
                if(count($authItemdObj->errors)>0){
                    return $this->render('index', [
                        'users' => $users,
                        'authItems' => $authItems,
                        'operations' => $operations,
                        'roles' => $roles,
                        'dataProvider' => $dataProvider,
                        'roleChild_assigment_error' => $authItemdObj->errors,

                    ]);
                }else
                    return $this->redirect(['index','role_id'=>$_GET['role_id']]);
            }
        }
        // Update Operation
        if(!empty($_POST['edit_operation_description'])){
            $authItemdObj  = AuthItem::find()->where("name='".$_GET['operation_id']."' and type='0'")->one();
            if(!is_null($authItemdObj)){
                $authItemdObj->description = $_POST['edit_operation_description'];
                $authItemdObj->save();
                ///var_dump($authItemChildObj->errors);
                if(count($authItemdObj->errors)>0){
                    return $this->render('index', [
                        'users' => $users,
                        'authItems' => $authItems,
                        'operations' => $operations,
                        'roles' => $roles,
                        'dataProvider' => $dataProvider,
                        'operationChild_assigment_error' => $authItemdObj->errors,

                    ]);
                }else
                    return $this->redirect(['index','operation_id'=>$_GET['operation_id']]);
            }
        }
        // Add operation
        if(!empty($_POST['operation_name']) && !empty($_POST['operation_description'])){
            $authItemObj = new AuthItem;
            $authItemObj->name = $_POST['operation_name'];
            $authItemObj->description = $_POST['operation_description'];
            $authItemObj->data = $_POST['operation_data'];
            $authItemObj->type = 0;
            $authItemObj->save();
            ///var_dump($authItemObj->errors);
            if(count($authItemObj->errors)>0){
                return $this->render('index', [
                    'users' => $users,
                    'authItems' => $authItems,
                    'operations' => $operations,
                    'roles' => $roles,
                    'dataProvider' => $dataProvider,
                    'operation_add_error' => $authItemObj->errors,

                ]);
            }else
                return $this->redirect(['index']);
        }
        // Add operation child
        if(!empty($_POST['operation_child_auth_item'])){
            $authItemChildObj  = new AuthItemChild;

            $authItemChildObj->parent = urldecode($_GET['operation_id']);
            $authItemChildObj->child = urldecode($_POST['operation_child_auth_item']);
            $authItemChildObj->save();
            ///var_dump($authItemChildObj->errors);
            if(count($authItemChildObj->errors)>0){
                return $this->render('index', [
                    'users' => $users,
                    'authItems' => $authItems,
                    'operations' => $operations,
                    'roles' => $roles,
                    'dataProvider' => $dataProvider,
                    'operationChild_assigment_error' => $authItemChildObj->errors,

                ]);
            }else
                return $this->redirect(['index','operation_id'=>$_GET['operation_id']]);
        }
        if(!empty($_GET['operation_del'])){
            $authItemObj  = AuthItem::find()->where("name='".urldecode($_GET['operation_del'])."'")->one();

            $authItemObj->delete();
            return $this->redirect(['index']);
        }
        if(!empty($_GET['role_del'])){
            $authItemObj  = AuthItem::find()->where("name='".urldecode($_GET['role_del'])."'")->one();

            $authItemObj->delete();
            return $this->redirect(['index']);
        }
        return $this->render('index', [
            'users' => $users,
            'authItems' => $authItems,
            'operations' => $operations,
            'roles' => $roles,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);

    }
	
	public function actionHi()
    {
		return 'Hi';
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
            $model = new User();
             //$model->scenario = 'create';
        }
        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }
}
