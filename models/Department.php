<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property int $id
 * @property int $hospital_id
 * @property string $name
 * @property string $phone_no
 * @property string $status 0 = Inactive , 1 = Active
 * @property string $created_on
 * @property int $created_by
 * @property string $updated_on
 * @property int $updated_by
 *
 * @property Staff[] $staff
 */
class Department extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = '0';
    const STATUS_ACTIVE = '1';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hospital_id', 'name', 'phone_no', 'status', 'created_on', 'created_by'], 'required'],
            [['name'], 'unique'],
            [['hospital_id', 'created_by', 'updated_by'], 'integer'],
            [['status'], 'string'],
            [['created_on', 'updated_on'], 'safe'],
            [['name'], 'string', 'max' => 30],
            [['phone_no'], 'string', 'max' => 17],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hospital_id' => 'Hospital',
            'name' => 'Name',
            'phone_no' => 'Phone No',
            'status' => 'Status',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'updated_on' => 'Updated On',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasMany(Staff::className(), ['department_id' => 'id']);
    }

    public function getHospital()
    {
        return $this->hasOne(Hospital::className(), ['id' => 'hospital_id']);
    }
    
    public function getSales() {
        return $this->hasMany(Sales::className(),['id','sale_id']);
    }
}
