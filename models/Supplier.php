<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supplier".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $number
 * @property string $vat_no
 * @property string $balance
 * @property string $address
 * @property int $status
 * @property string $created_on
 * @property int $created_by
 * @property string $updated_on
 * @property int $updated_by
 */
class Supplier extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'supplier';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['balance'], 'number'],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['status', 'name', 'email','address','number'], 'required'],
            [['created_on', 'updated_on'], 'safe'],
            [['name', 'email', 'vat_no', 'address'], 'string', 'max' => 255],
            [['number'], 'string', 'max' => 50],
            [['email'], 'unique'],
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
            'email' => 'Email',
            'number' => 'Number',
            'vat_no' => 'Vat No',
            'balance' => 'Balance',
            'address' => 'Address',
            'status' => 'Status',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'updated_on' => 'Updated On',
            'updated_by' => 'Updated By',
        ];
    }
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}
