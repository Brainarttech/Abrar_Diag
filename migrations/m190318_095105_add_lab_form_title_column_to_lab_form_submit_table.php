<?php

use yii\db\Migration;

/**
 * Handles adding lab_form_title to table `lab_form_submit`.
 */
class m190318_095105_add_lab_form_title_column_to_lab_form_submit_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('lab_form_submit', 'lab_form_title', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('lab_form_submit', 'lab_form_title');
    }
}
