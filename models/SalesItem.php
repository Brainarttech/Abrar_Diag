<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sale_item".
 *
 * @property int $id
 * @property int $sale_id
 * @property int $item_id
 * @property string $item_name
 * @property int $item_price
 * @property int $item_discount
 * @property string $item_discount_type
 * @property int $discount_reason
 * @property int $consultant_amount
 * @property string $comment
 * @property int $refund_surcharge
 * @property int $refund_amount
 * @property string $refund_on
 * @property int $refund_by
 * @property string $test_status 1=Pending 2=Complete 3=Refund
 * @property string $status 0 = InActive, 1 = Active
 * @property int $created_by
 * @property string $created_on
 * @property int $updated_by
 * @property string $updated_on
 */
class SalesItem extends \yii\db\ActiveRecord {

    public $my_sum;
    public $department_id;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'sale_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['sale_id', 'item_id', 'item_name', 'item_price', 'status', 'created_by', 'created_on'], 'required'],
            [['sale_id', 'item_id', 'department_id', 'discount_reason', 'refund_amount', 'refund_surcharge', 'item_discount', 'item_price', 'consultant_amount', 'created_by', 'refund_by', 'updated_by'], 'integer'],
            [['status'], 'string'],
            [['test_status', 'status'], 'string'],
            [['created_on', 'refund_on', 'updated_on'], 'safe'],
            [['item_name'], 'string', 'max' => 50],
            [['item_discount_type'], 'string', 'max' => 10],
            [['comment'], 'string', 'max' => 5000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'sale_id' => 'Sale ID',
            'item_id' => 'Item ID',
            'department_id' => 'Department ID',
            'item_name' => 'Item Name',
            'item_price' => 'Item Price',
            'item_discount' => 'Item Discount',
            'item_discount_type' => 'Item Discount Type',
            'discount_reason' => 'Discount Reason',
            'consultant_amount' => 'Consultant Amount',
            'comment' => 'Comment',
            'refund_surcharge' => 'Refund Surcharge',
            'refund_amount' => 'Refund Amount',
            'refund_on' => 'Refund On',
            'refund_by' => 'Refund By',
            'test_status' => 'Test Status',
            'status' => 'Status',
            'created_by' => 'Sale By',
            'created_on' => 'Date',
            'updated_by' => 'Complete By',
            'updated_on' => 'Complete Date',
        ];
    }

    public function getItem() {
        return $this->hasOne(ItemName::className(), ['id' => 'item_id']);
    }

    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getUpdate() {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    public function getExtra() {
        return $this->hasMany(ExtraSaleItem::className(), ['sale_item_id' => 'id']);
    }

    public function getLabForm() {
        return $this->hasMany(LabForm::className(), ['id' => 'lab_form_id'])->viaTable('lab_form_item_name', ['item_name_id' => 'item_id']);
    }

    public function getLabForms() {
        return $this->hasMany(LabForm::className(), ['item_name_id' => 'item_id']);
    }

    public function getSale() {
        return $this->hasOne(Sales::className(), ['id' => 'sale_id']);
    }

    public function getExtraSaleOptionItem() {
        return $this->hasMany(ExtraSaleOptionItem::className(), ['sale_item_id' => 'id']);
    }

    public function getLabFormSubmit() {
        return $this->hasOne(LabFormSubmit::className(), ['sale_item_id' => 'id']);
    }

    public function getReferredReport() {
        return $this->hasMany(ReferredReport::className(), ['sale_item_id' => 'id'])->orderBy(['referred_report.id' => SORT_DESC])->One();
    }

    public function getReport(){
        return $this->hasMany(ReferredReport::className(), ['sale_item_id' => 'id']);
    }
    public static function getTotalDiscount($provider) {
        $total = 0;
        $flag = 0;
        foreach ($provider as $key => $item) {
            if ($item->sale_id === $provider[$key + 1]->sale_id) {
                if ($flag == 0) {
                    $total += $item['sale']->discount;
                    $flag = 1;
                }
            } else {
                $total += $provider[$key + 1]['sale']->discount;
            }
        }
        return number_format($total);
    }

    public static function getTotalGrandTotal($provider) {
        $total = 0;
        $flag = 0;
        foreach ($provider as $key => $item) {
            if ($item->sale_id === $provider[$key + 1]->sale_id) {
                if ($flag == 0) {
                    $total += $item['sale']->grand_total;
                    $flag = 1;
                }
            } else {
                $total += $provider[$key + 1]['sale']->grand_total;
            }
        }
        return number_format($total);
    }

    public static function getTotalPaidAmount($provider) {
        $total = 0;
        $flag = 0;
        foreach ($provider as $key => $item) {
            if ($item->sale_id === $provider[$key + 1]->sale_id) {
                if ($flag == 0) {
                    $total += $item['sale']->paid_amount;
                    $flag = 1;
                }
            } else {
                $total += $provider[$key + 1]['sale']->paid_amount;
            }
        }
        return number_format($total);
    }

    public static function getTotalRemainingAmount($provider) {
        $total_grand = 0;
        $total_paid = 0;
        $flag = 0;
        foreach ($provider as $key => $item) {
            if ($item->sale_id === $provider[$key + 1]->sale_id) {
                if ($flag == 0) {
                    $total_grand += $item['sale']->grand_total;
                    $total_paid += $item['sale']->paid_amount;
                    $flag = 1;
                }
            } else {
                $total_grand += $provider[$key + 1]['sale']->grand_total;
                $total_paid += $provider[$key + 1]['sale']->paid_amount;
            }
        }
        $sum = $total_grand - $total_paid;
        return number_format($sum);
    }

}
