<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "discount_key".
 *
 * @property int $id
 * @property string $key_name
 *  * @property string $status 0 = Inactive , 1 = Active
 * @property string $created_on
 * @property int $created_by
 * @property string $updated_on
 * @property int $updated_by
 */
class DiscountKey extends \yii\db\ActiveRecord
{
    const EASY_PAISA = 10;
    const JAZZ_CASH = 11;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'discount_key';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key_name','status', 'created_on', 'created_by'], 'required'],
            [['created_on', 'updated_on'], 'safe'],
            [['status'], 'string'],
            [['created_by', 'updated_by'], 'integer'],
            [['key_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key_name' => 'Key Name',
            'status' => 'Status',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'updated_on' => 'Updated On',
            'updated_by' => 'Updated By',
        ];
    }
}
