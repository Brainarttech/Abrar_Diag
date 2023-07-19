<?php

use yii\db\Migration;

/**
 * Handles the creation of table `inventory`.
 */
class m190107_120319_create_inventory_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('inventory', [
            'id' => $this->primaryKey(),
            'cost_price' => $this->decimal(60,2),
            'sale_price' => $this->decimal(9,2),
            'quantity' => $this->integer(),
            'discount' => $this->decimal(60,2),
            'purchase_id' => $this->integer(),
            'variant_id' => $this->integer(),
            'product_id' => $this->integer(),
            'unit_id' => $this->integer(),
            'sale_unit_id' => $this->integer(),
            'tax' => $this->decimal(10,2),
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
        $this->dropTable('inventory');
    }
}
