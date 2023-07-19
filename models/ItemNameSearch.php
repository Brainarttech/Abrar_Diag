<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ItemName;

/**
 * ItemNameSearch represents the model behind the search form of `app\models\ItemName`.
 */
class ItemNameSearch extends ItemName {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'cat_id', 'price', 'created_by', 'consultant_percentage', 'updated_by'], 'integer'],
            [['name', 'status', 'created_on', 'updated_on'], 'safe'],
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
        $query = ItemName::find();

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
            'cat_id' => $this->cat_id,
            'price' => $this->price,
            'consultant_percentage' => $this->consultant_percentage,
            'created_by' => $this->created_by,
            'created_on' => $this->created_on,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'status', $this->status]);
        if (Yii::$app->user->identity->role != "Admin") {
            $query->andFilterWhere(['status' => '1']);
        }
        return $dataProvider;
    }

}
