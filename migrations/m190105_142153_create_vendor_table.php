<?php

use yii\db\Migration;

/**
 * Handles the creation of table `vendor`.
 */
class m190105_142153_create_vendor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('vendor', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'email' => $this->string()->unique(),
            'number' => $this->string(50)->defaultValue(null),
            'vat_no' => $this->string(),
            'balance' => $this->decimal(9,2)->defaultValue(null),
            'address' => $this->string()->defaultValue(null),
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
        $this->dropTable('vendor');
    }
}
