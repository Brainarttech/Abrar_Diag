<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "variant".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property string $created_on
 * @property int $created_by
 * @property string $updated_on
 * @property int $updated_by
 */
class Variant extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'variant';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'updated_on' => 'Updated On',
            'updated_by' => 'Updated By',
        ];
    }

   
    public function getProducts(){
        return $this->hasMany(Product::className(),['variant_id' => 'id']);
    }
    
    public function getDepartmentProducts() {
        return $this->hasMany(DepartmentProduct::className(), ['variant_id' => 'id']);
    }

    public function getInventories() {
        return $this->hasMany(Inventory::className(), ['variant_id' => 'id']);
    }

    public function getProductWaste() {
        return $this->hasMany(ProductWaste::className(), ['variant_id' => 'id']);
    }

    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
    
    
}
