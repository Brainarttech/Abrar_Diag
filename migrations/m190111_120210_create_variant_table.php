<?php

use yii\db\Migration;

/**
 * Handles the creation of table `variant`.
 */
class m190111_120210_create_variant_table extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('variant', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'price' => $this->decimal(9, 2),
            'product_id' => $this->integer(),
            'category_id' => $this->integer(),
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
    public function safeDown() {
        $this->dropTable('variant');
    }

}
