<?php

class m130714_103954_add_auth_token_to_users extends CDbMigration
{
	public function up()
	{
        $this->addColumn('tt_users', 'auth_token', 'string');
        $this->addColumn('tt_users', 'auth_token_expire', 'datetime');
	}

	public function down()
	{
        $this->dropColumn('tt_users', 'auth_token');
        $this->dropColumn('tt_users', 'auth_token_expire');
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