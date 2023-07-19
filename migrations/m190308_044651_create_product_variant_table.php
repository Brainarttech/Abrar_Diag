<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_variant`.
 */
class m190308_044651_create_product_variant_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('product_variant', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'variant_id' => $this->integer(),
            'code' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('product_variant');
    }
}
