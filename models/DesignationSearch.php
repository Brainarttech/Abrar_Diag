<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Designation;

/**
 * DesignationSearch represents the model behind the search form of `app\models\Designation`.
 */
class DesignationSearch extends Designation {

    //public $department;
    public $created_by;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', /* 'department_id', */ 'updated_by'], 'integer'],
            [['designation_name', 'status', 'created_on', 'updated_on', /* 'department', */ 'created_by'], 'safe'],
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
        $query = Designation::find();

        //$query->joinWith(['department']);

        $query->joinWith(['user']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //$dataProvider->sort->attributes['department'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        //'asc' => ['department.name' => SORT_ASC],
        //'desc' => ['department.name' => SORT_DESC],
        //];

        $dataProvider->sort->attributes['created_by'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            //'department_id' => $this->department_id,
            'designation.created_on' => $this->created_on,
            //'created_by' => $this->created_by,
            'updated_on' => $this->updated_on,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'designation.designation_name', $this->designation_name])
                //->andFilterWhere(['like', 'department.name', $this->department])
                ->andFilterWhere(['like', 'user.username', $this->created_by]);
        if (Yii::$app->user->identity->role != "Admin") {
            $query->andFilterWhere(['designation.status' => '1']);
        }
        return $dataProvider;
    }

}
