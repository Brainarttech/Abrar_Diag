<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_category".
 *
 * @property int $id
 * @property int $department_id
 * @property string $name
 * @property string $status 0 = Inactive , 1 = Active
 * @property int $created_by
 * @property string $created_on
 * @property int $updated_by
 * @property string $updated_on
 *
 * @property Department $department
 * @property ItemName[] $itemNames
 */
class ItemCategory extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = '0';
    const STATUS_ACTIVE = '1';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department_id', 'name', 'status', 'created_by', 'created_on'], 'required'],
            [['name'], 'unique'],
            [['department_id', 'created_by', 'updated_by'], 'integer'],
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
            'department_id' => 'Department',
            'name' => 'Name',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemNames()
    {
        return $this->hasMany(ItemName::className(), ['cat_id' => 'id']);
    }
}
