<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property int $category_id
 * @property int $status
 * @property string $created_on
 * @property int $created_by
 * @property string $updated_on
 * @property int $updated_by
 * @property int $brand_id
 */
class Product extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['code', 'name','category_id', 'status','brand_id'], 'required'],
            [['description'], 'string'],
            [['category_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['code', 'name'], 'string', 'max' => 255,],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'description' => 'Description',
            'category_id' => 'Category ID',
            'status' => 'Status',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'updated_on' => 'Updated On',
            'updated_by' => 'Updated By',
            'brand_id' => 'Brand',
        ];
    }

    public function getCategory() {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getVariants() {
        return $this->hasMany(Variant::className(), ['product_id' => 'id']);
    }

    public function getDepartmentProducts() {
        return $this->hasMany(DepartmentProduct::className(), ['product_id' => 'id']);
    }
    
    public function getInventory(){
        return $this->hasMany(Inventory::className(), ['product_id' => 'id']);
    }
    
    public function getProductRequests(){
        return $this->hasMany(ProductRequest::className(), ['product_id' => 'id']);
    }
    
    public function getProductWaste() {
        return $this->hasMany(ProductWaste::className(), ['product_id' => 'id']);
    }
    
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
    
    public function getBrand(){
        return $this->hasOne(Brand::className(), ['id' => 'brand_id']);
    }
}
