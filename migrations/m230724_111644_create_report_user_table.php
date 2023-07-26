<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%report_user}}`.
 */
class m230724_111644_create_report_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%report_user}}', [
            'id' => $this->primaryKey(),
            'invoice_no'=>$this->string(),
            'item_id'=>$this->integer(),
            'report'=>$this->string(),
            'paitent_id'=>$this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%report_user}}');
    }
}
