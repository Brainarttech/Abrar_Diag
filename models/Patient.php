<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "patient".
 *
 * @property int $id
 * @property string $name
 * @property string $cnic
 * @property string $phone_no
 * @property string $reg_no
 * @property string $email
 * @property string $gender
 * @property int $age
 * @property string $age_type
 * @property string $relationship
 * @property string $whatsapp_no
 * @property string $city
 * @property string $country
 * @property string $address
 * @property int $referred_by_id
 * @property int $panel_id
 * @property string $status 0 = InActive , 1 = Active
 * @property string $created_on
 * @property int $created_by
 * @property string $updated_on
 * @property int $updated_by
 */
class Patient extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'patient';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'phone_no', 'reg_no', 'gender', 'age', 'relationship', 'city', 'country', 'status', 'created_on', 'created_by'], 'required'],
            [['age', 'referred_by_id', 'panel_id', 'created_by', 'updated_by'], 'integer'],
            [['age_type', 'status'], 'string'],
            [['reg_no'],'unique'],
            [['created_on', 'updated_on'], 'safe'],
            [['name', 'reg_no', 'email'], 'string', 'max' => 50],
            [['cnic'], 'string', 'max' => 15],
            [['phone_no', 'whatsapp_no'], 'string', 'max' => 17],
            [['gender'], 'string', 'max' => 6],
            [['relationship'], 'string', 'max' => 30],
            [['city', 'country'], 'string', 'max' => 100],
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
            'cnic' => 'Cnic',
            'phone_no' => 'Phone No',
            'reg_no' => 'Reg No #',
            'email' => 'Email',
            'gender' => 'Gender',
            'age' => 'Age',
			'age_type' => 'Age Type',
            'relationship' => 'Relationship',
            'whatsapp_no' => 'Whatsapp No',
            'city' => 'City',
            'country' => 'Country',
            'address' => 'Address',
            'referred_by_id' => 'Referred By ID',
            'panel_id' => 'Panel ID',
            'status' => 'Status',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'updated_on' => 'Updated On',
            'updated_by' => 'Updated By',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);

    }
}
