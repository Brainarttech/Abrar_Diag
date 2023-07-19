<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inventory".
 *
 * @property int $id
 * @property string $cost_price
 * @property string $sale_price
 * @property int $quantity
 * @property string $discount
 * @property int $purchase_id
 * @property int $variant_id
 * @property int $product_id
 * @property int $unit_id
 * @property int $sale_unit_id
 * @property string $tax
 * @property int $status
 * @property string $created_on
 * @property int $created_by
 * @property string $updated_on
 * @property int $updated_by
 * @property int $warehouse_id
 * @property string $expiry_date
 * @property string $total
 * @property string $grand_total
 */
class Inventory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inventory';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cost_price', 'sale_price', 'discount', 'tax', 'total', 'grand_total'], 'number'],
            [['quantity', 'purchase_id', 'variant_id', 'product_id', 'unit_id', 'sale_unit_id', 'status', 'created_by', 'updated_by', 'warehouse_id'], 'integer'],
            [['created_on', 'updated_on', 'expiry_date'], 'safe'],
            [[ 'total','quantity', 'variant_id', 'product_id', 'unit_id', 'status', 'warehouse_id'], 'required'],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cost_price' => 'Cost Price',
            'sale_price' => 'Sale Price',
            'quantity' => 'Quantity',
            'discount' => 'Discount',
            'purchase_id' => 'Purchase ID',
            'variant_id' => 'Variant ID',
            'product_id' => 'Product ID',
            'unit_id' => 'Unit ID',
            'sale_unit_id' => 'Sale Unit ID',
            'tax' => 'Tax',
            'status' => 'Status',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'updated_on' => 'Updated On',
            'updated_by' => 'Updated By',
            'warehouse_id' => 'Warehouse ID',
            'expiry_date' => 'Expiry Date',
            'total' => 'Total',
            'grand_total' => 'Grand Total',
        ];
    }
    
    public function getPurchase() {
        return $this->hasOne(Purchase::className(), ['id' => 'purchase_id']);
    }
    
    public function getVariant() {
        return $this->hasOne(Variant::className(), ['id' => 'variant_id']);
    }
    
    public function getProduct(){
        return $this->hasOne(Product::className(),['id' => 'product_id']);
    }
    
    public function getUnit()
    {
        return $this->hasOne(SiUnit::className(), ['id' => 'unit_id']);
    }
    
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
    
    public function getSaleUnit()
    {
        return $this->hasOne(SiUnit::className(), ['id' => 'sale_unit_id']);
    }
}
