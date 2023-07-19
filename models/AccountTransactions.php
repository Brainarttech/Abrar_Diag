<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account_transactions".
 *
 * @property int $id
 * @property int $charts_of_accounts_id
 * @property int $debit
 * @property int $credit
 * @property string $description
 * @property string $account_used
 * @property string $created_on
 * @property int $created_by
 * @property string $updated_on
 * @property int $updated_by
 *
 * @property ChartsOfAccounts $chartsOfAccounts
 */
class AccountTransactions extends \yii\db\ActiveRecord
{

    public $actype;

    //public $subcat;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'account_transactions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['actype', /*'subcat',*/ 'charts_of_accounts_id', 'debit', 'credit', 'description', 'account_used', 'created_on', 'created_by'], 'required'],
            [['charts_of_accounts_id', 'debit', 'credit', 'created_by', 'updated_by'], 'integer'],
            [['actype', /*'subcat',*/ 'created_on', 'updated_on'], 'safe'],
            [['description'], 'string', 'max' => 500],
            [['account_used'], 'string', 'max' => 255],
            [['charts_of_accounts_id'], 'exist', 'skipOnError' => true, 'targetClass' => ChartsOfAccounts::className(), 'targetAttribute' => ['charts_of_accounts_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'charts_of_accounts_id' => 'Charts Of Accounts ID',
            'debit' => 'Debit',
            'credit' => 'Credit',
            'description' => 'Description',
            'account_used' => 'Account Used',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'updated_on' => 'Updated On',
            'updated_by' => 'Updated By',
            'actype' => 'Deposit Or With Drawl',
            //'subcat' => 'Sub Category',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChartsOfAccounts()
    {
        return $this->hasOne(ChartsOfAccounts::className(), ['id' => 'charts_of_accounts_id']);
    }
}
