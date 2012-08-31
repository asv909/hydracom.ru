<?php

class m120719_053118_change_col_name_from_diff_to_same_names extends CDbMigration
{
        public function safeUp()
        {
            $this->renameColumn('measure', 'unite', 'name');
            $this->renameColumn('org', 'form', 'name');
            $this->renameColumn('post', 'index', 'name');
        }

	public function safeDown()
	{
            $this->renameColumn('measure', 'name', 'unite');
            $this->renameColumn('org', 'name', 'form');
            $this->renameColumn('post', 'name', 'index');
	}
}