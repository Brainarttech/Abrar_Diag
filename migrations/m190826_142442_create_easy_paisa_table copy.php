<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%easy_paisa}}`.
 */
class m190826_142442_create_easy_paisa_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('easy_paisa', [
            'id' => $this->primaryKey(),
            'transaction_id' => $this->integer(),
            'sale_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('easy_paisa');
    }
}
