<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "extra_sale_item".
 *
 * @property int $id
 * @property int $sale_item_id
 * @property int $item_id
 * @property string $item_name
 * @property string $item_description
 * @property string $item_rate
 * @property string $item_quantity
 * @property string $status 0 = Inactive , 1 = Active
 * @property string $created_on
 * @property int $created_by
 * @property string $updated_on
 * @property int $updated_by
 */
class ExtraSaleItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'extra_sale_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sale_item_id', 'item_name', 'item_quantity', 'status', 'created_on', 'created_by'], 'required'],
            [['sale_item_id', 'item_id', 'created_by', 'updated_by'], 'integer'],
            [['item_rate', 'item_quantity'], 'number'],
            [['status'], 'string'],
            [['created_on', 'updated_on'], 'safe'],
            [['item_name'], 'string', 'max' => 50],
            [['item_description'], 'string', 'max' => 1000],
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
            'item_id' => 'Item ID',
            'item_name' => 'Item Name',
            'item_description' => 'Item Description',
            'item_rate' => 'Item Rate',
            'item_quantity' => 'Item Quantity',
            'status' => 'Status',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'updated_on' => 'Updated On',
            'updated_by' => 'Updated By',
        ];
    }
}
