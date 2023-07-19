<?php

use yii\db\Migration;

/**
 * Handles the creation of table `referred_reporting_doc`.
 */
class m190401_141007_create_referred_reporting_doc_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('referred_reporting_doc', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'dep_id' => $this->integer(),
            'hospital_name' => $this->string(),
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
    public function safeDown()
    {
        $this->dropTable('referred_reporting_doc');
    }
}
