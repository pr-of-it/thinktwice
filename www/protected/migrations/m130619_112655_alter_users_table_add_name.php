<?php

class m130619_112655_alter_users_table_add_name extends CDbMigration
{
	public function up()
	{
        $this->addColumn('tt_users', 'name', 'string');
	}

	public function down()
	{
        $this->dropColumn('tt_users', 'name');
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