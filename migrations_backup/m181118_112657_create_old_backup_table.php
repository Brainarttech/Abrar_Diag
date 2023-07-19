<?php

use yii\db\Migration;

/**
 * Handles the creation of table `old_backup`.
 */
class m181118_112657_create_old_backup_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tables = Yii::$app->db->schema->getTableNames();
        $dbType = $this->db->driverName;
        $tableOptions_mysql = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB";
        $tableOptions_mssql = "";
        $tableOptions_pgsql = "";
        $tableOptions_sqlite = "";
        /* MYSQL */
        if (!in_array('additional_cost_item', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%additional_cost_item}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'product' => 'VARCHAR(255) NOT NULL',
                    'rate' => 'INT(11) NOT NULL',
                    'cat_id' => 'INT(11) NULL',
                    'status' => 'TINYINT(4) NOT NULL DEFAULT \'1\' COMMENT \'1=Active 0=InActive\'',
                    'created_on' => 'DATETIME NOT NULL',
                    'created_by' => 'INT(11) NOT NULL',
                    'updated_on' => 'DATETIME NULL',
                    'updated_by' => 'INT(11) NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('auth_assignment', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%auth_assignment}}', [
                    'item_name' => 'VARCHAR(64) NOT NULL',
                    0 => 'PRIMARY KEY (`item_name`)',
                    'user_id' => 'VARCHAR(64) NOT NULL',
                    1 => 'PRIMARY KEY (`user_id`)',
                    'created_at' => 'INT(11) NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('auth_item', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%auth_item}}', [
                    'name' => 'VARCHAR(64) NOT NULL',
                    0 => 'PRIMARY KEY (`name`)',
                    'type' => 'INT(11) NOT NULL',
                    'description' => 'TEXT NULL',
                    'rule_name' => 'VARCHAR(64) NULL',
                    'data' => 'TEXT NULL',
                    'created_at' => 'INT(11) NULL',
                    'updated_at' => 'INT(11) NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('auth_item_child', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%auth_item_child}}', [
                    'parent' => 'VARCHAR(64) NOT NULL',
                    0 => 'PRIMARY KEY (`parent`)',
                    'child' => 'VARCHAR(64) NOT NULL',
                    1 => 'PRIMARY KEY (`child`)',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('auth_rule', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%auth_rule}}', [
                    'name' => 'VARCHAR(64) NOT NULL',
                    0 => 'PRIMARY KEY (`name`)',
                    'data' => 'TEXT NULL',
                    'created_at' => 'INT(11) NULL',
                    'updated_at' => 'INT(11) NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('department', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%department}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'hospital_id' => 'INT(11) NOT NULL',
                    'name' => 'VARCHAR(30) NOT NULL',
                    'phone_no' => 'VARCHAR(17) NOT NULL',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 = Inactive , 1 = Active\'',
                    'created_on' => 'DATETIME NOT NULL',
                    'created_by' => 'INT(11) NOT NULL',
                    'updated_on' => 'DATETIME NULL',
                    'updated_by' => 'INT(11) NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('discount_key', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%discount_key}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'key_name' => 'VARCHAR(255) NOT NULL',
                    'status' => 'ENUM(\'0\',\'1\',\'\',\'\') NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'created_by' => 'TINYINT(4) NOT NULL',
                    'updated_on' => 'DATETIME NULL',
                    'updated_by' => 'TINYINT(4) NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('expense_categories', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%expense_categories}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'name' => 'VARCHAR(255) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'created_by' => 'SMALLINT(6) NOT NULL',
                    'updated_on' => 'DATETIME NULL',
                    'updated_by' => 'SMALLINT(6) NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('expenses', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%expenses}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'amount' => 'INT(11) NOT NULL',
                    'note' => 'VARCHAR(1000) NOT NULL',
                    'attachment' => 'VARCHAR(255) NULL',
                    'cat_id' => 'SMALLINT(6) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'created_by' => 'SMALLINT(6) NOT NULL',
                    'updated_on' => 'DATETIME NULL',
                    'updated_by' => 'SMALLINT(6) NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('extra_sale_item', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%extra_sale_item}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'item_id' => 'INT(11) NULL',
                    'item_name' => 'VARCHAR(50) NOT NULL',
                    'item_description' => 'VARCHAR(1000) NULL',
                    'item_rate' => 'DECIMAL(10,0) NOT NULL',
                    'item_quantity' => 'DECIMAL(5,2) NOT NULL',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 = Inactive , 1 = Active\'',
                    'created_on' => 'DATETIME NOT NULL',
                    'created_by' => 'TINYINT(4) NOT NULL',
                    'updated_on' => 'DATETIME NULL',
                    'updated_by' => 'TINYINT(4) NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('extra_sale_option_item', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%extra_sale_option_item}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'item_id' => 'INT(11) NULL',
                    'product_name' => 'VARCHAR(255) NOT NULL',
                    'product_quantity' => 'TINYINT(4) NOT NULL',
                    'status' => 'TINYINT(4) NOT NULL DEFAULT \'1\' COMMENT \'1=Active 0=InActive\'',
                    'created_on' => 'DATETIME NOT NULL',
                    'created_by' => 'INT(11) NOT NULL',
                    'updated_on' => 'DATETIME NULL',
                    'updated_by' => 'INT(11) NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('hospital', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%hospital}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'name' => 'VARCHAR(50) NOT NULL',
                    'phone_no' => 'VARCHAR(17) NOT NULL',
                    'address' => 'VARCHAR(255) NOT NULL',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 = Off , 1 = On\'',
                    'created_on' => 'DATETIME NULL',
                    'created_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                    'updated_by' => 'INT(11) NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('item_category', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%item_category}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'department_id' => 'INT(11) NOT NULL',
                    'name' => 'VARCHAR(50) NOT NULL',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 = Inactive , 1 = Active\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('item_name', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%item_name}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'cat_id' => 'INT(11) NOT NULL',
                    'name' => 'VARCHAR(50) NOT NULL',
                    'price' => 'INT(11) NOT NULL',
                    'consultant_percentage' => 'INT(11) NULL',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 = Inactive , 1 = Active\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('lab_anti_neuclear_antibodies', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%lab_anti_neuclear_antibodies}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'n_o_s' => 'ENUM(\'0\',\'1\',\'2\',\'3\') NOT NULL COMMENT \'0=Blood,1=Urine,2=Semen,3=SLIVA\'',
                    'anti_neuclear_antibodies' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 =Postive, 1 = Negative\'',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0=Active,1=UnActive\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('lab_asot', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%lab_asot}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'n_o_s' => 'ENUM(\'0\',\'1\',\'2\',\'3\') NOT NULL COMMENT \'0=Blood,1=Urine,2=Semen,3=SLIVA\'',
                    'asotiter' => 'VARCHAR(150) NOT NULL',
                    'asotiter_status' => 'ENUM(\'0\',\'1\',\'2\') NOT NULL COMMENT \'0=Negative,1=Positive,2=IU/ML,\'',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0=Active,1=Unactive\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('lab_blood_cp', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%lab_blood_cp}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'n_o_s' => 'ENUM(\'0\',\'1\',\'2\',\'3\') NOT NULL COMMENT \'0=Blood,1=Urine,2=Semen,3=SLIVA\'',
                    'tlc' => 'VARCHAR(25) NOT NULL',
                    'rbc' => 'VARCHAR(25) NOT NULL',
                    'hb' => 'VARCHAR(25) NOT NULL',
                    'hct' => 'VARCHAR(25) NOT NULL',
                    'plt' => 'VARCHAR(25) NOT NULL',
                    'mcv' => 'VARCHAR(25) NOT NULL',
                    'mch' => 'VARCHAR(25) NOT NULL',
                    'mchc' => 'VARCHAR(25) NOT NULL',
                    'rdwc' => 'VARCHAR(25) NOT NULL',
                    'dll_neu' => 'VARCHAR(25) NOT NULL',
                    'dll_lym' => 'VARCHAR(25) NOT NULL',
                    'dll_eos' => 'VARCHAR(25) NOT NULL',
                    'dll_mon' => 'VARCHAR(25) NOT NULL',
                    'ab_neu' => 'VARCHAR(25) NOT NULL',
                    'ab_lym' => 'VARCHAR(25) NOT NULL',
                    'ab_eos' => 'VARCHAR(25) NOT NULL',
                    'ab_mon' => 'VARCHAR(25) NOT NULL',
                    'esr' => 'VARCHAR(25) NOT NULL',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 =Active, 1 = UnActive\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('lab_blood_gp', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%lab_blood_gp}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'n_o_s' => 'ENUM(\'0\',\'1\',\'2\',\'3\') NOT NULL COMMENT \'0=Blood,1=Urine,2=Semen,3=SLIVA\'',
                    'pgf_si_result' => 'VARCHAR(25) NOT NULL',
                    'pg_abf_si_result' => 'VARCHAR(25) NOT NULL',
                    'pgr_si_result' => 'VARCHAR(25) NOT NULL',
                    'pgf_cu_result' => 'VARCHAR(25) NOT NULL',
                    'pg_abf_cu_result' => 'VARCHAR(25) NOT NULL',
                    'pgr_cu_result' => 'VARCHAR(25) NOT NULL',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 =Active, 1 = UnActive\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_on' => 'INT(11) NULL',
                    'updated_by' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('lab_blood_hb', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%lab_blood_hb}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'n_o_s' => 'ENUM(\'0\',\'1\',\'2\',\'3\') NOT NULL COMMENT \'0=Blood,1=Urine,2=Semen,3=SLIVA\'',
                    'blood_hemolobin' => 'VARCHAR(25) NOT NULL',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0=Active,1=UnActive\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('lab_blood_lp', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%lab_blood_lp}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'n_o_s' => 'ENUM(\'0\',\'1\',\'2\',\'3\') NOT NULL COMMENT \'0=Blood,1=Urine,2=Semen,3=SLIVA\'',
                    'lp_se_cho_bf' => 'VARCHAR(25) NOT NULL',
                    'lp_se_cho_af' => 'VARCHAR(25) NOT NULL',
                    'lp_se_hdl_cho_bf' => 'VARCHAR(25) NOT NULL',
                    'lp_se_hdl_cho_af' => 'VARCHAR(25) NOT NULL',
                    'lp_se_tri_bf' => 'VARCHAR(25) NOT NULL',
                    'lp_se_tri_af' => 'VARCHAR(25) NOT NULL',
                    'lp_ldl_cho_bf' => 'VARCHAR(25) NOT NULL',
                    'lp_ldl_cho_af' => 'VARCHAR(25) NOT NULL',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 =Active, 1 = UnActive\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_on' => 'INT(11) NULL',
                    'updated_by' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('lab_blood_mp', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%lab_blood_mp}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'n_o_s' => 'ENUM(\'0\',\'1\',\'2\',\'3\') NOT NULL COMMENT \'0=Blood,1=Urine,2=Semen,3=SLIVA\'',
                    'blood_mp_status' => 'ENUM(\'0\',\'1\',\'2\',\'3\') NOT NULL COMMENT \'0=No MP Seen,1=Mt Rings Seen,2=Mt Rings & Gametocyte se, 3= BT Trophozoite seen\'',
                    'blood_mp_value' => 'VARCHAR(25) NOT NULL',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0=Active,1=UnActive\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('lab_blood_rh_factor', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%lab_blood_rh_factor}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'n_o_s' => 'ENUM(\'0\',\'1\',\'2\',\'3\') NOT NULL COMMENT \'0=Blood,1=Urine,2=Semen,3=SLIVA\'',
                    'blood_group' => 'ENUM(\'0\',\'1\',\'2\',\'3\',\'4\',\'5\',\'6\',\'7\') NOT NULL COMMENT \'0=AYE, 1=BEE, 2=AB,3=OOO, 4=A, 5=B, 6=AB, 7=O\'',
                    'rh_factor' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0=Positive,1=Negative\'',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0=Active,1=UnActive\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('lab_bt_ct', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%lab_bt_ct}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'n_o_s' => 'ENUM(\'0\',\'1\',\'2\',\'3\') NOT NULL COMMENT \'0=Blood,1=Urine,2=Semen,3=SLIVA\'',
                    'bt_m' => 'VARCHAR(25) NOT NULL',
                    'bt_s' => 'VARCHAR(25) NOT NULL',
                    'ct_m' => 'VARCHAR(25) NOT NULL',
                    'ct_s' => 'VARCHAR(25) NOT NULL',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0=Active,1=Unactive\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('lab_cardiac_enzymes', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%lab_cardiac_enzymes}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'n_o_s' => 'ENUM(\'0\',\'1\',\'2\',\'3\') NOT NULL COMMENT \'0=Blood,1=Urine,2=Semen,3=SLIVA\'',
                    'serum_asat_got' => 'VARCHAR(25) NOT NULL',
                    'serum_ldh' => 'VARCHAR(25) NOT NULL',
                    'serum_cpk' => 'VARCHAR(25) NOT NULL',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 =Active, 1 = UnActive\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('lab_elisa_reader', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%lab_elisa_reader}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'n_o_s' => 'ENUM(\'0\',\'1\',\'2\',\'3\') NOT NULL COMMENT \'0=Blood,1=Urine,2=Semen,3=SLIVA\'',
                    'hbs_od' => 'VARCHAR(25) NOT NULL',
                    'hbs_result' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0=Reactive ,1=Non Reactive\'',
                    'hcv_od' => 'VARCHAR(25) NOT NULL',
                    'hcv_result' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0=Reactive ,1=Non Reactive\'',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 =Active, 1 = UnActive\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('lab_fluid_re', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%lab_fluid_re}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'n_o_s' => 'ENUM(\'0\',\'1\',\'2\',\'3\') NOT NULL COMMENT \'0=Blood,1=Urine,2=Semen,3=SLIVA\'',
                    'appearanceone' => 'VARCHAR(25) NOT NULL',
                    'appearancetwo' => 'VARCHAR(25) NOT NULL',
                    'riv_test' => 'VARCHAR(25) NOT NULL',
                    'lesh_man' => 'VARCHAR(25) NOT NULL',
                    'spec_gra' => 'VARCHAR(25) NOT NULL',
                    'gram_st' => 'VARCHAR(25) NOT NULL',
                    'total_cc' => 'VARCHAR(25) NOT NULL',
                    'zn_stain' => 'VARCHAR(25) NOT NULL',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 =Active, 1 = UnActive\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('lab_hepatitis_b_surface', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%lab_hepatitis_b_surface}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'n_o_s' => 'ENUM(\'0\',\'1\',\'2\',\'3\') NOT NULL COMMENT \'0=Blood,1=Urine,2=Semen,3=SLIVA\'',
                    'hepatitis_b' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 =Postive, 1 = Negative\'',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0=Active,1=UnActive\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('lab_hepatits_c_t', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%lab_hepatits_c_t}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'n_o_s' => 'ENUM(\'0\',\'1\',\'2\',\'3\') NOT NULL COMMENT \'0=Blood,1=Urine,2=Semen,3=SLIVA\'',
                    'anti_hcv' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 =Reactive, 1 = Non Reactive\'',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0=Active,1=UnActive\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('lab_liver_ft', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%lab_liver_ft}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'n_o_s' => 'ENUM(\'0\',\'1\',\'2\',\'3\') NOT NULL COMMENT \'0=Blood,1=Urine,2=Semen,3=SLIVA\'',
                    'sb_si_result' => 'VARCHAR(25) NOT NULL',
                    'sap_si_result' => 'VARCHAR(25) NOT NULL',
                    'ssa_si_result' => 'VARCHAR(25) NOT NULL',
                    'stp_si_result' => 'VARCHAR(25) NOT NULL',
                    'sb_cu_result' => 'VARCHAR(25) NOT NULL',
                    'stp_cu_result' => 'VARCHAR(25) NOT NULL',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 =Active, 1 = UnActive\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('lab_pregnancy_test', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%lab_pregnancy_test}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'n_o_s' => 'ENUM(\'0\',\'1\',\'2\',\'3\') NOT NULL COMMENT \'0=Blood,1=Urine,2=Semen,3=SLIVA\'',
                    'pregnancy_test' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 =Positive, 1 = Negative\'',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0=Active,1=UnActive\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('lab_prothronbin_time', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%lab_prothronbin_time}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'n_o_s' => 'ENUM(\'0\',\'1\',\'2\',\'3\') NOT NULL COMMENT \'0=Blood,1=Urine,2=Semen,3=SLIVA\'',
                    'patient' => 'VARCHAR(25) NOT NULL',
                    'control' => 'VARCHAR(25) NOT NULL',
                    'inr' => 'VARCHAR(25) NOT NULL',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 =Active, 1 = UnActive\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('lab_pttk', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%lab_pttk}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'n_o_s' => 'ENUM(\'0\',\'1\',\'2\',\'3\') NOT NULL COMMENT \'0=Blood,1=Urine,2=Semen,3=SLIVA\'',
                    'patient' => 'VARCHAR(25) NOT NULL',
                    'control' => 'VARCHAR(25) NOT NULL',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0=Active,1=UnActive\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('lab_renal_ft', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%lab_renal_ft}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'n_o_s' => 'ENUM(\'0\',\'1\',\'2\',\'3\') NOT NULL COMMENT \'0=Blood,1=Urine,2=Semen,3=SLIVA\'',
                    'su_si_result' => 'VARCHAR(25) NOT NULL',
                    'sc_si_result' => 'VARCHAR(25) NOT NULL',
                    'ss_si_result' => 'VARCHAR(25) NOT NULL',
                    'sp_si_result' => 'VARCHAR(25) NOT NULL',
                    'su_cu_result' => 'VARCHAR(25) NOT NULL',
                    'sc_cu_result' => 'VARCHAR(25) NOT NULL',
                    'ss_cu_result' => 'VARCHAR(25) NOT NULL',
                    'sp_cu_result' => 'VARCHAR(25) NOT NULL',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 =Active, 1 = UnActive\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('lab_semen_analysis', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%lab_semen_analysis}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'n_o_s' => 'ENUM(\'0\',\'1\',\'2\',\'3\') NOT NULL COMMENT \'0=Blood,1=Urine,2=Semen,3=SLIVA\'',
                    'app' => 'VARCHAR(25) NOT NULL',
                    'vol' => 'VARCHAR(25) NOT NULL',
                    'meth' => 'VARCHAR(25) NOT NULL',
                    'visco' => 'VARCHAR(25) NOT NULL',
                    'sp_co' => 'VARCHAR(25) NOT NULL',
                    'ph' => 'VARCHAR(25) NOT NULL',
                    'fa_15m' => 'VARCHAR(25) NOT NULL',
                    'fa_1h' => 'VARCHAR(25) NOT NULL',
                    'fa_3h' => 'VARCHAR(25) NOT NULL',
                    'fa_6h' => 'VARCHAR(25) NOT NULL',
                    'sul_15m' => 'VARCHAR(25) NOT NULL',
                    'sul_1h' => 'VARCHAR(25) NOT NULL',
                    'sul_3h' => 'VARCHAR(25) NOT NULL',
                    'sul_6h' => 'VARCHAR(25) NOT NULL',
                    'd_15m' => 'VARCHAR(25) NOT NULL',
                    'd_1h' => 'VARCHAR(25) NOT NULL',
                    'd_3h' => 'VARCHAR(25) NOT NULL',
                    'd_6h' => 'VARCHAR(25) NOT NULL',
                    'oth_mic' => 'VARCHAR(25) NOT NULL',
                    'opinion' => 'VARCHAR(25) NOT NULL',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0=Active,1=UnActive\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('lab_serology', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%lab_serology}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'n_o_s' => 'ENUM(\'0\',\'1\',\'2\',\'3\') NOT NULL COMMENT \'0=Blood,1=Urine,2=Semen,3=SLIVA\'',
                    'sr_crp' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 =Postive, 1 = Negative\'',
                    'sr_ra_fac' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 =Postive, 1 = Negative\'',
                    'sr_vdrl' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 =Postive, 1 = Negative\'',
                    'sr_anf' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 =Postive, 1 = Negative\'',
                    'sr_asot' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 = > 200 IU/Ml, 1 = <  200 IU/Ml\'',
                    'sr_toxo' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 =Postive, 1 = Negative\'',
                    'sr_meli' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 =Postive, 1 = Negative\'',
                    'sr_abor' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 =Postive, 1 = Negative\'',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 =Active, 1 = UnActive\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('lab_serum_amylase', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%lab_serum_amylase}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'n_o_s' => 'ENUM(\'0\',\'1\',\'2\',\'3\') NOT NULL COMMENT \'0=Blood,1=Urine,2=Semen,3=SLIVA\'',
                    'serum_amylase' => 'VARCHAR(25) NOT NULL',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0=Active,1=UnActive\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('lab_serum_calcium', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%lab_serum_calcium}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'n_o_s' => 'ENUM(\'0\',\'1\',\'2\',\'3\') NOT NULL COMMENT \'0=Blood,1=Urine,2=Semen,3=SLIVA\'',
                    'serum_calcium' => 'VARCHAR(25) NOT NULL',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0=Active,1=UnActive\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('lab_serum_uric_acid', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%lab_serum_uric_acid}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'n_o_s' => 'ENUM(\'0\',\'1\',\'2\',\'3\') NOT NULL COMMENT \'0=Blood,1=Urine,2=Semen,3=SLIVA\'',
                    'serum_uric_acid' => 'VARCHAR(25) NOT NULL',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0=Active,1=UnActive\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('lab_sputum_afb', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%lab_sputum_afb}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'n_o_s' => 'ENUM(\'0\',\'1\',\'2\',\'3\') NOT NULL COMMENT \'0=Blood,1=Urine,2=Semen,3=SLIVA\'',
                    'mycobacterium_tuberculosis' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 =SEEN, 1 = NOT SEEN\'',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0=Active,1=UnActive\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('lab_stool_re', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%lab_stool_re}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'n_o_s' => 'ENUM(\'0\',\'1\',\'2\',\'3\') NOT NULL COMMENT \'0=Blood,1=Urine,2=Semen,3=SLIVA\'',
                    'color' => 'VARCHAR(25) NOT NULL',
                    'consistency' => 'VARCHAR(25) NOT NULL',
                    'ph' => 'VARCHAR(25) NOT NULL',
                    'mucous' => 'VARCHAR(25) NOT NULL',
                    'blood' => 'VARCHAR(25) NOT NULL',
                    'cysts' => 'VARCHAR(25) NOT NULL',
                    'ova' => 'VARCHAR(25) NOT NULL',
                    'pus_cells' => 'VARCHAR(25) NOT NULL',
                    'rbcs' => 'VARCHAR(25) NOT NULL',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 =Active, 1 = UnActive\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('lab_test', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%lab_test}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'test_name' => 'VARCHAR(100) NOT NULL',
                    'test_table_name' => 'VARCHAR(100) NOT NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('lab_thyriod_profile', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%lab_thyriod_profile}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'n_o_s' => 'ENUM(\'0\',\'1\',\'2\',\'3\') NOT NULL COMMENT \'0=Blood,1=Urine,2=Semen,3=SLIVA\'',
                    't3' => 'VARCHAR(25) NOT NULL',
                    't4' => 'VARCHAR(25) NOT NULL',
                    'tsh' => 'VARCHAR(25) NOT NULL',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 =Active, 1 = UnActive\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('lab_urine_re', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%lab_urine_re}}', [
                    'id' => 'INT(11) NOT NULL',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'n_o_s' => 'ENUM(\'0\',\'1\',\'2\',\'3\') NOT NULL COMMENT \'0=Blood,1=Urine,2=Semen,3=SLIVA\'',
                    'appearence' => 'VARCHAR(25) NOT NULL',
                    'turbidity' => 'VARCHAR(25) NOT NULL',
                    'sp_gravity' => 'VARCHAR(25) NOT NULL',
                    'ph' => 'VARCHAR(25) NOT NULL',
                    'protein' => 'VARCHAR(25) NOT NULL',
                    'sugar' => 'VARCHAR(25) NOT NULL',
                    'bile_salt' => 'VARCHAR(25) NOT NULL',
                    'bile_pigment' => 'VARCHAR(25) NOT NULL',
                    'm_rbc' => 'VARCHAR(25) NOT NULL',
                    'm_wbs' => 'VARCHAR(25) NOT NULL',
                    'm_costs' => 'VARCHAR(25) NOT NULL',
                    'm_crystals' => 'VARCHAR(25) NOT NULL',
                    'm_other' => 'VARCHAR(25) NOT NULL',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 =Active, 1 = UnActive\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('lab_vdrl_test', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%lab_vdrl_test}}', [
                    'id' => 'INT(11) NOT NULL',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'n_o_s' => 'ENUM(\'0\',\'1\',\'2\',\'3\') NOT NULL COMMENT \'0=Blood,1=Urine,2=Semen,3=SLIVA\'',
                    'blood_vdrl' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 =Postive, 1 = Negative\'',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0=Active,1=UnActive\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('lab_widal_reaction', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%lab_widal_reaction}}', [
                    'id' => 'INT(11) NOT NULL',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_item_id' => 'INT(11) NOT NULL',
                    'n_o_s' => 'ENUM(\'0\',\'1\',\'2\',\'3\') NOT NULL COMMENT \'0=Blood,1=Urine,2=Semen,3=SLIVA\'',
                    'w_to' => 'VARCHAR(25) NOT NULL',
                    'w_th' => 'VARCHAR(25) NOT NULL',
                    'w_ao' => 'VARCHAR(25) NOT NULL',
                    'w_bo' => 'VARCHAR(25) NOT NULL',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0=Active, 1=UnActive\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_on' => 'INT(11) NULL',
                    'updated_by' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('mop', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%mop}}', [
                    'id' => 'INT(11) NOT NULL',
                    0 => 'PRIMARY KEY (`id`)',
                    'name' => 'VARCHAR(50) NOT NULL',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 = Inactive , 1 = Active\'',
                    'created_by' => 'INT(11) NULL',
                    'created_on' => 'DATETIME NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('optional_item', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%optional_item}}', [
                    'id' => 'INT(11) NOT NULL',
                    0 => 'PRIMARY KEY (`id`)',
                    'product_name' => 'VARCHAR(255) NOT NULL',
                    'cat_id' => 'INT(11) NULL',
                    'required' => 'TINYINT(1) NOT NULL COMMENT \'1=True 0=False\'',
                    'default_quantity' => 'TINYINT(4) NOT NULL DEFAULT \'1\'',
                    'status' => 'TINYINT(4) NOT NULL DEFAULT \'1\' COMMENT \'1 = Active 0= InActive\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('patient', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%patient}}', [
                    'id' => 'INT(11) NOT NULL',
                    0 => 'PRIMARY KEY (`id`)',
                    'name' => 'VARCHAR(50) NOT NULL',
                    'cnic' => 'VARCHAR(15) NULL',
                    'phone_no' => 'VARCHAR(17) NOT NULL',
                    'reg_no' => 'VARCHAR(50) NOT NULL',
                    'email' => 'VARCHAR(50) NULL',
                    'gender' => 'VARCHAR(6) NOT NULL',
                    'age' => 'INT(11) NOT NULL',
                    'relationship' => 'VARCHAR(30) NOT NULL',
                    'whatsapp_no' => 'VARCHAR(17) NULL',
                    'city' => 'VARCHAR(100) NOT NULL',
                    'country' => 'VARCHAR(100) NOT NULL',
                    'address' => 'VARCHAR(255) NULL',
                    'referred_by_id' => 'INT(11) NULL',
                    'panel_id' => 'INT(11) NULL',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 = InActive , 1 = Active\'',
                    'created_on' => 'DATETIME NOT NULL',
                    'created_by' => 'INT(11) NOT NULL',
                    'updated_on' => 'DATETIME NULL',
                    'updated_by' => 'INT(11) NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('payment', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%payment}}', [
                    'id' => 'INT(11) NOT NULL',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_id' => 'INT(11) NOT NULL',
                    'reference_no' => 'VARCHAR(50) NOT NULL',
                    'mop_id' => 'INT(11) NOT NULL',
                    'amount' => 'INT(11) NOT NULL',
                    'discount' => 'INT(11) NULL',
                    'discount_type' => 'VARCHAR(50) NULL',
                    'discount_reason' => 'VARCHAR(200) NULL',
                    'pos_paid' => 'INT(11) NOT NULL',
                    'pos_balance' => 'INT(11) NOT NULL',
                    'note' => 'VARCHAR(1000) NULL',
                    'payment_status' => 'ENUM(\'0\',\'1\',\'2\') NOT NULL COMMENT \'0 = Cancel, 1 = Received, 2 = Pending\'',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 = InActive, 1 = Active\'',
                    'created_by' => 'INT(11) NULL',
                    'created_on' => 'DATETIME NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('referred_doctor', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%referred_doctor}}', [
                    'id' => 'INT(11) NOT NULL',
                    0 => 'PRIMARY KEY (`id`)',
                    'name' => 'VARCHAR(50) NOT NULL',
                    'hospital_name' => 'VARCHAR(50) NULL',
                    'cnic' => 'VARCHAR(15) NOT NULL',
                    'phone_no' => 'VARCHAR(17) NOT NULL',
                    'email' => 'VARCHAR(50) NULL',
                    'address' => 'VARCHAR(255) NULL',
                    'commission' => 'INT(11) NULL',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 = Inactive , 1 = Active\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('sale', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%sale}}', [
                    'id' => 'INT(11) NOT NULL',
                    0 => 'PRIMARY KEY (`id`)',
                    'hospital_id' => 'INT(11) NOT NULL',
                    'patient_id' => 'INT(11) NOT NULL',
                    'referred_doctor_id' => 'INT(11) NOT NULL',
                    'invoice_no' => 'VARCHAR(100) NOT NULL',
                    'total' => 'INT(11) NOT NULL',
                    'discount' => 'INT(11) NOT NULL',
                    'discount_type' => 'VARCHAR(10) NULL',
                    'tax' => 'INT(11) NOT NULL',
                    'extra_charges' => 'INT(11) NULL',
                    'grand_total' => 'INT(11) NOT NULL',
                    'payment_status' => 'ENUM(\'0\',\'1\',\'2\') NOT NULL COMMENT \'0 = due, 1 = paid , 2=partial\'',
                    'total_items' => 'INT(11) NOT NULL',
                    'paid_amount' => 'INT(11) NOT NULL',
                    'refund_charges' => 'INT(11) NOT NULL',
                    'notes' => 'VARCHAR(1000) NOT NULL',
                    'sale_status' => 'ENUM(\'1\',\'2\') NOT NULL COMMENT \'1 = sale, 2 = refund\'',
                    'depart_push_status' => 'TINYINT(4) NOT NULL COMMENT \'1=Push 2=0\'',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 = InActive, 1 = Active\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('sale_item', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%sale_item}}', [
                    'id' => 'INT(11) NOT NULL',
                    0 => 'PRIMARY KEY (`id`)',
                    'sale_id' => 'INT(11) NOT NULL',
                    'item_id' => 'INT(11) NOT NULL',
                    'lab_test_id' => 'INT(11) NOT NULL',
                    'item_name' => 'VARCHAR(50) NOT NULL',
                    'item_price' => 'INT(11) NOT NULL',
                    'item_discount' => 'INT(11) NOT NULL',
                    'item_discount_type' => 'VARCHAR(10) NULL',
                    'discount_reason' => 'INT(11) NULL',
                    'consultant_amount' => 'INT(11) NOT NULL',
                    'comment' => 'VARCHAR(5000) NULL',
                    'test_status' => 'ENUM(\'1\',\'2\',\'3\',\'\') NOT NULL DEFAULT \'1\' COMMENT \'1=Pending 2=Complete\'',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 = InActive, 1 = Active\'',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('staff', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%staff}}', [
                    'id' => 'INT(11) NOT NULL',
                    0 => 'PRIMARY KEY (`id`)',
                    'department_id' => 'INT(11) NOT NULL',
                    'name' => 'VARCHAR(50) NOT NULL',
                    'cnic' => 'VARCHAR(15) NOT NULL',
                    'phone_no' => 'VARCHAR(17) NOT NULL',
                    'address' => 'VARCHAR(255) NOT NULL',
                    'status' => 'ENUM(\'0\',\'1\') NOT NULL COMMENT \'0 = Inactive , 1 = Active\'',
                    'staff_type' => 'VARCHAR(50) NOT NULL',
                    'image' => 'VARCHAR(150) NOT NULL',
                    'created_by' => 'INT(11) NOT NULL',
                    'created_on' => 'DATETIME NOT NULL',
                    'updated_by' => 'INT(11) NULL',
                    'updated_on' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('user', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%user}}', [
                    'id' => 'INT(11) NOT NULL',
                    0 => 'PRIMARY KEY (`id`)',
                    'first_name' => 'VARCHAR(255) NOT NULL',
                    'last_name' => 'VARCHAR(255) NULL',
                    'image' => 'VARCHAR(255) NULL',
                    'username' => 'VARCHAR(255) NOT NULL',
                    'auth_key' => 'VARCHAR(32) NOT NULL',
                    'password_hash' => 'VARCHAR(255) NOT NULL',
                    'password_reset_token' => 'VARCHAR(255) NULL',
                    'email' => 'VARCHAR(255) NOT NULL',
                    'phone_no' => 'VARCHAR(50) NULL',
                    'about' => 'VARCHAR(2000) NULL',
                    'assign_department' => 'VARCHAR(100) NULL',
                    'role' => 'VARCHAR(255) NULL',
                    'status' => 'SMALLINT(6) NOT NULL DEFAULT \'10\'',
                    'created_on' => 'DATETIME NOT NULL',
                    'created_by' => 'SMALLINT(6) NOT NULL',
                    'updated_on' => 'DATETIME NULL',
                    'updated_by' => 'SMALLINT(6) NULL',
                    'created_at' => 'INT(11) NOT NULL',
                    'updated_at' => 'INT(11) NOT NULL',
                ], $tableOptions_mysql);
            }
        }


        $this->createIndex('idx_rule_name_1096_00','auth_item','rule_name',0);
        $this->createIndex('idx_type_1096_01','auth_item','type',0);
        $this->createIndex('idx_child_1176_02','auth_item_child','child',0);
        $this->createIndex('idx_hospital_id_1383_03','department','hospital_id',0);
        $this->createIndex('idx_department_id_213_04','item_category','department_id',0);
        $this->createIndex('idx_cat_id_2208_05','item_name','cat_id',0);
        $this->createIndex('idx_sale_item_id_2304_06','lab_anti_neuclear_antibodies','sale_item_id',0);
        $this->createIndex('idx_sale_item_id_2395_07','lab_asot','sale_item_id',0);
        $this->createIndex('idx_mop_id_537_08','payment','mop_id',0);
        $this->createIndex('idx_sale_id_537_09','payment','sale_id',0);
        $this->createIndex('idx_department_id_5775_10','staff','department_id',0);
        $this->createIndex('idx_UNIQUE_username_5829_11','user','username',1);
        $this->createIndex('idx_UNIQUE_email_5829_12','user','email',1);
        $this->createIndex('idx_UNIQUE_password_reset_token_5829_13','user','password_reset_token',1);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `additional_cost_item`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `auth_assignment`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `auth_item`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `auth_item_child`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `auth_rule`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `department`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `discount_key`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `expense_categories`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `expenses`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `extra_sale_item`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `extra_sale_option_item`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `hospital`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `item_category`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `item_name`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `lab_anti_neuclear_antibodies`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `lab_asot`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `lab_blood_cp`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `lab_blood_gp`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `lab_blood_hb`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `lab_blood_lp`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `lab_blood_mp`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `lab_blood_rh_factor`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `lab_bt_ct`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `lab_cardiac_enzymes`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `lab_elisa_reader`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `lab_fluid_re`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `lab_hepatitis_b_surface`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `lab_hepatits_c_t`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `lab_liver_ft`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `lab_pregnancy_test`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `lab_prothronbin_time`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `lab_pttk`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `lab_renal_ft`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `lab_semen_analysis`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `lab_serology`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `lab_serum_amylase`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `lab_serum_calcium`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `lab_serum_uric_acid`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `lab_sputum_afb`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `lab_stool_re`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `lab_test`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `lab_thyriod_profile`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `lab_urine_re`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `lab_vdrl_test`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `lab_widal_reaction`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `mop`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `optional_item`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `patient`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `payment`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `referred_doctor`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `sale`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `sale_item`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `staff`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `user`');
        $this->execute('SET foreign_key_checks = 1;');
    }
}
