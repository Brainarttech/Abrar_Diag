<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "si_unit".
 *
 * @property int $id
 * @property string $name
 * @property string $base_value
 * @property string $opration
 * @property int $unit_id
 * @property int $status
 * @property string $created_on
 * @property int $created_by
 * @property string $updated_on
 * @property int $updated_by
 */
class SiUnit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'si_unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['base_value'], 'number'],
            [['opration'], 'string'],
            [['unit_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['status','base_value','name'], 'required'],
            [['created_on', 'updated_on'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'base_value' => 'Base Value',
            'opration' => 'Opration',
            'unit_id' => 'Unit ID',
            'status' => 'Status',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'updated_on' => 'Updated On',
            'updated_by' => 'Updated By',
        ];
    }
    
    public function getDepartmentProducts() {
        return $this->hasMany(DepartmentProduct::className(), ['unit_id' => 'id']);
    }
    
    public function getSaleDepartmentProducts() {
        return $this->hasMany(DepartmentProduct::className(), ['sale_unit_id' => 'id']);
    }
    
    public function getInventories() {
        return $this->hasMany(Inventory::className(), ['unit_id' => 'id']);
    }
    
    public function getSaleInventories() {
        return $this->hasMany(Inventory::className(), ['sale_unit_id' => 'id']);
    }
    
    public function getProductRequests(){
        return $this->hasMany(ProductRequest::className(), ['unit_id' => 'id']);
    }
    
    public function getProductSaleDetails() {
        return $this->hasMany(ProductSaleDetail::className(), ['unit_id' => 'id']);
    }
    
     public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}
