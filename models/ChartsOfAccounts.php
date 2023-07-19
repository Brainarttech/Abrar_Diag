<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "charts_of_accounts".
 *
 * @property int $id
 * @property string $account_name
 * @property int $account_group_id
 * @property string $account_code
 * @property string $account_description
 * @property string $created_on
 * @property int $created_by
 * @property string $updated_on
 * @property int $updated_by
 *
 * @property AccountGroup $accountGroup
 */
class ChartsOfAccounts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'charts_of_accounts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_name', 'account_group_id', 'created_on', 'created_by'], 'required'],
            //[['account_name','account_code'], 'unique'],

            //[['account_name', 'account_code'], 'unique', 'on'=>'create'],

            /*[['account_name'], 'unique', 'when' => function ($model, $attribute) {
                return $model->{$attribute} !== $model->getOldAttribute($attribute); }
                , 'on' => 'update'],*/
            //[['username', 'email'], 'unique', 'on' => 'signup' ],

            [['account_name','account_code'], 'unique', 'on'=>'create'], //, 'account_code'

            [['account_code'], 'unique', 'on'=>'update', 'when' => function($model) {
                return $model->isAttributeChanged('account_code');
            }],//'account_name',

            [['account_name'], 'unique', 'on'=>'update', 'when' => function($model) {
                return $model->isAttributeChanged('account_name');
            }],

            /*['account_name', 'unique', 'on'=>'update', 'when' => function($model){return $model->isAttributeChanged('account_name')}],*/

/*[['account_name'], 'unique', 'on'=>'update', 'when' => function($model){return $model->isAttributeChanged('account_name')}],*/

            /*[['account_name','account_code'], 'unique', 'on'=>'update', 'when' => function($model){
                return 'abc';//$model->isAttributeChanged('account_code');
            }],*/

            [['account_group_id', 'created_by', 'updated_by'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['account_name'], 'string', 'max' => 30],
            [['account_code'], 'integer'],
            [['account_code'], 'string', 'max' => 30],
            [['account_description'], 'string', 'max' => 300],
            [['account_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => AccountGroup::className(), 'targetAttribute' => ['account_group_id' => 'id']],
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
            'account_group_id' => 'Account Group ID',
            'account_code' => 'Account Code',
            'account_description' => 'Account Description',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'updated_on' => 'Updated On',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountGroup()
    {
        return $this->hasOne(AccountGroup::className(), ['id' => 'account_group_id']);
    }
}
