<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property int $id
 * @property int $sale_id
 * @property string $reference_no
 * @property int $mop_id
 * @property int $amount
 * @property int $discount
 * @property string $discount_type
 * @property string $discount_reason
 * @property int $pos_paid
 * @property int $pos_balance
 * @property string $note
 * @property string $payment_status 0 = Cancel, 1 = Received, 2 = Pending
 * @property string $status 0 = InActive, 1 = Active
 * @property int $created_by
 * @property string $created_on
 * @property int $updated_by
 * @property string $updated_on
 *
 * @property Mop $mop
 * @property Sales $sale
 */
class Payments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sale_id', 'mop_id', 'amount'], 'required'],
            [['sale_id', 'mop_id', 'amount','discount', 'pos_paid', 'pos_balance', 'created_by', 'updated_by'], 'integer'],

            ['amount',function ($attribute, $params,$validator) {
                /* calculate min value */
                $sale = Sales::findOne($this->sale_id);
                $remaining = $sale->grand_total - $sale->paid_amount;
                $min = 1;
                $max = $remaining;
                if ($this->$attribute < $min) {
                    $this->addError($attribute, "Payment must be greater than {$min}.");
                }else if($this->$attribute > $max)
                {
                    $this->addError($attribute, "Payment must be less than Or Equal {$max}.");

                }
            },'on'=>'create'],
            [['payment_status', 'status'], 'string'],
            [['created_on', 'updated_on'], 'safe'],
            [['reference_no', 'discount_type'], 'string', 'max' => 50],
            [['discount_reason'], 'string', 'max' => 200],
            [['note'], 'string', 'max' => 1000],
            [['mop_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mop::className(), 'targetAttribute' => ['mop_id' => 'id']],
            [['sale_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sales::className(), 'targetAttribute' => ['sale_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sale_id' => 'Sale ID',
            'reference_no' => 'Reference No',
            'mop_id' => 'Payment Method',
            'amount' => 'Amount',
            'discount' => 'Discount',
            'discount_type' => 'Discount Type',
            'discount_reason'=>'Discount Reason',
            'pos_paid' => 'Pos Paid',
            'pos_balance' => 'Pos Balance',
            'note' => 'Note',
            'payment_status' => 'Payment Status',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMop()
    {
        return $this->hasOne(Mop::className(), ['id' => 'mop_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSale()
    {
        return $this->hasOne(Sales::className(), ['id' => 'sale_id']);
    }
    
    public function getLatePayment(){
        $payment = Payments::find()->where(['sale_id'=>  $this->id])->andWhere(['created_on' => $this->created_on])->all();
        $sum = $payment->sum('amount');
        return $sum;
    }
    
    public function getPaidAmount(){
        $payments = Payments::find()->where(['sale_id'=>  $this->sale_id])->andWhere(['like' , 'reference_no','PAY'])->all();
        
        return $payments[0]->pos_paid;
    }
}
