<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lab_form_item_name`.
 */
class m190328_105611_create_lab_form_item_name_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('lab_form_item_name', [
            'id' => $this->primaryKey(),
            'lab_form_id' => $this->integer(),
            'item_name_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lab_form_item_name');
    }
}
