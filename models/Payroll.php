<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payroll".
 *
 * @property string $id
 * @property int $user_id
 * @property string $payment_month
 * @property string $payment_date
 * @property string $monthly_salary
 * @property int $no_days_absent
 * @property string $basic_allow
 * @property string $hra_allow
 * @property string $conveyance_allow
 * @property string $medical_allow
 * @property string $splallow
 * @property string $tax
 * @property string $provident_fund
 * @property string $loan
 * @property string $overtime_salary
 * @property string $total_salary
 * @property string $payment_type
 * @property string $status 0 = Inactive , 1 = Active
 * @property int $created_by
 * @property string $created_on
 * @property int $updated_by
 * @property string $updated_on
 */
class Payroll extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payroll';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'payment_month', 'payment_date', 'actual_salary', 'monthly_salary', 'no_days_month', 'no_days_absent', 'no_days_present', 'paid_salary', 'payment_type', 'status', 'created_by', 'created_on'], 'required'],
            //[['payment_month'], 'unique', 'message' => 'You already Paid for this Month'],
			[['payment_month'], 'unique', 'targetAttribute' => ['payment_month', 'user_id'], 'message' => 'You already Paid for this Month'],
			
			//[['payment_month', 'user_id'], 'unique', 'targetAttribute' => ['payment_month', 'user_id']],
			//['payment_month', 'unique', 'targetAttribute' => ['payment_month', 'user_id']],
            [['user_id', 'actual_salary', 'monthly_salary', 'no_days_absent', 'no_days_month', 'no_days_present', 'overtime_salary', 'paid_salary', 'created_by', 'updated_by'], 'integer'],
            [['payment_month', 'payment_date', 'created_on', 'updated_on'], 'safe'],
            [['payment_type', 'status'], 'string'],
            [['basic_allow', 'hra_allow', 'conveyance_allow', 'medical_allow', 'splallow', 'tax', 'provident_fund', 'loan'], 'string', 'max' => 50],
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
            'payment_month' => 'Payment Month',
            'payment_date' => 'Payment Date',
            'actual_salary' => 'Actual Salary',
            'monthly_salary' => 'Monthly Salary',
            'no_days_absent' => 'No Days Absent',
            'no_days_month' => 'No Days Month',
            'no_days_present' => 'No Days Present',
            'basic_allow' => 'Basic Allow',
            'hra_allow' => 'Hra Allow',
            'conveyance_allow' => 'Conveyance Allow',
            'medical_allow' => 'Medical Allow',
            'splallow' => 'Splallow',
            'tax' => 'Tax',
            'provident_fund' => 'Provident Fund',
            'loan' => 'Loan',
            'overtime_salary' => 'Overtime Salary',
            'paid_salary' => 'Paid Salary',
            'payment_type' => 'Payment Type',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
        ];
    }
}
