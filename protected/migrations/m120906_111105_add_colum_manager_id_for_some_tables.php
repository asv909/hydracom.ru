<?php

class m120906_111105_add_colum_manager_id_for_some_tables extends CDbMigration
{
    public function safeUp()
    {
         $this->addColumn('post', 'manager_id', 'TINYINT UNSIGNED NOT NULL');
         $this->addColumn('region', 'manager_id', 'TINYINT UNSIGNED NOT NULL');
         $this->addColumn('city', 'manager_id', 'TINYINT UNSIGNED NOT NULL');
         $this->addColumn('org', 'manager_id', 'TINYINT UNSIGNED NOT NULL');
    }

    public function safeDown()
    {
        $this->dropColumn('post', 'manager_id');
        $this->dropColumn('region', 'manager_id');
        $this->dropColumn('city', 'manager_id');
        $this->dropColumn('org', 'manager_id');
    }
}