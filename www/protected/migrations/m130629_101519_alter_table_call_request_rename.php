<?php

class m130629_101519_alter_table_call_request_rename extends CDbMigration
{
	public function up()
	{
        $this->renameColumn('tt_call_requests','comments','comments_json');
	}

	public function down()
	{
        $this->renameColumn('tt_call_requests','comments_json','comments');
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