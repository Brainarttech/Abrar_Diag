<?php

use yii\db\Migration;

/**
 * Class m190206_063807_lab_clean_table
 */
class m190206_063807_lab_clean_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		echo "it is just to clean lab tables";
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190206_063807_lab_clean_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190206_063807_lab_clean_table cannot be reverted.\n";

        return false;
    }
    */
}
