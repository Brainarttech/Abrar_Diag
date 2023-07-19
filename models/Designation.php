<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "designation".
 *
 * @property int $id
 * @property string $designation_name
 * @property string $status 0 = Inactive , 1 = Active
 * @property string $created_on
 * @property int $created_by
 * @property string $updated_on
 * @property int $updated_by
 */
class Designation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'designation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['designation_name', 'status', 'created_on', 'created_by'], 'required'],
            [['designation_name'], 'unique'],
            [['created_by', 'updated_by'], 'integer'],
            [['status'], 'string'],
            [['created_on', 'updated_on'], 'safe'],
            [['designation_name'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'designation_name' => 'Designation Name',
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
