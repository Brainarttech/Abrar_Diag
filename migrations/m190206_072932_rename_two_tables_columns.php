<?php

use yii\db\Migration;

/**
 * Class m190206_072932_rename_two_tables_columns
 */
class m190206_072932_rename_two_tables_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->renameColumn('lab_form', 'added_on', 'created_on');
		$this->renameColumn('lab_form', 'added_by', 'created_by');
		
		$this->renameColumn('lab_form_field', 'added_on', 'created_on');
		$this->renameColumn('lab_form_field', 'added_by', 'created_by');
		
		$this->renameColumn('lab_form', 'test_id', 'item_name_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		$this->renameColumn('lab_form', 'created_on', 'added_on');
		$this->renameColumn('lab_form', 'created_by', 'added_by');
		
		$this->renameColumn('lab_form_field', 'created_on', 'added_on');
		$this->renameColumn('lab_form_field', 'created_by', 'added_by');
		
		$this->renameColumn('lab_form', 'item_name_id', 'test_id');
        //echo "m190206_072932_rename_two_tables_columns cannot be reverted.\n";

        //return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190206_072932_rename_two_tables_columns cannot be reverted.\n";

        return false;
    }
    */
}
