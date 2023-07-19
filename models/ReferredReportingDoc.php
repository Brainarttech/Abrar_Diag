<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "referred_reporting_doc".
 *
 * @property int $id
 * @property string $name
 * @property int $dep_id
 * @property string $hospital_name
 * @property int $status
 * @property string $created_on
 * @property int $created_by
 * @property string $updated_on
 * @property int $updated_by
 */
class ReferredReportingDoc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'referred_reporting_doc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dep_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['name', 'hospital_name'], 'string', 'max' => 255],
            [['name', 'hospital_name','dep_id'], 'required'],
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
            'dep_id' => 'Dep ID',
            'hospital_name' => 'Hospital Name',
            'status' => 'Status',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'updated_on' => 'Updated On',
            'updated_by' => 'Updated By',
        ];
    }
    
    public function getReferredReporting()
    {
        return $this->hasMany(ReferredReport::className(), ['referred_reporting_doc'=>'id']);
    }
    
    public function getDepartment(){
        return $this->hasOne(Department::className(),['id' => 'dep_id']);
    }
    
    public function getUser() {
        return $this->hasOne(User::className(),['id' => 'created_by']);
    }
}
