<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Attendance;

/**
 * AttendanceSearch represents the model behind the search form of `app\models\Attendance`.
 */
class AttendanceSearch extends Attendance
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'created_by', 'updated_by'], 'integer'],
            [['attendance_date', 'check_in_date', 'check_in_time', 'check_out_date', 'status', 'check_out_time', 'stay_time', 'created_on', 'updated_on'], 'safe'],
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
    public function search($params, $id)
    {
        $query = Attendance::find()->where(['status' => '1','user_id' => $id])
        ->orderBy(['attendance_date' => SORT_DESC]);

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
            'attendance_date' => $this->attendance_date,
            'check_in_date' => $this->check_in_date,
            'check_in_time' => $this->check_in_time,
            'check_out_date' => $this->check_out_date,
            'check_out_time' => $this->check_out_time,
            'stay_time' => $this->stay_time,
            'created_by' => $this->created_by,
            'created_on' => $this->created_on,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
	
	public function advanceSearch($params, $id, $attendancedate)
    {
		$MonthYear = explode("/",$attendancedate);
        // $query = Attendance::find()->where(['status' => '1','user_id' => $id])
        // ->orderBy(['attendance_date' => SORT_ASC]);
		
		$query = Attendance::find()
		->where(['status' => '1','user_id' => $id])
		->andWhere(['=','month(`attendance_date`)', $MonthYear[0]]) //'0' for month
		->andWhere(['=','year(`attendance_date`)', $MonthYear[1]]) // '1' for year
		->orderBy(['attendance_date' => SORT_ASC]);
		
		// echo '<pre>';
        // echo print_r($query);
        // echo '</pre>';
		// die();

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
            'attendance_date' => $this->attendance_date,
            'check_in_date' => $this->check_in_date,
            'check_in_time' => $this->check_in_time,
            'check_out_date' => $this->check_out_date,
            'check_out_time' => $this->check_out_time,
            'stay_time' => $this->stay_time,
            'created_by' => $this->created_by,
            'created_on' => $this->created_on,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
