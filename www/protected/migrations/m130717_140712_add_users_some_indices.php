<?php

class m130717_140712_add_users_some_indices extends CDbMigration
{
	public function up()
	{
        $this->createIndex('roleid', 'tt_users', 'roleid');
	}

	public function down()
	{
        $this->dropIndex('roleid', 'tt_users');
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