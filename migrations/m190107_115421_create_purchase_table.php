<?php

use yii\db\Migration;

/**
 * Handles the creation of table `purchase`.
 */
class m190107_115421_create_purchase_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('purchase', [
            'id' => $this->primaryKey(),
            'paid' => $this->decimal(60,2),
            'order_discount' => $this->decimal(9,2)->defaultValue(null),
            'product_discount' => $this->decimal(9,2)->defaultValue(null),
            'total' => $this->decimal(60,2),
            'balance' => $this->decimal(60,2),
            'due_date' => $this->date()->defaultValue(null),
            'note' => $this->string()->defaultValue(null),
            'attachment' => $this->string()->defaultValue(null),
            'hospital_id' => $this->integer(),
            'supplier_id' => $this->integer(),
            'invoice_number' => $this->integer(),
            'status' => "ENUM('Payment Pending', 'Partialy Paid', 'Paid')",
            'created_on' => $this->dateTime(),
            'created_by' => $this->integer(),
            'updated_on' => $this->dateTime()->defaultValue(null),
            'updated_by' => $this->integer()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('purchase');
    }
}
