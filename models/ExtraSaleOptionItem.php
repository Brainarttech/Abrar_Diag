<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "extra_sale_option_item".
 *
 * @property int $id
 * @property int $sale_item_id
 * @property int $item_id
 * @property string $product_name
 * @property int $product_quantity
 * @property int $status 1=Active 0=InActive
 * @property string $created_on
 * @property int $created_by
 * @property string $updated_on
 * @property int $updated_by
 */
class ExtraSaleOptionItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'extra_sale_option_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sale_item_id', 'product_name', 'product_quantity', 'created_on', 'created_by'], 'required'],
            [['sale_item_id', 'product_quantity', 'status', 'created_by', 'updated_by'], 'integer'],
            [['item_id'], 'integer'],

            [['created_on', 'updated_on'], 'safe'],
            [['product_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sale_item_id' => 'Sale Item ID',
            'product_name' => 'Product Name',
            'product_quantity' => 'Product Quantity',
            'status' => 'Status',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'updated_on' => 'Updated On',
            'updated_by' => 'Updated By',
        ];
    }
}
