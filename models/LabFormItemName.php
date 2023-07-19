<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lab_form_item_name".
 *
 * @property int $id
 * @property int $lab_form_id
 * @property int $item_name_id
 */
class LabFormItemName extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lab_form_item_name';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lab_form_id', 'item_name_id'], 'integer'],
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
            'item_name_id' => 'Item Name',
        ];
    }
}
