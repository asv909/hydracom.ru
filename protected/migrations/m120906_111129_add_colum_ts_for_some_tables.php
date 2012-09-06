<?php

class m120906_111129_add_colum_ts_for_some_tables extends CDbMigration
{
    public function safeUp()
    {
         $this->addColumn('post', 'ts', 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT "Изменено"');
         $this->addColumn('region', 'ts', 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT "Изменено"');
         $this->addColumn('city', 'ts', 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT "Изменено"');
         $this->addColumn('org', 'ts', 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT "Изменено"');
    }

    public function safeDown()
    {
        $this->dropColumn('post', 'ts');
        $this->dropColumn('region', 'ts');
        $this->dropColumn('city', 'ts');
        $this->dropColumn('org', 'ts');
    }
}