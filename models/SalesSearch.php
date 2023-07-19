<?php

namespace app\models;

use DateTime;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sales;
use yii\db\Expression;

/**
 * SalesSearch represents the model behind the search form of `app\models\Sales`.
 */
class SalesSearch extends Sales {

    public $test;
    public $department;
    public $test_status;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'hospital_id', 'test', 'patient_id', 'depart_push_status', 'referred_doctor_id', 'extra_charges', 'total', 'discount', 'tax', 'grand_total', 'total_items', 'paid_amount', 'refund_charges', 'created_by', 'updated_by'], 'integer'],
            [['invoice_no', 'test', 'patient_id', 'department', 'discount_type', 'payment_status', 'notes', 'sale_status', 'status', 'created_on', 'updated_on'], 'safe'],
            [['created_on'], 'required', 'on' => 'report'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        set_time_limit(300);
//        if ($params['get'] == 'complete')
//            $query = Sales::find()->where(['sale_status' => '1'])->andWhere(['sale.status' => '1']);
//        else if ($params['get'] == 'partial-refund')
//            $query = Sales::find()->where(['sale_status' => '3'])->andWhere(['sale.status' => '1']);
//        else if ($params['get'] == 'fully-refund')
//            $query = Sales::find()->where(['sale_status' => '2'])->andWhere(['sale.status' => '1']);
//        else if ($params['get'] == 'all-paid')
//            $query = Sales::find()->where(['sale.payment_status' => '1'])->andWhere(['sale.status' => '1']);
//        else if ($params['get'] == 'partial-payment')
//            $query = Sales::find()->where(['sale.payment_status' => '2'])->andWhere(['sale.status' => '1']);
//        else if ($params['get'] == 'due-payment')
//            $query = Sales::find()->where(['sale.payment_status' => '0'])->andWhere(['sale.status' => '1']);
//        else if ($params['get'] == 'department-bills')
//            $query = Sales::find()->where(['sale.depart_push_status' => '1'])->andWhere(['sale.status' => '1']);
//        else
        $query = Sales::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

//       $query->joinWith('saleitems');
//        $query->joinWith('payments');
//        $query->joinWith('payments.mop');
//
        $query->orderBy(['id' => SORT_DESC]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'hospital_id' => $this->hospital_id,
            'patient_id' => $this->patient_id,
            'referred_doctor_id' => $this->referred_doctor_id,
            'total' => $this->total,
            'discount' => $this->discount,
            'tax' => $this->tax,
            'grand_total' => $this->grand_total,
            'total_items' => $this->total_items,
            'paid_amount' => $this->paid_amount,
            'refund_charges' => $this->refund_charges,
            'sale.created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
            'invoice_no' => $this->invoice_no,
        ]);

        //echo $this->created_on;
        list($start, $end) = explode(' - ', $this->created_on);

        //$query = Sales::find()->where(['between', 'sale.created_on', $this->created_on, $this->created_on]);


        $query->andFilterWhere(['like', 'invoice_no', $this->invoice_no])
                ->andFilterWhere(['like', 'discount_type', $this->discount_type])
                ->andFilterWhere(['like', 'sale.payment_status', $this->payment_status])
                ->andFilterWhere(['like', 'notes', $this->notes])
                ->andFilterWhere(['like', 'sale_status', $this->sale_status]);

        if (Yii::$app->user->identity->role != "Admin") {
            $query->andFilterWhere(['sale.status' => '1']);
        }
        if (!empty($start) && !empty($end)) {
            //$start = "10.06.2015 09:25 AM";
            $start = DateTime::createFromFormat('d/m/Y H:i A', $start);
            $start = $start->format('Y-m-d H:i:s');

            $end = DateTime::createFromFormat('d/m/Y H:i A', $end);
            $end = $end->format('Y-m-d H:i:s');
            $query->andFilterWhere(['between', 'sale.created_on', $start, $end]);
        } else {
            $start = date('Y-m-d 00:00:00');
            $end = date('Y-m-d 23:59:59');

            $start_date = DateTime::createFromFormat('Y-m-d', $start);
            $query->andWhere(['like', 'sale.created_on', $start_date]);
        }
        //print_r($dataProvider);
        return $dataProvider;
    }

    public function dailySaleSearch($params, $daily = '', $start = '', $end = '') {

        if (!empty($start) && !empty($end)) {


            $query = Sales::find()->where(['between', 'sale.created_on', $start, $end]);
        } else {
            $query = Sales::find()->where(['like', 'sale.created_on', $daily]);
        }




        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('saleitems');

        $query->joinWith('payments');
        $query->joinWith('payments.mop');

        //$query->orderBy(['id' => SORT_DESC]);
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'hospital_id' => $this->hospital_id,
            'patient_id' => $this->patient_id,
            'referred_doctor_id' => $this->referred_doctor_id,
            'sale.total' => $this->total,
            'sale.discount' => $this->discount,
            'sale.tax' => $this->tax,
            'sale.grand_total' => $this->grand_total,
            'sale.total_items' => $this->total_items,
            'sale.paid_amount' => $this->paid_amount,
            'sale.refund_charges' => $this->refund_charges,
            'sale.created_by' => $this->created_by,
            'sale.created_on' => $this->created_on,
            'sale.updated_by' => $this->updated_by,
            'sale.updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'sale.invoice_no', $this->invoice_no])
                ->andFilterWhere(['like', 'sale.discount_type', $this->discount_type])
                ->andFilterWhere(['like', 'sale.payment_status', $this->payment_status])
                ->andFilterWhere(['like', 'sale.notes', $this->notes])
                ->andFilterWhere(['like', 'sale.sale_status', $this->sale_status])
                ->andFilterWhere(['like', 'sale.status', '1']);
        if (Yii::$app->user->identity->role != "Admin") {
            $query->andFilterWhere(['sale.status' => '1']);
        }

        return $dataProvider;
    }

    public function pendingDepartmentBillsearch($params) {


        $query = Sales::find()->where(['depart_push_status' => 1]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // $query->joinWith('saleitems');
        //$query->joinWith('payments');
        //$query->joinWith('payments.mop');

        $query->orderBy(['id' => SORT_DESC]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'hospital_id' => $this->hospital_id,
            'patient_id' => $this->patient_id,
            'referred_doctor_id' => $this->referred_doctor_id,
            'total' => $this->total,
            'discount' => $this->discount,
            'tax' => $this->tax,
            'grand_total' => $this->grand_total,
            'total_items' => $this->total_items,
            'paid_amount' => $this->paid_amount,
            'extra_charges' => $this->extra_charges,
            'refund_charges' => $this->refund_charges,
            'created_by' => $this->created_by,
            'created_on' => $this->created_on,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'invoice_no', $this->invoice_no])
                ->andFilterWhere(['like', 'discount_type', $this->discount_type])
                ->andFilterWhere(['like', 'payment_status', $this->payment_status])
                ->andFilterWhere(['like', 'notes', $this->notes])
                ->andFilterWhere(['like', 'sale_status', $this->sale_status]);
        if (Yii::$app->user->identity->role != "Admin") {
            $query->andFilterWhere(['sale.status' => '1']);
        }
        return $dataProvider;
    }

    public function CustomSalesearch($params) {

        if ($params) {
            $query = Sales::find();
        } else {
            $query = Sales::find()->where(['sale.id' => 0]);
        }


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        if($this->test && $this->department)
        {
            $query->joinWith(['saleitems' => function (yii\db\ActiveQuery $query) {
                return $query
                    ->andWhere([
                        'sale_item.item_id' => $this->test,
                    ])
                    ->andWhere([
                        'in', 'sale_item.item_id', ItemName::find()->select('id')->where(['cat_id'=> $this->department])
                    ]);
            }]);
            $query->joinWith(['saleitems.item' => function (yii\db\ActiveQuery $query) {
                return $query
                    ->andWhere([
                        'item_name.cat_id' => $this->department,
                    ]);
            }]);
        }
        else if($this->department)
        {
            $query->joinWith(['saleitems' => function (yii\db\ActiveQuery $query) {
                return $query
                    ->andWhere([
                        'in', 'sale_item.item_id', ItemName::find()->select('id')->where(['cat_id'=> $this->department])
                    ]);
            }]);
            $query->joinWith(['saleitems.item' => function (yii\db\ActiveQuery $query) {
                return $query
                    ->andWhere([
                        'item_name.cat_id' => $this->department,
                    ]);
            }]);
        }
        else if($this->test)
        {
            $query->joinWith(['saleitems' => function (yii\db\ActiveQuery $query) {
                return $query
                    ->andWhere([
                        'sale_item.item_id' => $this->test,
                    ]);
            }]);
            $query->joinWith('saleitems.item');
            $query->joinWith('saleitems.extra');
        }
        else
        {
            $query->joinWith('saleitems');
            $query->joinWith('saleitems.item');
            $query->joinWith('saleitems.extra');
        }
       /*  if(is_null($this->test) || trim($this->test == "")) 
        {
            $query->joinWith('saleitems');
        }
        else
        {
           $query->joinWith(['saleitems' => function (yii\db\ActiveQuery $query) {
                return $query
                    ->andWhere([
                        'sale_item.item_id' => $this->test,
                    ]);
            }]);
        }
        if (is_null($this->department) || trim($this->department == "")) 
        {
            $query->joinWith('saleitems.item');
            $query->joinWith('saleitems.extra');
        }
        else
        {
            $query->joinWith(['saleitems.item' => function (yii\db\ActiveQuery $query) {
                return $query
                    ->andWhere([
                        'item_name.cat_id' => $this->department,
                    ]);
            }]);
        } */
        
        // $query->joinWith('payments');
        // $query->joinWith('payments.mop');

        $query->orderBy(['id' => SORT_ASC]);



        if (!is_null($this->created_on) && strpos($this->created_on, ' - ') !== false) {
            list($start_date, $end_date) = explode(' - ', $this->created_on);
            $start_date = DateTime::createFromFormat('d/m/Y h:i A', $start_date);
            $start_date = $start_date->format('Y-m-d H:i:s');

            $end_date = DateTime::createFromFormat('d/m/Y h:i A', $end_date);
            $end_date = $end_date->format('Y-m-d H:i:s');
            $query->andFilterWhere(['between', 'sale.created_on', $start_date, $end_date]);
        }



       /*  if (!is_null($this->test)) {
            $query->andFilterWhere([
                'sale_item.item_id' => $this->test,
            ]);
            //$query->orderBy(['sale_item.item_id' => SORT_ASC]);
        } */
        /* if (!is_null($this->department)) {
            $query->andFilterWhere(['item_name.cat_id']); 
            //$query->orderBy(['sale_item.item_id' => SORT_ASC]);
        } */



        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'hospital_id' => $this->hospital_id,
            'patient_id' => $this->patient_id,
            'referred_doctor_id' => $this->referred_doctor_id,
            'total' => $this->total,
            'discount' => $this->discount,
            'tax' => $this->tax,
            'grand_total' => $this->grand_total,
            'total_items' => $this->total_items,
            'paid_amount' => $this->paid_amount,
            'refund_charges' => $this->refund_charges,
            'sale.created_by' => $this->created_by,
            //'created_on' => $this->created_on,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'invoice_no', $this->invoice_no])
                ->andFilterWhere(['like', 'discount_type', $this->discount_type])
                ->andFilterWhere(['like', 'sale.payment_status', $this->payment_status])
                ->andFilterWhere(['like', 'notes', $this->notes])
                ->andFilterWhere(['like', 'sale_status', $this->sale_status]);
        if (Yii::$app->user->identity->role != "Admin") {
            $query->andFilterWhere(['sale.status'=> '1']);
        }
        return $dataProvider;
    }

    public function saleSummary($params) {


        $query = Sales::find()->where(['sale.status' => '1']);



        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('saleitems');

        $query->joinWith('payments');
		$query->joinWith('saleitems.item');
        $query->joinWith('payments.mop');
		

        if (!is_null($this->created_on) && strpos($this->created_on, ' - ') !== false) {
            list($start_date, $end_date) = explode(' - ', $this->created_on);
            $start_date = DateTime::createFromFormat('d/m/Y h:i A', $start_date);
            $start_date = $start_date->format('Y-m-d H:i:s');

            $end_date = DateTime::createFromFormat('d/m/Y h:i A', $end_date);
            $end_date = $end_date->format('Y-m-d H:i:s');
            $query->andFilterWhere(['between', 'sale.created_on', $start_date, $end_date]);
        }

        //$query->orderBy(['id' => SORT_DESC]);
        // grid filtering conditions
		
		if(!is_null($this->department)){
			
			$query->andFilterWhere([
			'item_name.cat_id'=>$this->department,
			]);
		}
        $query->andFilterWhere([
            'id' => $this->id,
            'hospital_id' => $this->hospital_id,
            'patient_id' => $this->patient_id,
            'referred_doctor_id' => $this->referred_doctor_id,
            'sale.total' => $this->total,
            'sale.discount' => $this->discount,
            'sale.tax' => $this->tax,
            'sale.grand_total' => $this->grand_total,
            'sale.total_items' => $this->total_items,
            'sale.paid_amount' => $this->paid_amount,
            'sale.refund_charges' => $this->refund_charges,
            'sale.created_by' => $this->created_by,
            'sale.updated_by' => $this->updated_by,
            'sale.updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'sale.invoice_no', $this->invoice_no])
                ->andFilterWhere(['like', 'sale.discount_type', $this->discount_type])
                ->andFilterWhere(['like', 'sale.payment_status', $this->payment_status])
                ->andFilterWhere(['like', 'sale.notes', $this->notes])
                ->andFilterWhere(['like', 'sale.sale_status', $this->sale_status]);
        if (Yii::$app->user->identity->role != "Admin") {
            $query->andFilterWhere(['sale.status'=> '1']);
        }
        return $dataProvider;
    }

    public function completeSalesSearch($params) {

        set_time_limit(300000);
        //$query = Sales::find()->where(['sale_status' => '1'])->andWhere(['sale.status' => '1']);
        //return print_r($query);
        // add conditions that should always apply here
        $query = Sales::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

//        $query->joinWith('saleitems');
//        $query->joinWith('payments');
//        $query->joinWith('payments.mop');

        $query->orderBy(['id' => SORT_DESC]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'hospital_id' => $this->hospital_id,
            'patient_id' => $this->patient_id,
            'referred_doctor_id' => $this->referred_doctor_id,
            'total' => $this->total,
            'discount' => $this->discount,
            'tax' => $this->tax,
            'grand_total' => $this->grand_total,
            'total_items' => $this->total_items,
            'paid_amount' => $this->paid_amount,
            'refund_charges' => $this->refund_charges,
            'sale.created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
            'invoice_no' => $this->invoice_no,
        ]);

        //  print_r($this->created_on);
        list($start, $end) = explode(' - ', $this->created_on);
        //$query = Sales::find()->where(['between', 'sale.created_on', $this->created_on, $this->created_on]);


        $query->andFilterWhere(['like', 'invoice_no', $this->invoice_no])
                ->andFilterWhere(['like', 'discount_type', $this->discount_type])
                ->andFilterWhere(['like', 'sale.payment_status', $this->payment_status])
                ->andFilterWhere(['like', 'notes', $this->notes])
                ->andFilterWhere(['like', 'sale_status', $this->sale_status]);
        if (Yii::$app->user->identity->role != "Admin") {
            $query->andFilterWhere(['sale.status'=> '1']);
        }
        if (Yii::$app->controller->action->id == 'complete') {
            $query->andFilterWhere(['sale_status' => '1']);
        } elseif (Yii::$app->controller->action->id == 'partial-refund') {
            $query->andFilterWhere(['sale_status' => '3']);
        } elseif (Yii::$app->controller->action->id == 'refund') {
            $query->andFilterWhere(['sale_status' => '2']);
        }
        if (!empty($start) && !empty($end)) {
            //$start = "10.06.2015 09:25 AM";
            $start = DateTime::createFromFormat('d/m/Y H:i A', $start);
            $start = $start->format('Y-m-d H:i:s');

            $end = DateTime::createFromFormat('d/m/Y H:i A', $end);
            $end = $end->format('Y-m-d H:i:s');
            $query->andFilterWhere(['between', 'sale.created_on', $start, $end]);
        } else {
            //$start = date('Y-m-d');
            $query->andWhere(['like', 'sale.created_on', $start]);
        }
        // print_r($query);
        return $dataProvider;
    }

    public function paymentSalesSearch($params) {
        set_time_limit(300000);
        //$query = Sales::find()->where(['sale_status' => '1'])->andWhere(['sale.status' => '1']);
        //return print_r($query);
        // add conditions that should always apply here
        $query = Sales::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

//        $query->joinWith('saleitems');
//        $query->joinWith('payments');
//        $query->joinWith('payments.mop');

        $query->orderBy(['id' => SORT_DESC]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'hospital_id' => $this->hospital_id,
            'patient_id' => $this->patient_id,
            'referred_doctor_id' => $this->referred_doctor_id,
            'total' => $this->total,
            'discount' => $this->discount,
            'tax' => $this->tax,
            'grand_total' => $this->grand_total,
            'total_items' => $this->total_items,
            'paid_amount' => $this->paid_amount,
            'refund_charges' => $this->refund_charges,
            'sale.created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
            'invoice_no' => $this->invoice_no,
        ]);

        //  print_r($this->created_on);
        list($start, $end) = explode(' - ', $this->created_on);
        //$query = Sales::find()->where(['between', 'sale.created_on', $this->created_on, $this->created_on]);


        $query->andFilterWhere(['like', 'invoice_no', $this->invoice_no])
                ->andFilterWhere(['like', 'discount_type', $this->discount_type])
                ->andFilterWhere(['like', 'notes', $this->notes]);
        if (Yii::$app->user->identity->role != "Admin") {
            $query->andFilterWhere(['sale.status'=> '1']);
        }
        if (Yii::$app->controller->action->id == 'paid') {
            $query->andFilterWhere(['sale.payment_status' => '1']);
        } elseif (Yii::$app->controller->action->id == 'partial-payment') {
            $query->andFilterWhere(['sale.payment_status' => '2']);
        } elseif (Yii::$app->controller->action->id == 'due-payment') {
            $query->andFilterWhere(['sale.payment_status' => '0']);
        } elseif (Yii::$app->controller->action->id == 'department-push') {
            $query->andFilterWhere(['sale.depart_push_status' => '1']);
        }
        if (!empty($start) && !empty($end)) {
            //$start = "10.06.2015 09:25 AM";
            $start = DateTime::createFromFormat('d/m/Y H:i A', $start);
            $start = $start->format('Y-m-d H:i:s');

            $end = DateTime::createFromFormat('d/m/Y H:i A', $end);
            $end = $end->format('Y-m-d H:i:s');
            $query->andFilterWhere(['between', 'sale.created_on', $start, $end]);
        } else {
            //$start = date('Y-m-d');
            $query->andWhere(['like', 'sale.created_on', $start]);
        }
        // print_r($query);
        return $dataProvider;
    }
    public function DepartmentSaleReportSearch($params) {
        $query = Sales::find()->select(['item_category.name as item_category',new Expression('count(sale_item.id) as total_test'),new Expression('SUM(sale_item.item_price) as total_amount'),new Expression('SUM(sale_item.item_discount) as total_discount'),new Expression('SUM(sale_item.consultant_amount) as total_consultant')]);
        if (!$params) {
             $query = $query->where(['sale.id' => 0]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->joinWith('saleitems');
        $query->joinWith('saleitems.item');
        $query->joinWith('saleitems.item.category');
        $query->orderBy(['sale.id' => SORT_ASC]);
        $query->groupBy('item_name.cat_id');
        if (!is_null($this->created_on) && strpos($this->created_on, ' - ') !== false) {
            list($start_date, $end_date) = explode(' - ', $this->created_on);
            $start_date = DateTime::createFromFormat('d/m/Y h:i A', $start_date);
            $start_date = $start_date->format('Y-m-d H:i:s');

            $end_date = DateTime::createFromFormat('d/m/Y h:i A', $end_date);
            $end_date = $end_date->format('Y-m-d H:i:s');
            $query->andFilterWhere(['between', 'sale.created_on', $start_date, $end_date]);
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'hospital_id' => $this->hospital_id,
            'patient_id' => $this->patient_id,
            'referred_doctor_id' => $this->referred_doctor_id,
            'total' => $this->total,
            'discount' => $this->discount,
            'tax' => $this->tax,
            'grand_total' => $this->grand_total,
            'total_items' => $this->total_items,
            'paid_amount' => $this->paid_amount,
            'refund_charges' => $this->refund_charges,
            'sale.created_by' => $this->created_by,
            //'created_on' => $this->created_on,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'invoice_no', $this->invoice_no])
                ->andFilterWhere(['like', 'discount_type', $this->discount_type])
                ->andFilterWhere(['like', 'sale.payment_status', $this->payment_status])
                ->andFilterWhere(['like', 'notes', $this->notes])
                ->andFilterWhere(['like', 'sale_status', $this->sale_status]);
        if (Yii::$app->user->identity->role != "Admin") {
            $query->andFilterWhere(['sale.status'=> '1']);
        }
        return $dataProvider;
    }
    public function TestsSaleReportSearch($params) {
        $query = Sales::find()->select(['item_name.name as item_name',new Expression('count(sale_item.id) as total_test'),new Expression('SUM(sale_item.item_price) as total_amount'),new Expression('SUM(sale_item.item_discount) as total_discount'),new Expression('SUM(sale_item.consultant_amount) as total_consultant')]);
        if (!$params) {
             $query = $query->where(['sale.id' => 0]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        if($this->department)
        {
            $query->joinWith(['saleitems' => function (yii\db\ActiveQuery $query) {
                return $query
                    ->andWhere([
                        'in', 'sale_item.item_id', ItemName::find()->select('id')->where(['cat_id'=> $this->department])
                    ]);
            }]);
            $query->joinWith(['saleitems.item' => function (yii\db\ActiveQuery $query) {
                return $query
                    ->andWhere([
                        'item_name.cat_id' => $this->department,
                    ]);
            }]);
        } 
        else 
        {
            $query->joinWith('saleitems');
            $query->joinWith('saleitems.item');
        }
        $query->orderBy(['sale.id' => SORT_ASC]);
        $query->groupBy('sale_item.item_id');
        if (!is_null($this->created_on) && strpos($this->created_on, ' - ') !== false) {
            list($start_date, $end_date) = explode(' - ', $this->created_on);
            $start_date = DateTime::createFromFormat('d/m/Y h:i A', $start_date);
            $start_date = $start_date->format('Y-m-d H:i:s');

            $end_date = DateTime::createFromFormat('d/m/Y h:i A', $end_date);
            $end_date = $end_date->format('Y-m-d H:i:s');
            $query->andFilterWhere(['between', 'sale.created_on', $start_date, $end_date]);
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'hospital_id' => $this->hospital_id,
            'patient_id' => $this->patient_id,
            'referred_doctor_id' => $this->referred_doctor_id,
            'total' => $this->total,
            'discount' => $this->discount,
            'tax' => $this->tax,
            'grand_total' => $this->grand_total,
            'total_items' => $this->total_items,
            'paid_amount' => $this->paid_amount,
            'refund_charges' => $this->refund_charges,
            'sale.created_by' => $this->created_by,
            //'created_on' => $this->created_on,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'invoice_no', $this->invoice_no])
                ->andFilterWhere(['like', 'discount_type', $this->discount_type])
                ->andFilterWhere(['like', 'sale.payment_status', $this->payment_status])
                ->andFilterWhere(['like', 'notes', $this->notes])
                ->andFilterWhere(['like', 'sale_status', $this->sale_status]);
        if (Yii::$app->user->identity->role != "Admin") {
            $query->andFilterWhere(['sale.status'=> '1']);
        }
        return $dataProvider;
    }

}
