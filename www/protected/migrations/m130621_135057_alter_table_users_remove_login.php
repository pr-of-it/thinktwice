<?php

class m130621_135057_alter_table_users_remove_login extends CDbMigration
{
	public function up()
	{
        $this->dropColumn('tt_users', 'login');
    }

	public function down()
	{
		$this->addColumn('tt_users', 'login', 'string');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}