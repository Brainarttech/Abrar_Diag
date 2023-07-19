<?php

use yii\db\Migration;

/**
 * Handles adding warehouse_id to table `{{%department}}`.
 */
class m190404_084419_add_warehouse_column_to_department_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('department', 'warehouse', $this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('department', 'warehouse');
    }
}
