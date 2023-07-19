<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Payroll;

/**
 * PayrollSearch represents the model behind the search form of `app\models\Payroll`.
 */
class PayrollSearch extends Payroll
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'monthly_salary', 'no_days_absent', 'overtime_salary', 'created_by', 'updated_by'], 'integer'],
            [['payment_month', 'payment_date', 'basic_allow', 'hra_allow', 'conveyance_allow', 'medical_allow', 'splallow', 'tax', 'provident_fund', 'loan', 'payment_type', 'status', 'created_on', 'updated_on'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = Payroll::find();

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
            'user_id' => $this->user_id,
            'payment_month' => $this->payment_month,
            'payment_date' => $this->payment_date,
            'monthly_salary' => $this->monthly_salary,
            'no_days_absent' => $this->no_days_absent,
            'overtime_salary' => $this->overtime_salary,
            'created_by' => $this->created_by,
            'created_on' => $this->created_on,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'basic_allow', $this->basic_allow])
            ->andFilterWhere(['like', 'hra_allow', $this->hra_allow])
            ->andFilterWhere(['like', 'conveyance_allow', $this->conveyance_allow])
            ->andFilterWhere(['like', 'medical_allow', $this->medical_allow])
            ->andFilterWhere(['like', 'splallow', $this->splallow])
            ->andFilterWhere(['like', 'tax', $this->tax])
            ->andFilterWhere(['like', 'provident_fund', $this->provident_fund])
            ->andFilterWhere(['like', 'loan', $this->loan])
            ->andFilterWhere(['like', 'payment_type', $this->payment_type])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }

    public function advanceSearch($params, $id)
    {
        $query = Payroll::find()->where(['user_id' => $id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        //return $this->payment_month;

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            //'payment_month' => $temp_payment_month,
            //'payment_month' => $this->payment_month,
            'payment_month' => empty($this->payment_month)? $this->payment_month : $this->payment_month.'-00',
            'payment_date' => $this->payment_date,
            'monthly_salary' => $this->monthly_salary,
            'no_days_absent' => $this->no_days_absent,
            'overtime_salary' => $this->overtime_salary,
            'created_by' => $this->created_by,
            'created_on' => $this->created_on,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'basic_allow', $this->basic_allow])
            ->andFilterWhere(['like', 'hra_allow', $this->hra_allow])
            ->andFilterWhere(['like', 'conveyance_allow', $this->conveyance_allow])
            ->andFilterWhere(['like', 'medical_allow', $this->medical_allow])
            ->andFilterWhere(['like', 'splallow', $this->splallow])
            ->andFilterWhere(['like', 'tax', $this->tax])
            ->andFilterWhere(['like', 'provident_fund', $this->provident_fund])
            ->andFilterWhere(['like', 'loan', $this->loan])
            ->andFilterWhere(['like', 'payment_type', $this->payment_type])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
