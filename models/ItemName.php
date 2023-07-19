<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_name".
 *
 * @property int $id
 * @property int $cat_id
 * @property string $name
 * @property int $price
 * @property  int consultant_percentage
 * @property string $status 0 = Inactive , 1 = Active
 * @property int $created_by
 * @property string $created_on
 * @property int $updated_by
 * @property string $updated_on
 *
 * @property ItemCategory $cat
 * @property SaleItem[] $saleItems
 */
class ItemName extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_name';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cat_id', 'name', 'price', 'status', 'created_by', 'created_on'], 'required'],
            [['name'], 'unique'],
            [['cat_id', 'price', 'created_by','consultant_percentage', 'updated_by'], 'integer'],
            [['status'], 'string'],
            [['created_on', 'updated_on'], 'safe'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cat_id' => 'Category',
            'name' => 'Name',
            'price' => 'Price',
            'status' => 'Status',
            'consultant_percentage'=>'Consultant %',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    
    
    public function getCategory()
    {
        return $this->hasOne(ItemCategory::className(), ['id' => 'cat_id']);


    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);


    }
    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleItems()
    {
        return $this->hasMany(SaleItem::className(), ['item_id' => 'id']);
    }
}
