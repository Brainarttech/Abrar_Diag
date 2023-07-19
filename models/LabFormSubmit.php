<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lab_form_submit".
 *
 * @property int $id
 * @property int $sale_item_id
 * @property int $lab_form_id
 * @property string $lab_form_name
 * @property int $item_name_id
 * @property string $item_name_name
 * @property int $patient_id
 * @property string $created_on
 * @property int $created_by
 * @property string $updated_on
 * @property int $updated_by
 */
class LabFormSubmit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lab_form_submit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sale_item_id', 'lab_form_id', 'lab_form_name', 'item_name_id', 'item_name_name', 'created_on', 'created_by'], 'required'],
            [['sale_item_id', 'lab_form_id', 'item_name_id', 'patient_id', 'created_by', 'updated_by'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['lab_form_name'], 'string', 'max' => 100],
            [['item_name_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sale_item_id' => 'Sale Item ID',
            'lab_form_id' => 'Lab Form ID',
            'lab_form_name' => 'Lab Form Name',
            'item_name_id' => 'Item Name ID',
            'item_name_name' => 'Item Name Name',
            'patient_id' => 'Patient ID',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'updated_on' => 'Updated On',
            'updated_by' => 'Updated By',
        ];
    }
	
	public function getLabFormFieldSubmit()
    {
        return $this->hasMany(LabFormFieldSubmit::className(), ['lab_form_submit_id' => 'id']);
    }
}
