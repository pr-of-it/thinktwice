<?php

class m130630_085456_alter_table_user_rename extends CDbMigration
{
	public function up()
	{
        $this->renameColumn('tt_users','avatar','avatar_file');
	}

	public function down()
	{
        $this->renameColumn('tt_users','avatar_file','avatar');
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