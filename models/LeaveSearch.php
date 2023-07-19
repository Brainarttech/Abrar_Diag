<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Leave;

/**
 * LeaveSearch represents the model behind the search form of `app\models\Leave`.
 */
class LeaveSearch extends Leave {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'user_id', 'leave_type_id', 'created_by', 'updated_by'], 'integer'],
            [['leave_from', 'leave_to', 'applied_on', 'leave_reason', 'comment', 'leave_status', 'status', 'created_on', 'updated_on'], 'safe'],
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
        $query = Leave::find();

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
            'leave_from' => $this->leave_from,
            'leave_to' => $this->leave_to,
            'leave_type_id' => $this->leave_type_id,
            'applied_on' => $this->applied_on,
            'created_on' => $this->created_on,
            'created_by' => $this->created_by,
            'updated_on' => $this->updated_on,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'leave_reason', $this->leave_reason])
                ->andFilterWhere(['like', 'comment', $this->comment])
                ->andFilterWhere(['like', 'leave_status', $this->leave_status])
                ->andFilterWhere(['like', 'status', $this->status]);
        if (Yii::$app->user->identity->role != "Admin") {
            $query->andFilterWhere(['status' => '1']);
        }
        return $dataProvider;
    }

}
