<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "leave_type".
 *
 * @property int $id
 * @property string $leave_name
 * @property int $leave_quota
 * @property string $status 0 = Inactive , 1 = Active
 * @property string $created_on
 * @property int $created_by
 * @property string $updated_on
 * @property int $updated_by
 */
class LeaveType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hrm_leave_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['leave_name', 'leave_quota', 'status', 'created_on', 'created_by'], 'required'],
            [['leave_quota', 'created_by', 'updated_by'], 'integer'],
            [['status'], 'string'],
            [['created_on', 'updated_on'], 'safe'],
            [['leave_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'leave_name' => 'Leave Name',
            'leave_quota' => 'Leave Quota',
            'status' => 'Status',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'updated_on' => 'Updated On',
            'updated_by' => 'Updated By',
        ];
    }
}
