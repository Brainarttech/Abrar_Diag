<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "referred_report".
 *
 * @property int $id
 * @property int $referred_reporting_doc_id
 * @property int $films_issued
 * @property int $report_issued
 * @property int $sale_id
 * @property string $status
 * @property string $created_on
 * @property int $created_by
 * @property string $updated_on
 * @property int $updated_by
 */
class ReferredReport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'referred_report';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['referred_reporting_doc_id', 'films_issued', 'report_issued', 'sale_item_id', 'created_by', 'updated_by'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['status'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'referred_reporting_doc_id' => 'Referred Reporting Doc ID',
            'films_issued' => 'Films Issued',
            'report_issued' => 'Report Issued',
            'sale_item_id' => 'Sale Item ID',
            'status' => 'Status',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'updated_on' => 'Updated On',
            'updated_by' => 'Updated By',
        ];
    }
    
    public function getDoc(){
        return $this->hasOne(ReferredReportingDoc::className(), ['id'=> 'referred_reporting_doc_id']);
    }
        
    public function getSaleItem(){
        return $this->hasOne(SalesItem::className(),['id' => 'sale_item_id']);
    }
    
    public function getUser(){
        return $this->hasOne(User::className(),['id'=> 'created_by']);
    }
}
