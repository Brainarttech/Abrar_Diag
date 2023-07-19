<?php

use yii\db\Migration;

/**
 * Handles the creation of table `referred_report`.
 */
class m190401_111638_create_referred_report_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('referred_report', [
            'id' => $this->primaryKey(),
            'referred_reporting_doc_id' => $this->integer(),
            'films_issued' => $this->boolean(),
            'report_issued' => $this->boolean(),
            'sale_item_id' => $this->integer(),
            'status' => "ENUM('Sent','Received','Delivered')",
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
        $this->dropTable('referred_report');
    }
}
