<?php

namespace app\controllers;
use app\models\AccountGroup;
use app\models\ChartsOfAccounts;
use yii\helpers\Json;
use yii\helpers\Response;
use yii\widgets\ActiveForm;
use Yii;

class AccountsController extends \yii\web\Controller
{
	public function beforeAction($action) {
		$this->enableCsrfValidation = false;
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
	
    public function actionIndex()
    {
        $model = new AccountGroup(); // this is your model
        //$model->account_name = 'Cash and Bank';
		$tableSchema = $model->getTableSchema();
		$column = $tableSchema->columns['accounts_type']; // the column that has enum values
		$dropDownOptions = [];
		if (is_array($column->enumValues) && count($column->enumValues) > 0) {
		    foreach ($column->enumValues as $enumValue) {
                $dropDownOptions[$enumValue] = array(\yii\helpers\Inflector::humanize($enumValue),$model->accountsTypeCount($enumValue));
		    }
		}

        return $this->render('index', array('dropDownOptions'=>$dropDownOptions,));
    }

    public function actionGetData()
    {
        $model = new AccountGroup();
        //$data = $model->find()->where(['accounts_type' => 'Assets'])->one();
        $data = $model->find()->where(['id' => '2'])->one();
        $orders = $data->chartsOfAccounts;
        echo "<pre>";
        echo print_r($orders);
        echo "</pre>";
    }

    public function actionAccountDetail()
    {
        $model = new AccountGroup();

        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $response = $model->accountsTypeData($data['accounttype']);
            return Json::encode($response);
        }
        return 'error';
    }

    public function actionUpdate($id)
    {
        $model = ChartsOfAccounts::findOne($id);
        $model->updated_by = Yii::$app->user->id;
        $model->updated_on = date("Y-m-d H:i:s");
        $model->scenario = "update";
        //return $model->isAttributeChanged('account_code');

        /*echo "<pre>";
        echo print_r($model);
        echo "</pre>";*/
        $request = \Yii::$app->getRequest();

        if ($request->isPost && $model->load($request->post())) {
            if($model->save())
            {
                return true;
                //return $this->renderAjax('create', ['model' => $model,]);
            }
            else
            {
                return false;
            }
        }

        return $this->renderAjax('_form_update', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new ChartsOfAccounts();
        /*echo "<pre>";
        echo print_r($account_group_data[0]);
        echo "</pre>";*/
        $model->created_by = Yii::$app->user->id;
        $model->created_on = date("Y-m-d H:i:s");
        $model->scenario = "create";
        $request = \Yii::$app->getRequest();

        if ($request->isPost && $model->load($request->post())) {
            if($model->save())
            {
                return true;
                //return $this->renderAjax('create', ['model' => $model,]);
            }
            else
            {
                return false;
            }
        }
        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    public function actionValidate()
    {
        if($_GET['id'])
        {
            $model = ChartsOfAccounts::findOne($_GET['id']);
            $model->scenario = 'update';
        }
        else
        {
            $model = new ChartsOfAccounts();
            $model->scenario = 'create';
        }
        //$model->scenario = "update";
        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            return Json::encode(ActiveForm::validate($model));
        }
    }

    public static function enumItem($model,$attribute)
    {
        $attr=$attribute;
        CHtml::resolveName($model,$attr);
        preg_match('/\((.*)\)/',$model->tableSchema->columns[$attr]->dbType,$matches);
        foreach(explode(',', $matches[1]) as $value)
        {
                $value=str_replace("'",null,$value);
                $values[$value]=Yii::t('enumItem',$value);
        }
        
        return $values;
    }

    public function actionTest()
    {
        return $this->render('test');
    }

}
