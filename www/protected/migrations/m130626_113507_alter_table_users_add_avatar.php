<?php

class m130626_113507_alter_table_users_add_avatar extends CDbMigration
{
	public function up()
	{
        $this->addColumn('tt_users', 'avatar', 'string');
	}

	public function down()
	{
        $this->dropColumn('tt_users', 'avatar');
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