<?php

use yii\db\Migration;

/**
 * Handles adding tax to table `purchase`.
 */
class m190306_052258_add_tax_column_to_purchase_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('purchase', 'tax', $this->decimal(5,2));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('purchase', 'tax');
    }
}
