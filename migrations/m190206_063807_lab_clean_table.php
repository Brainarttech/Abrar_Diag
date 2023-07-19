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
		$this->dropTable('lab_anti_neuclear_antibodies'); // 1
		$this->dropTable('lab_asot'); // 2
		$this->dropTable('lab_blood_cp'); // 3
		$this->dropTable('lab_blood_gp'); // 4
		$this->dropTable('lab_blood_hb'); // 5
		$this->dropTable('lab_blood_lp'); // 6
		$this->dropTable('lab_blood_mp'); // 7
		$this->dropTable('lab_blood_rh_factor'); // 8
		$this->dropTable('lab_bt_ct'); // 9
		$this->dropTable('lab_cardiac_enzymes'); // 10
		$this->dropTable('lab_elisa_reader'); // 11
		$this->dropTable('lab_fluid_re'); // 12
		$this->dropTable('lab_hepatitis_b_surface'); // 13
		$this->dropTable('lab_hepatits_c_t'); // 14
		$this->dropTable('lab_pregnancy_test'); // 15
		$this->dropTable('lab_prothronbin_time'); // 16
		$this->dropTable('lab_pttk'); // 17
		$this->dropTable('lab_renal_ft'); // 18
		$this->dropTable('lab_semen_analysis'); // 19
		$this->dropTable('lab_serology'); // 20
		$this->dropTable('lab_serum_amylase'); // 21
		$this->dropTable('lab_serum_calcium'); // 22
		$this->dropTable('lab_serum_uric_acid'); // 23
		$this->dropTable('lab_sputum_afb'); // 24
		$this->dropTable('lab_stool_re'); // 25
		$this->dropTable('lab_thyriod_profile'); // 26
		$this->dropTable('lab_urine_re'); // 27
		$this->dropTable('lab_vdrl_test'); // 28
		$this->dropTable('lab_widal_reaction'); // 29
		$this->dropTable('lab_liver_ft'); // 30
		$this->dropTable('lab_test'); // 31
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		echo "it is just to clean lab tables";

        //return false;
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
