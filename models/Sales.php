<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sale".
 *
 * @property int $id
 * @property int $hospital_id
 * @property int $patient_id
 * @property int $referred_doctor_id
 * @property string $invoice_no
 * @property int $total
 * @property int $discount
 * @property string $discount_type
 * @property int $tax
 * @property int $extra_charges
 * @property int $grand_total
 * @property string $payment_status 0 = due, 1 = paid , 2=Partial
 * @property int $total_items
 * @property int $paid_amount
 * @property int $refund_charges
 * @property string $notes
 * @property int $depart_push_status 1= Push , 0 => No
 * @property string $sale_status 1 = sale, 2 = refund
 * @property string $status 0 = InActive, 1 = Active
 * @property int $created_by
 * @property string $created_on
 * @property int $updated_by
 * @property string $updated_on
 *
 * @property Payment[] $payments
 */
class Sales extends \yii\db\ActiveRecord
{

    public $item_name;
    public $item_category;
    public $total_test;
    public $total_amount;
    public $total_discount;
    public $total_consultant;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sale';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hospital_id','patient_id', 'referred_doctor_id','invoice_no','total', 'discount', 'tax', 'grand_total', 'payment_status', 'total_items', 'paid_amount', 'sale_status', 'status', 'created_by', 'created_on'], 'required'],
            [['hospital_id','patient_id', 'referred_doctor_id','extra_charges', 'depart_push_status','total', 'discount', 'tax', 'grand_total', 'total_items', 'paid_amount', 'refund_charges', 'created_by', 'updated_by'], 'integer'],
            [['payment_status', 'sale_status', 'status'], 'string'],
            [['created_on', 'updated_on','item_name','item_category','total_test','total_discount','total_consultant','total_amount'], 'safe'],
            [['discount_type'], 'string', 'max' => 10],
            [['invoice_no'], 'string', 'max' => 100],

            [['notes'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hospital_id' => 'Hospital',
            'patient_id' => 'Patient',
            'referred_doctor_id' => 'Referred',
            'total' => 'Total',
            'discount' => 'Discount',
            'discount_type' => 'Discount Type',
            'tax' => 'Tax',
            'invoice_no' => 'Receipt No',
            'extra_charges' => 'Extra Charges',
            'grand_total' => 'Grand Total',
            'payment_status' => 'Payment Status',
            'total_items' => 'Total Items',
            'paid_amount' => 'Paid Amount',
            'refund_charges' => 'Refund Charges',
            'notes' => 'Notes',
            'sale_status' => 'Sale Status',
            'depart_push_status' => 'Depart Push Status',
            'status' => 'Status',
            'created_by' => 'Sale By',
            'created_on' => 'Date',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payments::className(), ['sale_id' => 'id']);
    }

    public function getPatient()
    {
        return $this->hasOne(Patient::className(), ['id' => 'patient_id']);
    }

    public function getReferred()
    {
        return $this->hasOne(ReferredDoctor::className(), ['id' => 'referred_doctor_id']);
    }

    public function getSaleitems()
    {

        return $this->hasMany(SalesItem::className(), ['sale_id' => 'id'])->andOnCondition(['sale_item.status' => '1']);
    }

  

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getLatePayment(){
        $payment = Payments::find()->where(['sale_id'=>  $this->id])->andWhere(['created_on' => $this->created_on])->all();
        $sum = $payment->sum('amount');
        return $sum;
    }
}
