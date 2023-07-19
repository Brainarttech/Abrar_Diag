<?php

use yii\db\Migration;

/**
 * Handles adding warehouse_id to table `inventory`.
 */
class m190130_080129_add_warehouse_id_column_to_inventory_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('inventory', 'warehouse_id', $this->integer());
        $this->addColumn('inventory', 'expiry_date', $this->date());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('inventory', 'warehouse_id');
        $this->dropColumn('inventory', 'expiry_date');
    }
}
