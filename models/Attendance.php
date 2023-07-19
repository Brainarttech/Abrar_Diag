<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attendance".
 *
 * @property int $id
 * @property int $user_id
 * @property string $attendance_date
 * @property string $check_in_date
 * @property string $check_in_time
 * @property string $check_out_date
 * @property string $status 0 = Inactive , 1 = Active
 * @property string $check_out_time
 * @property string $stay_time
 * @property int $created_by
 * @property string $created_on
 * @property int $updated_by
 * @property string $updated_on
 */
class Attendance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attendance';
    }

    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['user_id', 'attendance_date', 'check_in_date', 'check_in_time', 'check_out_date', 'check_out_time', 'stay_time'], 'required'],
            [['user_id', 'created_by', 'updated_by'], 'integer'],
            [['attendance_date', 'check_in_date', 'check_in_time', 'check_out_date', 'check_out_time', 'stay_time', 'created_on', 'updated_on'], 'safe'],
            [['status'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'attendance_date' => 'Attendance Date',
            'check_in_date' => 'Check In Date',
            'check_in_time' => 'Check In Time',
            'check_out_date' => 'Check Out Date',
            'status' => 'Status',
            'check_out_time' => 'Check Out Time',
            'stay_time' => 'Stay Time',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
        ];
    }

    public function getProfilename()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
