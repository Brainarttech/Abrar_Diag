<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hrm_leave".
 *
 * @property int $id
 * @property int $user_id
 * @property string $leave_from
 * @property string $leave_to
 * @property int $leave_type_id
 * @property string $applied_on
 * @property string $leave_reason
 * @property string $comment
 * @property string $leave_status 1=approved,2=pending,3=rejected
 * @property string $status 0 = Inactive , 1 = Active
 * @property string $created_on
 * @property int $created_by
 * @property string $updated_on
 * @property int $updated_by
 */
class Leave extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hrm_leave';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'leave_from', 'leave_to', 'leave_type_id', 'applied_on', 'leave_reason', 'comment', 'status', 'created_on', 'created_by'], 'required'],
            [['user_id', 'leave_type_id', 'created_by', 'updated_by'], 'integer'],
            [['leave_from', 'leave_to', 'applied_on', 'created_on', 'updated_on'], 'safe'],
            [['leave_status', 'status'], 'string'],
            [['leave_reason', 'comment'], 'string', 'max' => 100],
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
            'leave_from' => 'Leave From',
            'leave_to' => 'Leave To',
            'leave_type_id' => 'Leave Type ID',
            'applied_on' => 'Applied On',
            'leave_reason' => 'Leave Reason',
            'comment' => 'Comment',
            'leave_status' => 'Leave Status',
            'status' => 'Status',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'updated_on' => 'Updated On',
            'updated_by' => 'Updated By',
        ];
    }
}
