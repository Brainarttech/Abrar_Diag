<?php

use yii\db\Migration;

/**
 * Handles adding brand_id to table `product`.
 */
class m190130_095913_add_brand_id_column_to_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product', 'brand_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('product', 'brand_id');
    }
}
