<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account_group".
 *
 * @property int $id
 * @property string $account_name
 * @property string $accounts_type
 */
class AccountGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'account_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_name', 'accounts_type'], 'required'],
            [['accounts_type'], 'string'],
            [['account_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'account_name' => 'Account Name',
            'accounts_type' => 'Accounts Type',
        ];
    }

    public function accountsTypeCount($type)
    {
        //return $this->find()->joinWith(['chartsOfAccounts'])->where(['in', 'accounts_type', $type])->count();
        return $this->find()->joinWith(['chartsOfAccounts'])->where(['accounts_type' => $type])->asArray()->all();
    }

    public static function accountsTypeData($accountType)
    {
        //return AccountGroup::find()->where(['accounts_type' => $accountType])->one();
        return AccountGroup::find()->joinWith(['chartsOfAccounts'])->where(['accounts_type' => $accountType])->asArray()->all();
    }

    public function getChartsOfAccounts()
    {
        return $this->hasMany(ChartsOfAccounts::className(), ['account_group_id' => 'id']);
    }
}
