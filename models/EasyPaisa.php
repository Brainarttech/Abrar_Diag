<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "easy_paisa".
 *
 * @property int $id
 * @property int $transaction_id
 * @property int $sale_id
 */
class EasyPaisa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'easy_paisa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['transaction_id', 'sale_id'], 'required'],
            [['transaction_id', 'sale_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'transaction_id' => 'Transaction ID',
            'sale_id' => 'Sale ID',
        ];
    }
}
