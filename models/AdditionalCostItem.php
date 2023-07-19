<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "additional_cost_item".
 *
 * @property int $id
 * @property string $product
 * @property int $rate
 * @property int $cat_id
 * @property int $status 1=Active 0=InActive
 * @property string $created_on
 * @property int $created_by
 * @property string $updated_on
 * @property int $updated_by
 */
class AdditionalCostItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'additional_cost_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product', 'rate', 'created_on', 'created_by'], 'required'],
            [['rate', 'cat_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['product'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product' => 'Product',
            'rate' => 'Price',
            'cat_id' => 'Department',
            'status' => 'Status',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'updated_on' => 'Updated On',
            'updated_by' => 'Updated By',
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(ItemCategory::className(), ['id' => 'cat_id']);


    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);


    }
}
