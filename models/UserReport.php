<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "report".
 *
 * @property int $id
 * @property string $value
 * @property int $status
 */
class UserReport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'report_user';
    }

    /**
     * {@inheritdoc}
     */
    // public function rules()
    // {
    //     return [
          
    //         [['invoice_id'], 'integer'],
    //         [['item_id'], 'integer'],
    //         [['report'], 'string'],

    //     ];
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function attributeLabels()
    // {
    //     return [
    //         'id' => 'id',
    //         'invoice_id' => 'integer',
    //         'item_id' => 'integer',
    //         'report' => 'integer',
    //     ];
    // }
}
