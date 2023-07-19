<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lab_form_field".
 *
 * @property int $id
 * @property int $lab_form_id
 * @property string $name
 * @property string $result
 * @property string $unit
 * @property string $reference_range
 * @property string $header_name
 * @property int $sort
 * @property string $created_on
 * @property int $created_by
 * @property string $updated_on
 * @property int $updated_by
 */
class LabFormField extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lab_form_field';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lab_form_id', 'name', 'sort', 'created_on', 'created_by'], 'required'],
            [['lab_form_id', 'sort', 'created_by', 'updated_by'], 'integer'],
            [['reference_range'], 'string'],
            [['created_on', 'updated_on'], 'safe'],
            [['name', 'result'], 'string', 'max' => 200],
            [['unit', 'header_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lab_form_id' => 'Lab Form ID',
            'name' => 'Name',
            'result' => 'Result',
            'unit' => 'Unit',
            'reference_range' => 'Reference Range',
            'header_name' => 'Header Name',
            'sort' => 'Sort',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'updated_on' => 'Updated On',
            'updated_by' => 'Updated By',
        ];
    }
    
    public function getLabFormFeildSubmit(){
         return $this->hasMany(LabFormFieldSubmit::className(), ['lab_form_submit_id' => 'id']);
    }
    
}
