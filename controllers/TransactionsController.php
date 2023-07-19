<?php

namespace app\controllers;

use Yii;
use app\models\AccountTransactions;
use app\models\AccountTransactionsSearch;
use app\models\AccountGroup;
use app\models\ChartsOfAccounts;
use yii\helpers\Json;
use yii\helpers\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

class TransactionsController extends \yii\web\Controller
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
    	$searchModel = new AccountTransactionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //return $this->render('index');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = AccountTransactions::findOne($id);
        $model->updated_by = Yii::$app->user->id;
        $model->updated_on = date("Y-m-d H:i:s");
        if($model->credit === 0){ // for expense
            $value = 1;
            $arr = ChartsOfAccounts::find()->select(['charts_of_accounts.id AS id', 'charts_of_accounts.account_name AS name'])->joinWith(['accountGroup'])->where(['in', 'account_group.accounts_type', ['Expense']])->asArray()->all();
            $data2['Expense'] = ArrayHelper::map($arr, 'id', 'name');
        }
        if($model->debit === 0){ //for income
            $value = 2;
            $arr = ChartsOfAccounts::find()->select(['charts_of_accounts.id AS id', 'charts_of_accounts.account_name AS name'])->joinWith(['accountGroup'])->where(['in', 'account_group.accounts_type', ['Income']])->asArray()->all();
            $data2['Income'] = ArrayHelper::map($arr, 'id', 'name');//['output' => '', 'selected' => '']
            //$data2['selected'] =$model->account_used;
            //$temp = ['output' => $data2, 'selected' => $model->account_used];
            //$temp['output'] = $data2;
            //$temp['selected'] = $model->account_used;
        }
        //$model->scenario = "update";
        $request = \Yii::$app->getRequest();

        if ($request->isPost && $model->load($request->post())) {
            if($model->save())
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        $data = $this->CustomArrayHelper(AccountGroup::find()->joinWith(['chartsOfAccounts'])->where(['in', 'account_group.account_name', ['Business Owner Contribution','Money in Transit','Cash and Bank']])->asArray()->all());

        return $this->renderAjax('_form_update', [
            'model' => $model,
            'data' => $data,
            'data2' => $data2,
            'value'=> $value,
        ]);
    }

    public function actionCreate()
    {
        $model = new AccountTransactions();
        $model->created_by = Yii::$app->user->id;
        $model->created_on = date("Y-m-d H:i:s");
        //$model->subcat = [['id'=>'1','acc'=>'With Draw'],['id'=>'2','acc'=>'With Draw 2']];
        //$model->scenario = "create";
        $request = \Yii::$app->getRequest();

        if ($request->isPost && $model->load($request->post())) {
            //$model->account_used = $_POST['subcat'];
            if($model->save())
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        $data = $this->CustomArrayHelper(\app\models\AccountGroup::find()->joinWith(['chartsOfAccounts'])->asArray()->all());
        return $this->renderAjax('create', [
            'model' => $model,
            'data' => $data,
        ]);
    }

    public function CustomArrayHelper($arr)
    {
        $returnArr = [];
        foreach($arr as $key => $value)
        {
            if($value['chartsOfAccounts']){
                $returnArr[$value['account_name']] = ArrayHelper::map($value['chartsOfAccounts'], 'id', 'account_name');
            }
            
        }
        return $returnArr;
    }

    public function actionValidate()
    {
        /*if($_GET['id'])
        {
            $model = AccountTransactions::findOne($_GET['id']);
            $model->scenario = 'update';
        }
        else
        {
            $model = new AccountTransactions();
            $model->scenario = 'create';
        }*/
        $model = new AccountTransactions();
        //$model->scenario = "update";
        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            return Json::encode(ActiveForm::validate($model));
        }
    }

    public function actionIncomeAccount()
    {
        $model = new AccountTransactions();
        $model->created_by = Yii::$app->user->id;
        $model->debit = 0;
        $request = \Yii::$app->getRequest();

        if ($request->isPost && $model->load($request->post())) {
            /*if($model->actype == 1){
                $model->credit = 0;
            }
            else if($model->actype == 2){
                $model->credit = $model->debit;
                $model->debit = 0;
            }*/
            if($model->save())
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        $data = $this->CustomArrayHelper(AccountGroup::find()->joinWith(['chartsOfAccounts'])->where(['in', 'account_group.account_name', ['Business Owner Contribution','Money in Transit','Cash and Bank']])->asArray()->all());
        /*echo "<pre>";
        echo print_r($data);
        echo "</pre>";*/
        $arr = ChartsOfAccounts::find()->select(['charts_of_accounts.id AS id', 'charts_of_accounts.account_name AS name'])->joinWith(['accountGroup'])->where(['in', 'account_group.accounts_type', ['Income']])->asArray()->all();
        $data2['Income'] = ArrayHelper::map($arr, 'id', 'name');
        /*echo "<pre>";
        echo print_r($data2);
        echo "</pre>";*/
        return $this->renderAjax('create', [
            'model' => $model,
            'data' => $data,
            'data2' => $data2,
            'value'=> 2,
        ]);
    }

    public function actionExpenseAccount()
    {
        $model = new AccountTransactions();
        $model->created_by = Yii::$app->user->id;
        $model->credit = 0;
        //$model->created_on = date("Y-m-d H:i:s");
        //$model->scenario = "create";
        $request = \Yii::$app->getRequest();

        if ($request->isPost && $model->load($request->post())) {
            //$model->created_by = 0;
            //$model->account_used = $_POST['subcat'];
            //echo "asdhiashdhkaj";
            //echo "<pre>";
            //echo print_r($model->actype);
            //echo "</pre>";
            /*if($model->actype == 1){
                $model->debit = 0;
            }
            else if($model->actype == 2){
                $model->debit = $model->credit;
                $model->credit = 0;
            }*/
            //echo $_POST['depdrop_parents'];
            if($model->save())
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        $data = $this->CustomArrayHelper(AccountGroup::find()->joinWith(['chartsOfAccounts'])->where(['in', 'account_group.account_name', ['Business Owner Contribution','Money in Transit','Cash and Bank']])->asArray()->all());
        $arr = ChartsOfAccounts::find()->select(['charts_of_accounts.id AS id', 'charts_of_accounts.account_name AS name'])->joinWith(['accountGroup'])->where(['in', 'account_group.accounts_type', ['Expense']])->asArray()->all();
        $data2['Expense'] = ArrayHelper::map($arr, 'id', 'name');
        return $this->renderAjax('create', [
            'model' => $model,
            'data' => $data,
            'data2' => $data2,
            'value'=> 1,
        ]);
    }

    public function actionSubcat() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                if($cat_id == 1){
                    $out['Expense'] = ChartsOfAccounts::find()->select(['charts_of_accounts.id AS id', 'charts_of_accounts.account_name AS name'])->joinWith(['accountGroup'])->where(['in', 'account_group.accounts_type', ['Expense']])->asArray()->all();
                    //$out = [
                        //['id'=>'0', 'name'=>'Account 1'],
                        //['id'=>'1', 'name'=>'Account 2']
                    //];
                }
                else if($cat_id == 2){
                    $out['Income'] = ChartsOfAccounts::find()->select(['charts_of_accounts.id AS id', 'charts_of_accounts.account_name AS name'])->joinWith(['accountGroup'])->where(['in', 'account_group.accounts_type', ['Income']])->asArray()->all();
                    //$out = [
                        //['id'=>'2', 'name'=>'Acc1'],
                        //['id'=>'3', 'name'=>'Acc2']
                    //];
                }
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>$out, 'selected'=>'']);
        /*$out['Income'] = ChartsOfAccounts::find()->select(['charts_of_accounts.id AS id', 'charts_of_accounts.account_name AS name'])->joinWith(['accountGroup'])->where(['in', 'account_group.accounts_type', ['Income']])->asArray()->all();
        echo Json::encode(['output'=>$out, 'selected'=>'']);*/
    }

    public function ExAccount() {
        //$out = [['id'=>'0', 'name'=>'Account 1'],['id'=>'1', 'name'=>'Account 2']];
        //return [['id'=>'0', 'name'=>'Account 1'],['id'=>'1', 'name'=>'Account 2']];
        //echo "Expense Account";
        $data['Income'] = ChartsOfAccounts::find()->select(['charts_of_accounts.id AS id', 'charts_of_accounts.account_name AS name'])->joinWith(['accountGroup'])->where(['in', 'account_group.accounts_type', ['Expense']])->asArray()->all();
        //$data = ArrayHelper::map($data, 'id', 'account_name');
        //$data = Json::encode($data);
        return Json::encode(['output'=>$data, 'selected'=>'']);
        //$data = [['id'=>'0', 'name'=>'Account 1'],['id'=>'1', 'name'=>'Account 2']];
        /*echo "<pre>";
        echo print_r($out);
        echo "</pre>";


        echo "<pre>";
        echo print_r($data);
        echo "</pre>";*/
    }

    public function actionLedger() {
        /*//return 'ledger';
        $a = 1;
        echo ++$a;
        echo "<br>";
        //return $a;
        $b = &$a;
        echo $a++;
        echo "<br>";
        echo $b;
        echo "<br>";*/
        $searchModel = new AccountTransactionsSearch();
        $dataProvider = $searchModel->customsearch(Yii::$app->request->queryParams);
        $dataProvider->pagination  = false;
        //$dataProvider->pagination = ['pageSize' => $dataProvider->getTotalCount()];
        //$grid_columns=AccountTransactionsSearch::pageTotal($dataProvider->models,'debit');
        //return $this->render('index');
        return $this->render('ledger', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            //'grid_columns' => $grid_columns,
        ]);
        
        //$searchModel = new AccountTransactionsSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //return $this->render('index');

        /*echo "<pre>";
        echo print_r($dataProvider);
        echo "</pre>";*/

        //return $this->render('ledger', [
            //'searchModel' => $searchModel,
            //'dataProvider' => $dataProvider,
        //]);
    }

}

    //$result = \yii\helpers\ArrayHelper::filter($var, ['0.chartsOfAccounts.0']);
    //$result2 = ArrayHelper::map($result, 'id', 'account_name');
    /*$result = ArrayHelper::getColumn($var, 'account_name');
    $result2 = ArrayHelper::map($var[1]['chartsOfAccounts'], 'id', 'account_name');*/
    //$temp = YourArrayHelper($var);

    /*$result = ArrayHelper::index($cars, 'account_name');
    $var = \app\models\ChartsOfAccounts::find()->joinWith(['accountGroup'])->asArray()->all();ArrayHelper::map(\app\models\ChartsOfAccounts::find()->joinWith(['accountGroup'])->all(), 'id', 'account_name');
    echo "<pre>";
    echo print_r($var);
    echo "</pre>";
    echo "<pre>";
    echo print_r($temp);
    echo "</pre>";
    ArrayHelper::map(\app\models\ChartsOfAccounts::find()->all(), 'id', 'account_name')*/
