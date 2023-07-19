<?php

namespace app\models;

use DateTime;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Expenses;

/**
 * ExpensesSearch represents the model behind the search form of `app\models\Expenses`.
 */
class ExpensesSearch extends Expenses
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_on'], 'required','on'=>'report'],
            [['id', 'amount', 'cat_id', 'created_by', 'updated_by'], 'integer'],
            [['note', 'attachment', 'updated_on'], 'safe'],
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
        $query = Expenses::find();

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
            'amount' => $this->amount,
            'cat_id' => $this->cat_id,
            'created_on' => $this->created_on,
            'created_by' => $this->created_by,
            'updated_on' => $this->updated_on,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'attachment', $this->attachment]);

        return $dataProvider;
    }


    public function searchReport($params)
    {
        
      $query = Expenses::find();
        


        $query->orderBy(['id' => SORT_ASC]);


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

        if ( ! is_null($this->created_on) && strpos($this->created_on, ' - ') !== false ) {
            list($start_date, $end_date) = explode(' - ', $this->created_on);
            $start_date = DateTime::createFromFormat('d/m/Y h:i A', $start_date);
            $start_date = $start_date->format('Y-m-d H:i:s');

            $end_date = DateTime::createFromFormat('d/m/Y h:i A', $end_date);
            $end_date = $end_date->format('Y-m-d H:i:s');
            $query->andFilterWhere(['between', 'created_on', $start_date, $end_date]);



        }


        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'amount' => $this->amount,
            'cat_id' => $this->cat_id,
            'created_by' => $this->created_by,
            'updated_on' => $this->updated_on,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'attachment', $this->attachment]);

        return $dataProvider;
    }
}
