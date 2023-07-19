<?php

use yii\db\Migration;

/**
 * Handles the creation of table `purchase_payment`.
 */
class m190312_073323_create_purchase_payment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('purchase_payment', [
            'id' => $this->primaryKey(),
            'purchase_id' => $this->integer(),
            'mop_id' => $this->integer(),
            'amount' => $this->integer(),
            'paid' => $this->integer(),
            'balance' => $this->integer(),
            'payment_status' => "ENUM('1', '2' , '3')",
            'attachment' => $this->string(),
            'status' => $this->boolean(),
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
        $this->dropTable('purchase_payment');
    }
}
