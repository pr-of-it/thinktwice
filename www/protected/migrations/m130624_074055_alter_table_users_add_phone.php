<?php

class m130624_074055_alter_table_users_add_phone extends CDbMigration
{
	public function up()
	{
        $this->addColumn('tt_users', 'phone', 'string');
	}

	public function down()
	{
		$this->dropColumn('tt_users', 'phone');
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