<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Patient;

/**
 * PatientSearch represents the model behind the search form of `app\models\Patient`.
 */
class PatientSearch extends Patient {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'age', 'referred_by_id', 'panel_id', 'created_on', 'updated_on'], 'integer'],
            [['name', 'cnic', 'phone_no', 'city', 'country', 'reg_no', 'email', 'gender', 'relationship', 'whatsapp_no', 'address', 'status', 'created_by', 'updated_by'], 'safe'],
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
        $query = Patient::find();

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
            'age' => $this->age,
            'referred_by_id' => $this->referred_by_id,
            'panel_id' => $this->panel_id,
            'created_on' => $this->created_on,
            'created_by' => $this->created_by,
            'updated_on' => $this->updated_on,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'cnic', $this->cnic])
                ->andFilterWhere(['like', 'phone_no', $this->phone_no])
                ->andFilterWhere(['like', 'reg_no', $this->reg_no])
                ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['gender' => $this->gender])
                ->andFilterWhere(['like', 'relationship', $this->relationship])
                ->andFilterWhere(['like', 'whatsapp_no', $this->whatsapp_no])
                ->andFilterWhere(['like', 'address', $this->address])
                ->andFilterWhere(['like', 'city', $this->city])
                ->andFilterWhere(['like', 'country', $this->country]);
        if (Yii::$app->user->identity->role != "Admin") {
            $query->andFilterWhere(['status' => '1']);
        }
        return $dataProvider;
    }

}
