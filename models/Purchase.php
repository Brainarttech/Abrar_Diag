<?php

namespace app\models;
use yii\web\UploadedFile;
use Yii;
use dosamigos\fileupload\FileUpload;
/**
 * This is the model class for table "purchase".
 *
 * @property int $id
 * @property string $paid
 * @property string $order_discount
 * @property string $product_discount
 * @property string $total
 * @property string $balance
 * @property string $due_date
 * @property string $note
 * @property string $attachment
 * @property int $hospital_id
 * @property int $supplier_id
 * @property int $invoice_number
 * @property int $status
 * @property string $created_on
 * @property int $created_by
 * @property string $updated_on
 * @property int $updated_by
 */
class Purchase extends \yii\db\ActiveRecord {

    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'purchase';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['paid', 'order_discount', 'product_discount', 'total', 'balance'], 'number'],
            [['due_date', 'created_on', 'updated_on'], 'safe'],
            [[ 'hospital_id', 'supplier_id', 'status','invoice_number'], 'integer'],
            [[ 'hospital_id', 'supplier_id', 'status','invoice_number'], 'required'],
            [['note'], 'string', 'max' => 255],
            
            //[['file'], 'file', 'skipOnEmpty' => True, 'extensions' => 'png,jpg,Jpeg,JPEG'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'paid' => 'Paid',
            'order_discount' => 'Order Discount',
            'product_discount' => 'Product Discount',
            'total' => 'Total',
            'balance' => 'Balance',
            'due_date' => 'Due Date',
            'note' => 'Note',
            'attachment' => 'Attachment',
            'hospital_id' => 'Hospital ID',
            'supplier_id' => 'Supplier ID',
            'invoice_number' => 'Invoice Number',
            'status' => 'Status',
            'created_on' => 'Created On',
            'created_by' => 'Created By',
            'updated_on' => 'Updated On',
            'updated_by' => 'Updated By',
        ];
    }

    public function getSupplier() {
        return $this->hasOne(Supplier::className(), ['id' => 'supplier_id']);
    }

    public function getInventories() {
        return $this->hasMany(Inventory::className(), ['purchase_id' => 'id']);
    }

    public function getHospital() {
        return $this->hasOne(Hospital::className(), ['id' => 'hospital_id']);
    }

   

    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getUpdatedUser() {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    public function upload() {
        if ($this->validate()) {
            $this->file->saveAs('uploads/' . $this->file->baseName . '.' . $this->file->extension);
            return true;
        } else {
            return false;
        }
    }

}
