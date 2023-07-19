<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ReferredReport;

/**
 * ReferredReportSearch represents the model behind the search form of `app\models\ReferredReport`.
 */
class ReferredReportSearch extends ReferredReport
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'films_issued', 'report_issued', 'sale_item_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['referred_reporting_doc_id', 'created_on', 'updated_on'], 'safe'],
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
        $query = ReferredReport::find();

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
            'referred_reporting_doc_id' => $this->referred_reporting_doc_id,
            'films_issued' => $this->films_issued,
            'report_issued' => $this->report_issued,
            'sale_item_id' => $this->sale_item_id,
            'status' => $this->status,
            'created_on' => $this->created_on,
            'created_by' => $this->created_by,
            'updated_on' => $this->updated_on,
            'updated_by' => $this->updated_by,
        ]);


        return $dataProvider;
    }
}
