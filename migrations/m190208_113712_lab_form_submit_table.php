<?php

use yii\db\Migration;

/**
 * Class m190208_113712_lab_form_submit_table
 */
class m190208_113712_lab_form_submit_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->createTable('lab_form_submit', [
            'id' => $this->primaryKey(),
			'sale_item_id' => $this->integer()->notNull(),
            'lab_form_id' => $this->integer()->notNull(),
            'lab_form_name' => $this->string(100)->notNull(),
            'item_name_id' => $this->integer()->notNull(),
            'item_name_name' => $this->string(50)->notNull(),
            'patient_id' => $this->integer(),
			'created_on' => $this->dateTime()->notNull(),
			'created_by' => 'tinyint not null',
			'updated_on' => $this->dateTime(),
			'updated_by' => 'tinyint',
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		$this->dropTable('lab_form_submit');
        // echo "m190208_113712_lab_form_submit_table cannot be reverted.\n";
        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190208_113712_lab_form_submit_table cannot be reverted.\n";

        return false;
    }
    */
}
