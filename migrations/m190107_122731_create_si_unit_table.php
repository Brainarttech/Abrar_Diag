<?php

use yii\db\Migration;

/**
 * Handles the creation of table `si_unit`.
 */
class m190107_122731_create_si_unit_table extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('si_unit', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'base_value' => $this->decimal(9, 2)->defaultValue(null),
            'opration' => "ENUM('*', '/', '+', '-')",
            'unit_id' => $this->integer(),
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
        $this->dropTable('si_unit');
    }

}
