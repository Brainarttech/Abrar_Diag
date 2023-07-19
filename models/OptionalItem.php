<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "optional_item".
 *
 * @property int $id
 * @property string $product_name
 * @property int $cat_id
 * @property int $status 1 = Active 0= InActive
 * @property int $required 1=True 0=False
 * @property int $default_quantity
 * @property int $created_by
 * @property string $created_on
 * @property int $updated_by
 * @property string $updated_on
 */
class OptionalItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'optional_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_name', 'created_by', 'created_on'], 'required'],
            [['cat_id', 'required', 'default_quantity', 'status', 'created_by', 'updated_by'], 'integer'],
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
            'product_name' => 'Product Name',
            'cat_id' => 'Department',
            'required' => 'Required',
            'default_quantity' => 'Default Quantity',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
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