<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mop".
 *
 * @property int $id
 * @property string $name
 * @property string $status 0 = Off, 1 = On
 * @property int $created_by
 * @property string $created_on
 * @property int $updated_by
 * @property string $updated_on
 *
 * @property Payment[] $payments
 */
class Mop extends \yii\db\ActiveRecord
{
    const EASY_PAISA = 5;
    const JAZZ_CASH = 6;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mop';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'status'], 'required'],
            [['name'], 'unique'],
            [['status'], 'string'],
            [['created_by', 'updated_by'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['name'], 'string', 'max' => 50],
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
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['mop_id' => 'id']);
    }
}
