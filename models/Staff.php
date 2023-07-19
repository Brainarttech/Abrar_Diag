<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "staff".
 *
 * @property int $id
 * @property int $department_id
 * @property string $name
 * @property string $cnic
 * @property string $phone_no
 * @property string $address
 * @property string $status 0 = Inactive , 1 = Active
 * @property string $staff_type
 * @property string $image
 * @property int $created_by
 * @property string $created_on
 * @property int $updated_by
 * @property string $updated_on
 *
 * @property Department $department
 */
class Staff extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staff';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department_id', 'name', 'cnic', 'phone_no', 'address', 'status', 'staff_type', 'image', 'created_by', 'created_on'], 'required'],
            [['department_id', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'unique'],
            [['status'], 'string'],
            [['created_on', 'updated_on'], 'safe'],
            [['name', 'staff_type'], 'string', 'max' => 50],
            [['cnic'], 'string', 'max' => 15],
            [['phone_no'], 'string', 'max' => 17],
            [['address'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 150],
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
            'cnic' => 'Cnic',
            'phone_no' => 'Phone No',
            'address' => 'Address',
            'status' => 'Status',
            'staff_type' => 'Staff Type',
            'image' => 'Image',
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
}
