<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "referred_doctor".
 *
 * @property int $id
 * @property string $name
 * @property string $hospital_name
 * @property string $cnic
 * @property string $phone_no
 * @property string $email
 * @property string $address
 * @property int $commission
 * @property string $status 0 = Inactive , 1 = Active
 * @property int $created_by
 * @property string $created_on
 * @property int $updated_by
 * @property string $updated_on
 *
 * @property Sales[] $sales
 */
class ReferredDoctor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'referred_doctor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'status', 'created_by', 'created_on'], 'required'],
            [['name'], 'unique'],
            [['commission', 'created_by', 'updated_by'], 'integer'],
            [['status'], 'string'],
            [['created_on', 'updated_on'], 'safe'],
            [['name', 'hospital_name', 'email'], 'string', 'max' => 50],
            [['cnic'], 'string', 'max' => 15],
            [['phone_no'], 'string', 'max' => 17],
            [['address'], 'string', 'max' => 255],
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
            'hospital_name' => 'Hospital Name',
            'cnic' => 'Cnic',
            'phone_no' => 'Phone No',
            'email' => 'Email',
            'address' => 'Address',
            'commission' => 'Commission',
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
    public function getSales()
    {
        return $this->hasMany(Sales::className(), ['referred_doctor_id' => 'id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);

    }
}
