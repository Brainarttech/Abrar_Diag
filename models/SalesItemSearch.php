<?php

namespace app\models;

use DateTime;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SalesItem;

/**
 * SalesItemSearch represents the model behind the search form of `app\models\SalesItem`.
 */
class SalesItemSearch extends SalesItem {

    public $item_category;
    public $patient_id;
    public $referred_id;
    public $invoice_no;
    public $discount_reason;
    public $payment_method;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'sale_id', 'item_id', 'item_price', 'created_by', 'updated_by'], 'integer'],
            [['item_category', 'patient_id', 'referred_id', 'item_name', 'test_status','discount_reason', 'status', 'created_on', 'updated_on', 'invoice_no'], 'safe'],
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
        $query = SalesItem::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'sale_id' => $this->sale_id,
            'item_id' => $this->item_id,
            'item_price' => $this->item_price,
            'created_by' => $this->created_by,
            'created_on' => $this->created_on,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'item_name', $this->item_name])
                ->andFilterWhere(['like', 'test_status', $this->test_status]);
        if (Yii::$app->user->identity->role != "Admin") {
            $query->andFilterWhere(['sale_item.status' => '1']);
        }
        if (!is_null($this->invoice_no)) {
            $query->joinWith(['sale']);
            $query->andFilterWhere([

                'sale.invoice_no' => $this->invoice_no,
            ]);
        }
        if (!is_null($this->patient_id)) {
            $query->andFilterWhere([
                'sale.patient_id' => $this->patient_id,
            ]);
        }
        return $dataProvider;
    }

    public function dailydetailsearch($params, $daily = '', $start = '', $end = '') {
        if (!empty($start) && !empty($end)) {
            $query = SalesItem::find()->where(['between', 'sale_item.created_on', $start, $end]);
        } else {
            $query = SalesItem::find()->where(['like', 'sale_item.created_on', $daily]);
        }




        /*
          if (isset($params['SalesItemSearch']) && isset($params['SalesItemSearch']['item_id']) && is_array($params['SalesItemSearch']['item_id'])) {
          $params['SalesItemSearch']['item_id'] = implode(",", $params['SalesItemSearch']['item_id']);
          } */


        $query->joinWith(['item.category']);
        $query->joinWith(['sale.patient']);
        $query->joinWith(['sale.referred']);

        //$query->orderBy(['item_category.id' => SORT_ASC,'item_id'=>SORT_ASC]);
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


        /* if (!empty($this->item_id)) {
          $this->item_id = explode(',', $this->item_id);
          $val_last = "'".implode("','", $this->item_id)."'";
          $query->andWhere("`item_id` IN($val_last)");
          } */

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'sale_id' => $this->sale_id,
            'item_id' => $this->item_id,
            'item_category.id' => $this->item_category,
            'patient.id' => $this->patient_id,
            'referred_doctor.id' => $this->referred_id,
            'item_price' => $this->item_price,
            'created_by' => $this->created_by,
            'created_on' => $this->created_on,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'item_name', $this->item_name])
                ->andFilterWhere(['like', 'test_status', $this->test_status]);

        if (Yii::$app->user->identity->role != "Admin") {
            $query->andFilterWhere(['sale_item.status' => '1']);
        }
        // echo $query->createCommand()->getRawSql();

        return $dataProvider;
    }


    public function customSearch($params) {

        

         $this->load($params);
            if (!empty($this->discount_reason)) {
            $query = SalesItem::find()->where(['=','discount_reason',$this->discount_reason]);
        } else {
            $query = SalesItem::find();
        }

        $query->joinWith(['item.category']);
        $query->joinWith(['sale.patient']);
        $query->joinWith(['sale.referred']);

        $query->orderBy(['item_category.id' => SORT_ASC, 'item_id' => SORT_ASC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // $this->load($params);

        if (!is_null($this->created_on) && strpos($this->created_on, ' - ') !== false) {
            list($start_date, $end_date) = explode(' - ', $this->created_on);
            $start_date = DateTime::createFromFormat('d/m/Y h:i A', $start_date);
            $start_date = $start_date->format('Y-m-d H:i:s');

            $end_date = DateTime::createFromFormat('d/m/Y h:i A', $end_date);
            $end_date = $end_date->format('Y-m-d H:i:s');
            $query->andFilterWhere(['between', 'sale.created_on', $start_date, $end_date]);
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }




        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'sale_id' => $this->sale_id,
            'item_id' => $this->item_id,
            'item_category.id' => $this->item_category,
            'patient.id' => $this->patient_id,
            'referred_doctor.id' => $this->referred_id,
            'item_price' => $this->item_price,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'item_name', $this->item_name])
                ->andFilterWhere(['like', 'test_status', $this->test_status]);

        if (Yii::$app->user->identity->role != "Admin") {
            $query->andFilterWhere(['sale_item.status' => '1']);
        }
        // echo $query->createCommand()->getRawSql();

        return $dataProvider;
    }

    public function dailysearch($params, $daily = '') {


        $query = SalesItem::find()->where(['like', 'sale_item.created_on', $daily]);

        $query->joinWith(['item.category']);
        $query->joinWith(['sale.patient']);
        $query->joinWith(['sale.referred']);

        $query->orderBy(['item_category.id' => SORT_ASC, 'item_id' => SORT_ASC]);

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




        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'sale_id' => $this->sale_id,
            'item_id' => $this->item_id,
            'item_category.id' => $this->item_category,
            'patient.id' => $this->patient_id,
            'referred_doctor.id' => $this->referred_id,
            'item_price' => $this->item_price,
            'created_by' => $this->created_by,
            'created_on' => $this->created_on,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'item_name', $this->item_name])
                ->andFilterWhere(['like', 'test_status', $this->test_status]);
        if (Yii::$app->user->identity->role != "Admin") {
            $query->andFilterWhere(['sale_item.status' => '1']);
        }

        // echo $query->createCommand()->getRawSql();

        return $dataProvider;
    }

    public function searchAssignPendingDepartment($params, $assign) {


        $assign_department = explode(',', $assign);

        $query = SalesItem::find()->joinWith(['item.category.department'])->where(['in', 'department.id', $assign_department])->andWhere(['test_status' => "1"])->orderBy(['id' => SORT_DESC]);
        $query->joinWith(['sale.patient']);
        // die($query);
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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'sale_id' => $this->sale_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
        ]);



                $query->andFilterWhere(['like', 'test_status', $this->test_status])
                ->andFilterWhere(['like', 'sale.patient_id', $this->patient_id])
                ->andFilterWhere(['like', 'sale_item.created_on', $this->created_on]);
        if (Yii::$app->user->identity->role != "Admin") {
            $query->andFilterWhere(['sale_item.status' => '1']);
        }

        return $dataProvider;
    }

    public function searchAssignCompleteDepartment($params, $assign) {
        $assign_department = explode(',', $assign);
        $query = SalesItem::find()->joinWith(['item.category.department'])->where(['in', 'department.id', $assign_department])->andWhere(['test_status' => 2])->orderBy(['sale_item.updated_on' => SORT_DESC]);
        $query->joinWith(['sale.patient']);
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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'sale_id' => $this->sale_id,
            'item_id' => $this->item_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'test_status', $this->test_status])
                ->andFilterWhere(['like', 'sale.patient_id', $this->patient_id])
                ->andFilterWhere(['like', 'sale_item.created_on', $this->created_on,])
                ->andFilterWhere(['like', 'sale_item.updated_on', $this->updated_on,]);
        if (Yii::$app->user->identity->role != "Admin") {
            $query->andFilterWhere(['sale_item.status' => '1']);
        }
        return $dataProvider;
    }

    public function report($params) {
        $query = SalesItem::find()->joinWith(['item.category.department'])->orderBy(['sale_item.updated_on' => SORT_DESC]);
        $query->joinWith(['sale.patient']);
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

        // grid filtering conditions
        // $query->andFilterWhere([
        //     'id' => $this->id,
        //     'sale_id' => $this->sale_id,
        //     'item_id' => $this->item_id,
        //     'created_by' => $this->created_by,
        //     'updated_by' => $this->updated_by,
        // ]);

        // $query->andFilterWhere(['like', 'test_status', $this->test_status])
        //         ->andFilterWhere(['like', 'sale.patient_id', $this->patient_id])
        //         ->andFilterWhere(['like', 'sale_item.created_on', $this->created_on,])
        //         ->andFilterWhere(['like', 'sale_item.updated_on', $this->updated_on,]);
        // if (Yii::$app->user->identity->role != "Admin") {
        //     $query->andFilterWhere(['sale_item.status' => '1']);
        // }
        return $dataProvider;
    }
    public function searchPatientReport($params)
    {
       if( Yii::$app->request->get('SalesItemSearch') != ''){
        if ( empty ($params['SalesItemSearch']['patient_name'])) {
            $this->addError('patient_name', 'Patient Id cannot be blank.');
            if(empty($params['SalesItemSearch']['receipt_no'])){
                $this->addError('receipt_no', 'Receipt no cannot be blank..');
            }
        }else if(empty($params['SalesItemSearch']['receipt_no'])){
            $this->addError('receipt_no', 'Receipt no cannot be blank..');
            if ( empty ($params['SalesItemSearch']['patient_name'])) {
                $this->addError('patient_name', 'Patient Id cannot be blank.');
            }
        }
           
       }

         if ( ! empty ($params['SalesItemSearch']['patient_name']) && ! empty($params['SalesItemSearch']['receipt_no'])) {
            $query = SalesItem::find()->joinWith(['item.category.department'])->joinWith(['sale.patient'])->andWhere(['test_status' => 2 ]);
            // add conditions that should always apply here
    
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
    
            $this->load($params);
           
            // grid filtering conditions
            $query->andFilterWhere([
                'id' => $this->id,
                'sale_id' => $this->sale_id,
                'item_id' => $this->item_id,
                'item_price' => $this->item_price,
                'created_by' => $this->created_by,
                'updated_by' => $this->updated_by,
            ]);
    
            $query->andFilterWhere(['like', 'item_name', $this->item_name])
                ->andFilterWhere(['like', 'test_status', $this->test_status])
                ->andFilterWhere(['=', 'patient.reg_no', $params['SalesItemSearch']['patient_name']])
                ->andFilterWhere(['=', 'sale.invoice_no', $params['SalesItemSearch']['receipt_no']])
                ->andFilterWhere(['like', 'sale_item.created_on', $this->created_on,])
                ->andFilterWhere(['like', 'sale_item.updated_on', $this->updated_on,]);
          
            return $dataProvider;
        }
    }


    
    public function printSearch($params) {
        $query = SalesItem::find();

        $query->joinWith(['item.category']);
        $query->joinWith(['sale.patient']);
        $query->joinWith(['sale.referred']);

        $query->orderBy(['item_category.id' => SORT_ASC, 'item_id' => SORT_ASC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!is_null($this->created_on) && strpos($this->created_on, ' - ') !== false) {
            list($start_date, $end_date) = explode(' - ', $this->created_on);
            $start_date = DateTime::createFromFormat('d/m/Y h:i A', $start_date);
            $start_date = $start_date->format('Y-m-d H:i:s');

            $end_date = DateTime::createFromFormat('d/m/Y h:i A', $end_date);
            $end_date = $end_date->format('Y-m-d H:i:s');
            $query->andFilterWhere(['between', 'sale.created_on', $start_date, $end_date]);
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
           //return $dataProvider;
        }




        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'sale_id' => $this->sale_id,
            'item_id' => $this->item_id,
            'item_category.id' => $this->item_category,
            'patient.id' => $this->patient_id,
            'referred_doctor.id' => $this->referred_id,
            'item_price' => $this->item_price,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'item_name', $this->item_name])
                ->andFilterWhere(['like', 'test_status', $this->test_status]);

        if (Yii::$app->user->identity->role != "Admin") {
            $query->andFilterWhere(['sale_item.status' => '1']);
        }
        // echo $query->createCommand()->getRawSql();
        if (!is_null($this->invoice_no)) {
            $query->joinWith(['sale']);
            $query->andFilterWhere([
                'sale.invoice_no' => $this->invoice_no,
            ]);
        }
        return $dataProvider;
    }

}
