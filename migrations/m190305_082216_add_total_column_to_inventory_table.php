<?php

use yii\db\Migration;

/**
 * Handles adding total to table `inventory`.
 */
class m190305_082216_add_total_column_to_inventory_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('inventory', 'total', $this->decimal(5,2));
        $this->addColumn('inventory', 'grand_total', $this->decimal(5,2));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('inventory', 'total');
        $this->dropColumn('inventory', 'grand_total');
    }
}
