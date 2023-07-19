<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AccountTransactions;

/**
 * AccountTransactionsSearch represents the model behind the search form of `app\models\AccountTransactions`.
 */
class AccountTransactionsSearch extends AccountTransactions
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', /*'charts_of_accounts_id',*/ 'debit', 'credit', 'created_by', 'updated_by'], 'integer'],
            [['description', 'charts_of_accounts_id', 'created_on', 'updated_on'], 'safe'],
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
        $query = AccountTransactions::find();
        $query->joinWith(['chartsOfAccounts']); //->asArray()->one()
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
            //'charts_of_accounts_id' => $this->charts_of_accounts_id,
            'debit' => $this->debit,
            'credit' => $this->credit,
            'created_on' => $this->created_on,
            'created_by' => $this->created_by,
            'updated_on' => $this->updated_on,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);

        //$query->andFilterWhere(['like', 'chartsOfAccounts.account_name', $this->chartsOfAccounts->account_name])->andFilterWhere(['like', 'charts_of_accounts_id', $this->charts_of_accounts_id]);

        $query->andFilterWhere(['like', 'charts_of_accounts.account_name', $this->charts_of_accounts_id]);

        return $dataProvider;
    }

    public function customsearch($params)
    {
        $query = AccountTransactions::find();
        $query->joinWith(['chartsOfAccounts']); //->asArray()->one()
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
            //'charts_of_accounts_id' => $this->charts_of_accounts_id,
            'debit' => $this->debit,
            'credit' => $this->credit,
            'created_on' => $this->created_on,
            'created_by' => $this->created_by,
            'updated_on' => $this->updated_on,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);

        //$query->andFilterWhere(['like', 'chartsOfAccounts.account_name', $this->chartsOfAccounts->account_name])->andFilterWhere(['like', 'charts_of_accounts_id', $this->charts_of_accounts_id]);

        $query->andFilterWhere(['like', 'charts_of_accounts.account_name', $this->charts_of_accounts_id]);
        $query->andFilterWhere(['like', 'charts_of_accounts.account_name', $this->charts_of_accounts_id]);

        return $dataProvider;
    }

    public static function pageTotal($provider, $fieldName)
    {
        $total=0;
        foreach($provider as $item){
            $total+=$item[$fieldName];
        }
        return $total;
    }

}
