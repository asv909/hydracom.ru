<?php

class m120705_081452_add_skey_to_manager_table extends CDbMigration
{
    public function up()
    {
         $this->addColumn('manager', 'skey', 'char(23)');
    }

    public function down()
    {
        $this->dropColumn('manager', 'skey');
    }
}