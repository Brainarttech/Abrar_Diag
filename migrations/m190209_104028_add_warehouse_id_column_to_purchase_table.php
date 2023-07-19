<?php

use yii\db\Migration;

/**
 * Handles adding warehouse_id to table `purchase`.
 */
class m190209_104028_add_warehouse_id_column_to_purchase_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('purchase', 'warehouse_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('purchase', 'warehouse_id');
    }
}
