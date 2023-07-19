<?php

use yii\db\Migration;

/**
 * Handles adding title to table `lab_form`.
 */
class m190318_051139_add_title_column_to_lab_form_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('lab_form', 'title', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('lab_form', 'title');
    }
}
