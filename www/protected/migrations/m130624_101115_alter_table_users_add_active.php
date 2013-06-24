<?php

class m130624_101115_alter_table_users_add_active extends CDbMigration
{
	public function up()
	{
        $this->addColumn('tt_users', 'active', 'integer DEFAULT 1');
	}

	public function down()
	{
        $this->dropColumn('tt_users', 'active');
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