<?php

namespace app\models;

use yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form of `app\models\user`.
 */
class UserSearch extends User {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'designation_id', 'payment_type', 'basic_salary', 'overtime_salary', 'email'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = User::find();
        $query->joinWith('designation');

        if (!(Yii::$app->user->identity->role == "Admin")) {
            $query->andFilterWhere(['and', ['!=', 'user.role', 'Admin']])
                    ->andFilterWhere(['and', ['=', 'user.status', 1]])
                    ->andFilterWhere(['and', ['!=', 'user.role', 'Manager']]);
            //echo "Manager";
            //die();
        } else if (Yii::$app->user->identity->role == "Admin") {
            $query->andFilterWhere(['and', ['!=', 'user.role', 'Admin']]);
        }
        //$query = User::find()->where(['!=', 'role', 'manager'])->all();
        //$query->andFilterWhere([ 'and',['!=', 'role','admin']]);
        //$query->andFilterWhere(['and',['!=', 'role','Admin']])->andFilterWhere(['and',['!=', 'role','Manager']]);
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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
                ->andFilterWhere(['like', 'auth_key', $this->auth_key])
                ->andFilterWhere(['like', 'password_hash', $this->password_hash])
                ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
                ->andFilterWhere(['like', 'payment_type', $this->payment_type])
                ->andFilterWhere(['like', 'basic_salary', $this->basic_salary])
                ->andFilterWhere(['like', 'overtime_salary', $this->overtime_salary])
                ->andFilterWhere(['like', 'email', $this->email]);
        if (Yii::$app->user->identity->role != "Admin") {
            $query->andFilterWhere(['user.status' => '1']);
        }
        return $dataProvider;
    }

}
