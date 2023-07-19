<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lab_form".
 *
 * @property int $id
 * @property string $form_name
 * @property string $title
 * @property string $created_on
 * @property int $created_by
 * @property string $updated_on
 * @property int $updated_by
 */
class LabForm extends \yii\db\ActiveRecord
{
    public $item_names = [];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lab_form';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['form_name', 'created_on', 'created_by','title'], 'required'],
            [[ 'created_by', 'updated_by'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['form_name','title'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'form_name' => 'Form Name',
            'title' => 'Title',
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

   
    
    public function getItemNames(){
        return $this->hasMany(ItemName::className(), ['id' => 'item_name_id'])->viaTable('lab_form_item_name', ['lab_form_id' => 'id']);;
    }



}
