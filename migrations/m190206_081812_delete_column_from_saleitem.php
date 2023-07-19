<?php

use yii\db\Migration;

/**
 * Class m190206_081812_delete_column_from_saleitem
 */
class m190206_081812_delete_column_from_saleitem extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->dropColumn('sale_item', 'lab_test_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		$this->addColumn('sale_item', 'lab_test_id', $this->integer()->after('item_id')->notNull()->defaultValue(0));
        //echo "m190206_081812_delete_column_from_saleitem cannot be reverted.\n";

        //return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190206_081812_delete_column_from_saleitem cannot be reverted.\n";

        return false;
    }
    */
}
