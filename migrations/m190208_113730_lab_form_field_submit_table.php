<?php

use yii\db\Migration;

/**
 * Class m190208_113730_lab_form_field_submit_table
 */
class m190208_113730_lab_form_field_submit_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->createTable('lab_form_field_submit', [
            'id' => $this->primaryKey(),
            'lab_form_submit_id' => $this->integer()->notNull(),
            'name' => $this->string(200)->notNull(),
            'result' => $this->string(200),
            'unit' => $this->string(100),
            'reference_range' => $this->text(),
            'header_name' => $this->string(100),
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
		$this->dropTable('lab_form_field_submit');
        // echo "m190208_113730_lab_form_field_submit_table cannot be reverted.\n";

        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190208_113730_lab_form_field_submit_table cannot be reverted.\n";

        return false;
    }
    */
}
